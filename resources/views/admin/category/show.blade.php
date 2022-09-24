<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $site_title }} - Bollywood Dj Song Download, New Dj Remix Mp3 Song Download</title>
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
            <section class="_Logo"><a class="" href="{{ $site_url }}" title="DJtelugu.com" rel="bookmark"
                    style="font-size: 30px;color:white;font-family:fantasy;padding:10px ">{{ $site_title }}</a>
            </section>
        </div>
    </nav>

    <div class="clearDiv"></div>
    <div id="container">
        <div class="search">
            <form method="get" action="{{route('admin.song.search')}}"><input type="text" name="q" value=""
                    placeholder="Search Any Songs" /><button type="submit"
                    value="Search">Search</button></form>
        </div>
        <div id="mainData">


            <h2 class="heading"><i class="fa fa-file-audio-o" aria-hidden="true"></i> Latest Singles <a
                    class="morbtn f-right" href="{{ $site_url }}/lastadded">More+</a></h2>
            <div id="dle-content">
                @foreach ($songs as $song)
                    <a href="{{ $site_url }}/song/{{ $song->id }}/{{ str_replace(' ', '-', $song->title) }}">
                        <article class="movie-item movie-item1">
                            <div class="movie-cols movie-cols1 clearfix">
                                <div class="movie-img movie-img1 img-box pseudo-link">
                                    <div class="movie-img-inner">
                                        <i class="fa fa-file-audio-o" data-link=""></i>
                                    </div>
                                    <img width="180" height="180" alt="{{ ucfirst($song->title) }}"
                                        src="{{ $site_url }}/uploads/images/{{ $song->image_file }}" />
                                </div>
                                <div class="movie-text movie-text1">
                                    <div class="movie-title cardname">{{ ucfirst($song->title) }} </div>
                                </div>
                            </div>
                        </article>
                    </a>
                @endforeach



            </div>
            <div class="clearDiv"></div>
            <div class="clearDiv"></div>
        </div> <!-- END MAINDTATA -->
        <div id="sidebar">
            <div class="heading text-auto"><i class="fa fa-folder-open" aria-hidden="true"></i> Categories</div>
            <div class="clearDiv"></div>
            <div class="List">
                @foreach ($categories as $category)
                    <div class="catRow">
                        <a
                            href="{{ $site_url }}/track/{{ $category->id }}/{{ str_replace(' ', '-', $category->title) }}">
                            <div><i class="fa fa-folder-o" aria-hidden="true"></i> {{ ucfirst($category->title) }}
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="clearDiv"></div>
            <div class="heading"><i class="fa fa-facebook-square" aria-hidden="true"></i> Follow Facebook</div>
            <div class="clearDiv"></div>
            <h2 class="heading"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> Popular Today's</h2>
            @foreach ($popular as $song)
                <div class="fl odd">
                    <a
                        href="{{ $site_url }}/track/{{ $song->id }}/{{ str_replace(' ', '-', $song->title) }}">
                        <div>
                            <div> <img width="80" height="80" title="{{ ucfirst($song->title) }}"
                                    src="{{ $site_url }}/uploads/images/{{ $song->image_file }}"
                                    alt="23347_7" /></div>
                            <div><span class="rank">#1</span>{{ ucfirst($song->title) }}<br /><span
                                    class="alb">{{ ucfirst($song->category->title) }}</span><br /></div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div> <!-- END SIDEBAR -->
        <div class="clearDiv"></div>
    </div>


    <script type='text/javascript'>
        $(document).ready(function() {
            $('img#closed').click(function() {
                $('#bl_banner').hide(90);
            });
        });
    </script>


    <br><br>br
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
