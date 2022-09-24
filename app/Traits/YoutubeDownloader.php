
<?php 
 trait YoutubeTrait{
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
        if (!empty($formats)) {

            if (!isset($formats[0]->url)) {
                $signature = "https://example.com?" . $formats[0]->signatureCipher;
                parse_str(parse_url($signature, PHP_URL_QUERY), $parse_signature);
                $downloadURL = $parse_signature['url'] . "&sig=" . $parse_signature['s'];
                echo "<br><br><br><br>";
                print_r($downloadURL);
                return [
                    'title' => $title,
                    'description' => $short_description,
                    'image_file' => $image_file,
                    'errore' => true
                ];
            }

            foreach ($formats as $format) {
                if ($format->url == "") {
                    $signature = "https://example.com?" . $format->signatureCipher;
                    parse_str(parse_url($signature, PHP_URL_QUERY), $parse_signature);
                    $downloadURL = $parse_signature['url'] . "&sig=" . $parse_signature['s'];
                } else {
                    $downloadURL = $format->url;
                }

                $type = $format->mimeType;
            }
            echo $downloadURL;
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
        return [
            'title' => $title,
            'description' => $short_description,
            'image_file' => $image_file,
            'errore' => false
        ];
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
    // $reponse = Http::get("https://youtube.googleapis.com/youtube/v3/search?part=snippet&maxResults=$results&q=$keyword&key=$apiKey");
        // if ($reponse) {
        //     $items =  json_decode($reponse)->items;
        //     foreach ($items as $item) {
        //         if ($item->id->kind == "youtube#video") {
        //             $videoIds[] = $item->id->videoId;
        //         }
        //     }
        // }
 }


?>