<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Setting;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

use YouTube\YouTubeDownloader;
use YouTube\Exception\YouTubeException;

class KeywordController extends Controller

{
    public function create()
    {
        $data = array();

        $data['categories'] = Category::all();
        return view('admin.create_keyword', $data);
    }
    public function create_video()
    {
        $data = array();

        $data['categories'] = Category::all();
        return view('admin.create_video', $data);
    }


    public function video()
    {

        $type = request('file_type');
        $video =  new Song();

        $video = array();
        $video["video_id"] = "0";
        $video['title'] = request('title');
        $video['slug'] = request('slug');
        $video['description'] = request('description');
        $video['category_id'] = request('category_id');

        if ($type == 'URL') {

            $video_link = request('video_id');
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_link, $match);
            $video_id =  $match[1];
            $video["video_id"] = $video_id;
            $video['image_file'] = $this->get_video($video_id);
            $video['audio_file'] = $video_id . ".mp3";
            $video['audio_file_size'] =  $this->downloadYoutube($video_id, $video['image_file']);
        } else {

            $audio_file = request()->file('audio_file');
            $video['audio_file'] = uniqid() . "." . $audio_file->getClientOriginalExtension();
            $video['audio_file_size'] = $audio_file->getSize();
            $audio_file->move("uploads/audios/", $video['audio_file']);
            if (request()->has("image_file")) {
                $image_file = request()->file('image_file');
                $video['image_file'] = uniqid() . "." . $image_file->getClientOriginalExtension();
                $image_file->move("uploads/images/", $video['image_file']);
            }
        }


        $id =  DB::table("songs")->insertGetId($video);

        if ($id) {
            return redirect()->back()->with('success', " Posts Uploaded  Successfully");
        } else {
            return redirect()->back()->with('errore', " Unable to upload post");
        }
    }


    public function store()
    {
        $count = 0;
        $playlist_link = request('keyword');
        $playlist_id = substr(explode("list=", $playlist_link)[1], 0, 43);
        $results = request('results');
        $category_id = request('category_id');

        $videos = $this->get_videos($playlist_id, $results);
        foreach ($videos as $video) {
            $video['category_id'] = $category_id;
            $video['audio_file_size'] = $this->downloadYoutube($video['video_id'], $video['image_file']);


            $this->save_to_db($video);
            $count++;
            if ($count == $results) {
                break;
            }
        }



        return redirect()->back()->with('success', "$count Posts Uploaded  Successfully");
    }




















    public function get_videos($playlist_id, $results)
    {
        $videos = array();
        $apiKey = Setting::where('property', 'api_key')->first()->value;
        // $apiKey = "AIzaSyAq4ij7a8PeBBtxtnxOuRA8acoBX8McQcI";
        $reponse = Http::get("https://youtube.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=$results&playlistId=$playlist_id&key=$apiKey");
        if ($reponse) {
            $items =  json_decode($reponse)->items;
            foreach ($items as $item) {
                if ($item->snippet->resourceId->kind == "youtube#video") {
                    $video = array();
                    $video['video_id'] = $item->snippet->resourceId->videoId;
                    $video['title'] = $item->snippet->title;
                    $video['slug'] =  implode("-", array_slice(explode(" ", strtolower($item->snippet->title)), 0, 5));
                    $video['description'] = substr($item->snippet->description, 0, 200);
                    $video['image_file'] = $item->snippet->thumbnails->default->url;
                    array_push($videos, $video);

                    $image_file_url = $item->snippet->thumbnails->default->url;
                    $image_file =  $video['video_id'] .  "." . explode(".", $image_file_url)[count(explode(".", $image_file_url)) - 1];
                    if (!empty($image_file_url) && substr($image_file_url, 0, 8) === 'https://') {
                        header("Cache-Control: public");
                        header("Content-Description: File Transfer");
                        header("Content-Disposition: attachment;filename=\"$image_file\"");
                        header("Content-Transfer-Encoding: binary");

                        file_put_contents("uploads/images/$image_file", fopen($image_file_url, 'r'));
                    }
                }
            }
        }
        return $videos;
    }



    public function get_video($video_id)
    {
        $image_file_url = "";
        $apiKey = Setting::where('property', 'api_key')->first()->value;
        // $apiKey = "AIzaSyAq4ij7a8PeBBtxtnxOuRA8acoBX8McQcI";
        $reponse = Http::get("https://youtube.googleapis.com/youtube/v3/videos?part=snippet&id=$video_id&key=$apiKey");
        if ($reponse) {
            $items =  json_decode($reponse)->items;
            foreach ($items as $item) {
                $image_file_url = $item->snippet->thumbnails->default->url;
            }
        }

        $image_file = $video_id .  "." . explode(".", $image_file_url)[count(explode(".", $image_file_url)) - 1];
        if (!empty($image_file_url) && substr($image_file_url, 0, 8) === 'https://') {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment;filename=\"$image_file\"");
            header("Content-Transfer-Encoding: binary");

            file_put_contents("uploads/images/$image_file", fopen($image_file_url, 'r'));
        }
        return $image_file;
    }




    public function downloadYoutube($video_id, $thumbnail)
    {
        set_time_limit(0);
        $download_url = "";
        $audio_file_size = "";
        $audio_file = $video_id . ".mp3";
        $image_file = $video_id .  "." . explode(".", $thumbnail)[count(explode(".", $thumbnail)) - 1];
        $youtube = new youtubeDownloader();
        try {
            $downloadOptions = $youtube->getDownloadLinks("https://www.youtube.com/watch?v=$video_id");
            if ($downloadOptions->getAllFormats()) {
                $audios = $downloadOptions->getLowToHighAudioFormats();
                $download_url = $audios[count($audios) - 1]->url;
            } else {
                // echo 'No links found';
            }
        } catch (YouTubeException $e) {
            // echo 'Something went wrong: ' . $e->getMessage();
        }
        if (!empty($download_url) && substr($download_url, 0, 8) === 'https://') {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment;filename=\"$audio_file\"");
            header("Content-Transfer-Encoding: binary");
            file_put_contents("uploads/audios/$audio_file", fopen($download_url, 'r'));
            $audio_file_size = Storage::disk("local")->size("uploads/audios/$audio_file");

            // FFMpeg::fromDisk("local")
            //     ->open("uploads/videos/$videoId.mp4")
            //     ->export()
            //     ->toDisk("local")
            //     ->inFormat(new \FFMpeg\Format\Audio\Mp3)
            //     ->save("uploads/audios/$videoId.mp3");
            // shell_exec("ffmpeg -i /var/www/mpbjym/harabharamp/public/uploads/videos/$videoId.mp4 /var/www/mpbjym/harabharamp/public/uploads/audios/$videoId.mp3 ");

        }

        return  $audio_file_size;
    }




    public  function save_to_db($video)

    {
        $video_id = $video['video_id'];
        $title = $video['title'];
        $description = $video['description'];
        $image_file = $video_id .  "." . explode(".", $video['image_file'])[count(explode(".", $video['image_file'])) - 1];
        $category_id = $video['category_id'];




        $id = DB::table("songs")->insertGetId([
            'title' => $title,
            'description' => $video['description'],
            'slug' => $video['slug'],
            'audio_file_size' => $video['audio_file_size'],
            'image_file' => $image_file,

            'audio_file' => "$video_id.mp3",
            'category_id' => $category_id,
            'video_id' => $video_id

        ]);
    }
}
