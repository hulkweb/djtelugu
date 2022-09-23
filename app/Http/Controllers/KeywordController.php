<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Setting;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class KeywordController extends Controller
{
    public function create()
    {
        $data = array();
       
        $data['categories'] = Category::all();
        return view('admin.create_keyword', $data);
    }


    public function store()
    {
        $keyword = request('keyword');
        $results = request('results');
        $category_id = request('category_id');

        $count = 0;
        $videoIds = $this->get_video_ids($keyword, $results);

        foreach ($videoIds as $videoId) {
            $arr = $this->download_from_videoId($videoId);

            FFMpeg::fromDisk("local")
                ->open("uploads/videos/$videoId.mp4")
                ->export()
                ->toDisk("local")
                ->inFormat(new \FFMpeg\Format\Audio\Mp3)
                ->save("uploads/audios/$videoId.mp3");


            $id = DB::table("songs")->insertGetId([
                'title' => $arr['title'],
                'description' => $arr['description'],
                'image_file' => $arr['image_file'],
                'video_file' => "$videoId.mp4",
                'audio_file' => "$videoId.mp3",
                'category_id' => $category_id,
                'video_id' => $videoId

            ]);
            $count++;
        }




        return redirect()->back()->with('success', "$count Posts Uploaded  Successfully");
    }


    public function get_video_ids($keyword, $results)
    {
        $apiKey = Setting::where('property', 'api_key')->first()->value;
        // $apiKey = "AIzaSyAq4ij7a8PeBBtxtnxOuRA8acoBX8McQcI";
        $videoIds = array();
        $reponse = Http::get("https://youtube.googleapis.com/youtube/v3/search?part=snippet&maxResults=$results&q=$keyword&key=$apiKey");
        if ($reponse) {
            $items =  json_decode($reponse)->items;
            foreach ($items as $item) {
                if ($item->id->kind == "youtube#video") {
                    $videoIds[] = $item->id->videoId;
                }

                // $videoIds['title'] = $item->snippet->title;
                // $videoIds['description'] = $item->snippet->description;
                // $videoIds['image_file'] = $item->snippet->thumbnails->default->url;
            }
        }
        return $videoIds;
    }

    public function download_from_videoId($video_id)
    {
        $video = json_decode($this->getVideoInfo($video_id));
        $formats = $video->streamingData->formats;
        $adaptiveFormats = $video->streamingData->adaptiveFormats;
        $thumbnails = $video->videoDetails->thumbnail->thumbnails;
        $title = $video->videoDetails->title;
        $short_description = $video->videoDetails->shortDescription;
        $thumbnail = end($thumbnails)->url;
        $downloadURL = "";
        $type = "";
        $video_file = $video_id . ".mp4";
        $image_file =  $video_id . "." . explode(".", $thumbnail)[count(explode(".", $thumbnail)) - 1];

        foreach ($formats as $format) {
            $downloadURL =  $format->url;
            $type = $format->mimeType;
        }

        if (!empty($downloadURL) && substr($downloadURL, 0, 8) === 'https://') {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment;filename=\"$video_file\"");
            header("Content-Transfer-Encoding: binary");

            // readfile($downloadURL);
            file_put_contents("uploads/videos/$video_file", fopen($downloadURL, 'r'));
        }

        if (!empty($thumbnail) && substr($thumbnail, 0, 8) === 'https://') {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment;filename=\"$image_file\"");
            header("Content-Transfer-Encoding: binary");

            // readfile($thumbnail);
            file_put_contents("uploads/images/$image_file", fopen($thumbnail, 'r'));
        }
        return ['title' => $title, 'description' => $short_description, 'image_file' => $image_file];
    }

    public function getVideoInfo($video_id)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://www.youtube.com/youtubei/v1/player?key=AIzaSyAO_FJ2SlqU8Q4STEHLGCilw_Y9_11qcW8');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{  "context": {    "client": {      "hl": "en",      "clientName": "WEB",      "clientVersion": "2.20210721.00.00",      "clientFormFactor": "UNKNOWN_FORM_FACTOR",   "clientScreen": "WATCH",      "mainAppWebInfo": {        "graftUrl": "/watch?v=' . $video_id . '",           }    },    "user": {      "lockedSafetyMode": false    },    "request": {      "useSsl": true,      "internalExperimentFlags": [],      "consistencyTokenJars": []    }  },  "videoId": "' . $video_id . '",  "playbackContext": {    "contentPlaybackContext": {        "vis": 0,      "splay": false,      "autoCaptionsDefaultOn": false,      "autonavState": "STATE_NONE",      "html5Preference": "HTML5_PREF_WANTS",      "lactMilliseconds": "-1"    }  },  "racyCheckOk": false,  "contentCheckOk": false}');
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }
}
