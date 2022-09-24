<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Setting;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
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
        $videoId = request('video_id');

        $category_id = request('category_id');


        // $this->downloadYoutube($video_id);
        // $this->save_to_db($video);
        return redirect()->back()->with('success', " Posts Uploaded  Successfully");
    }


    public function store()
    {
        $count = 0;
        $keyword = request('keyword');
        $results = request('results');
        $category_id = request('category_id');

        $videos = $this->get_videos($keyword, $results);


        foreach ($videos as $video) {
            $video['category_id'] = $category_id;
            $video_id = $video['video_id'];
            $this->downloadYoutube($video_id, $video['image_file']);

            $this->save_to_db($video);
            $count++;
            if ($count == $results) {
                break;
            }
        }


        return redirect()->back()->with('success', "$count Posts Uploaded  Successfully");
    }




















    public function get_videos($keyword, $results)
    {
        $videos = array();
        $apiKey = Setting::where('property', 'api_key')->first()->value;
        // $apiKey = "AIzaSyAq4ij7a8PeBBtxtnxOuRA8acoBX8McQcI";
        $reponse = Http::get("https://youtube.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=$results&playlistId=$keyword&key=$apiKey");
        if ($reponse) {
            $items =  json_decode($reponse)->items;
            foreach ($items as $item) {
                if ($item->snippet->resourceId->kind == "youtube#video") {
                    $video = array();
                    $video['video_id'] = $item->snippet->resourceId->videoId;
                    $video['title'] = $item->snippet->title;
                    $video['description'] = $item->snippet->description;
                    $video['image_file'] = $item->snippet->thumbnails->default->url;
                    array_push($videos, $video);
                }
            }
        }
        return $videos;
    }

    public function downloadYoutube($videoId, $thumbnail)
    {
        set_time_limit(0);
        $download_url = "";
        $video_file = $videoId . ".mp4";
        $image_file = $videoId .  "." . explode(".", $thumbnail)[count(explode(".", $thumbnail)) - 1];
        $youtube = new youtubeDownloader();
        try {
            $downloadOptions = $youtube->getDownloadLinks("https://www.youtube.com/watch?v=$videoId");
            if ($downloadOptions->getAllFormats()) {
                $download_url = $downloadOptions->getFirstCombinedFormat()->url;
            } else {
                // echo 'No links found';
            }
        } catch (YouTubeException $e) {
            // echo 'Something went wrong: ' . $e->getMessage();
        }
        if (!empty($download_url) && substr($download_url, 0, 8) === 'https://') {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment;filename=\"$video_file\"");
            header("Content-Transfer-Encoding: binary");

            // readfile($downloadURL);
            file_put_contents("uploads/videos/$video_file", fopen($download_url, 'r'));
            FFMpeg::fromDisk("local")
                ->open("uploads/videos/$videoId.mp4")
                ->export()
                ->toDisk("local")
                ->inFormat(new \FFMpeg\Format\Audio\Mp3)
                ->save("uploads/audios/$videoId.mp3");
        }
        if (!empty($thumbnail) && substr($thumbnail, 0, 8) === 'https://') {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment;filename=\"$image_file\"");
            header("Content-Transfer-Encoding: binary");

            // readfile($thumbnail);
            file_put_contents("uploads/images/$image_file", fopen($thumbnail, 'r'));
        }
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
            'description' => "",
            'image_file' => $image_file,
            'video_file' => "$video_id.mp4",
            'audio_file' => "$video_id.mp3",
            'category_id' => $category_id,
            'video_id' => $video_id

        ]);
    }
}
