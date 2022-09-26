
<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $site_title }} | DJtelugu.com- Bollywood Dj Song Download, New Dj Remix Mp3 Song Download</title>
    <link rel="canonical" href="{{ $site_url }}/" />
    <meta name="robots" content="index, follow" />
    <meta name="og_title" property="og:title"
        content="DJtelugu.com - Bollywood Dj Song Download, New Dj Remix Mp3 Song Download" />
    <meta name="og_description" property="og:description"
        content="DJtelugu.com - Bollywood Dj Song Download, New Dj Remix Mp3 Song Download" />
    <meta name="og_url" property="og:url" content="{{ $site_url }}/" />
    <meta name="og_site_name" property="og:site_name" content="DJtelugu.com" />
    <meta name="twitter:card" property="twitter:card" content="summary" />
    <meta name="twitter:url" property="twitter:url" content="{{ $site_url }}/" />
    <meta name="twitter:site" property="twitter:site" content="@alldjsmashup" />
    <meta name="twitter:title" property="twitter:title"
        content="DJtelugu.com - Bollywood Dj Song Download, New Dj Remix Mp3 Song Download" />
    <meta name="twitter:description" property="twitter:description"
        content="DJtelugu.com - Bollywood Dj Song Download, New Dj Remix Mp3 Song Download" />
    <meta name="og_image" property="og:image" content="{{ $site_url }}/images/android-chrome-512x512.png" />
    <meta name="msapplication-TileImage" content="{{ $site_url }}/images/android-chrome-512x512.png" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta name="twitter:image" property="twitter:image"
        content="{{ $site_url }}/images/android-chrome-512x512.png" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" />

    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png" />
    <meta name="description"
        content="Latest Hindi Dj Song Bollywood Dj Remix Old Vs New Dj Mashup 2022 All Old Hindi Dj Remix Song Download and Listen Online Play" />
    <meta name="keywords"
        content="hindi dj remix song, old hindi dj song, hindi dj song remix, new dj remix song download, latest bollywood dj mashup songs, all type latest dj artist remix song free download" />

    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="msapplication-TileColor" content="#3d3d3d" />
    <meta name="theme-color" content="#3d3d3d" />
    <meta name="msapplication-navbutton-color" content="#3d3d3d" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#3d3d3d" />
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <nav class="navbar">
        <div class="navigation">
            <section class="_Logo"><a class="" href="{{ $site_url }}" title="DJtelugu.com"
                    rel="bookmark" style="font-size: 30px;color:white;font-family:fantasy;padding:10px ">DJtelugu</a></section>
        </div>
    </nav>

    <div class="clearDiv"></div>
    <div id="container">
        <h2 class="heading">{{ $site_title }}</h2>
        <div id="maindata">
           @yield('content')

        </div>

    </div>

    <script type='text/javascript'>
        $(document).ready(function() {
            $('img#closed').click(function() {
                $('#bl_banner').hide(90);
            });
        });
    </script>

 
       <br><br>
        <div class="footer text-center">
            <div><a href="{{ route('privacy') }}">Privacy Policy</a> | <a href="{{ route('terms') }}">Terms of
                    Condition</a> | <a href="{{ route('disclaimer') }}">Disclaimer</a> | <a
                    href="{{ route('about') }}">About Us</a> |
                <a href="{{ route('contact') }}">Contact Us</a>
            </div>
            <a href="/">©2017 - 2022 {{ $site_title }}</a>
            <div class="smalltext">Powered By : AlldjsMashup Records</div>
        </div>
</body>
</html>
