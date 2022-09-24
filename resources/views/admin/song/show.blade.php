<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ ucfirst($song->title) }} Song Download</title>
    <meta name="description"
        content="Free Download {{ ucfirst($song->title) }} Song from Category {{ $song->category->title }} 2022 Latest Dj Remix Song AllDjsMashup" />
    <meta name="keywords" content="{{ ucfirst($song->title) }}, {{ $song->category->title }}" />
    <link rel="canonical" href="{{ $site_url }}/song/{{ $song->id }}/{{ str_replace(' ', '-', $song->title) }}" />
    <meta name="robots" content="index, nofollow" />
    <meta name="og_title" property="og:title" content="{{ ucfirst($song->title) }} Song Download" />
    <meta name="og_description" property="og:description" content="{{ ucfirst($song->title) }} Song Download" />
    <meta name="og_url" property="og:url"
        content="{{ $site_url }}/song/{{ $song->id }}/{{ str_replace(' ', '-', $song->title) }}" />
    <meta name="og_site_name" property="og:site_name" content="{{ $site_title }}" />
    <meta name="twitter:card" property="twitter:card" content="summary" />
    <meta name="twitter:url" property="twitter:url"
        content="{{ $site_url }}/song/{{ $song->id }}/{{ str_replace(' ', '-', $song->title) }}" />
    <meta name="twitter:site" property="twitter:site" content="@alldjsmashup" />
    <meta name="twitter:title" property="twitter:title" content="{{ ucfirst($song->title) }} Song Download" />
    <meta name="twitter:description" property="twitter:description"
        content="{{ ucfirst($song->title) }} Song Download" />
    <meta name="og_image" property="og:image" content="{{ $site_url }}/uploads/images/{{ $song->image_file }}" />
    <meta name="msapplication-TileImage" content="{{ $site_url }}/uploads/images/{{ $song->image_file }}" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta name="twitter:image" property="twitter:image"
        content="{{ $site_url }}/uploads/images/{{ $song->image_file }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" />

    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png" />

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
            <section class="_Logo"><a class="logo" href="{{ $site_url }}" title="{{ $site_title }}"
                    rel="bookmark">{{ $site_title }}</a></section>
        </div>
    </nav>

    <div class="clearDiv"></div>
    <div id="container">
        <div class="search">
            <form method="get" action="{{ route('admin.song.search') }}"><input type="text" name="q"
                    value="" placeholder="Search Any Songs" /><button type="submit"
                    value="Search">Search</button></form>
        </div>
        <div id="mainData">


            <h1 class="heading">{{ ucfirst($song->title) }} Song</h1>

            <div class="albumCover">
                <img width="210" height="210" alt="{{ ucfirst($song->title) }}" class="abs-thumb"
                    src="{{ $site_url }}/uploads/images/{{ $song->image_file }}" />
            </div>
            <div class="albumInfo">
                <p class="style18">Name: <span class="c24">{{ ucfirst($song->title) }} Song Download</span></p>
                <p class="style18">Added On: <span
                        class="c24">{{ date('d M Y', strtotime($song->created_at)) }}</span></p>
                <p class="style18">Category: <span class="class24"><a title="{{ $song->category->title }}"
                            href="{{ $site_url }}/track/{{ $song->category->id }}/{{ $song->category->title }}">Hindi
                            New Dj Remix
                            Song</a></span></p>
                <p class="sharebtn">
                    <span
                        onclick="window.location='whatsapp://send?text=*1st%20On%20Net:-%20Hey%20Bro%20Song%20Dj%20Remix%20From:-%20AllDjsMashup*%20{{ $site_url }}/song/{{ $song->id }}/{{ str_replace(' ', '-', $song->title) }}'"
                        rel="nofollow"><i class="fa fa-whatsapp" aria-hidden="true"></i></span>
                    <span
                        onclick="window.location='https://www.facebook.com/sharer/sharer.php?u={{ $site_url }}/song/{{ $song->id }}/{{ str_replace(' ', '-', $song->title) }}'"
                        rel="nofollow" target="_blank">
                        <i class="fa fa-facebook" aria-hidden="true"></i></span>
                    <span
                        onclick="window.location='https://twitter.com/home?status={{ $site_url }}/song/{{ $song->id }}/{{ str_replace(' ', '-', $song->title) }}'"
                        rel="nofollow">
                        <i class="fa fa-twitter" aria-hidden="true"></i></span>
                    <span
                        onclick="window.location='mailto:example@gmail.com?subject={{ ucfirst($song->title) }}&amp;body=*1st%20On%20Net:-%20Hey%20Bro%20Song%20Dj%20Remix%20From:-%20MumbaiRemix%20Records*%20{{ $site_url }}/song/{{ $song->id }}/{{ str_replace(' ', '-', $song->title) }}'"
                        rel="nofollow"><i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                </p>
                <p class="style18">
                    <audio controls preload="none">
                        <source src="{{ $site_url }}/uploads/audios/{{ $song->audio_file }}" />
                    </audio>
                </p>


                <p class="style18"><a class="dlbtn bg1" rel="nofollow" title="  DOWNLOAD MP3 - 4.22 mb"
                        href="{{ $site_url }}/download/{{ $song->id }}/{{ str_replace(' ', '-', $song->title) }}"><i
                            class="fa fa-download" aria-hidden="true"></i> DOWNLOAD MP3 - 4.22 mb</a></p>
            </div>
            <div class="downLoad">

            </div>
            <div class="clearDiv"></div>

            <div class="List tags">
                <p>Tags: {{ ucfirst($song->title) }} Download, {{ ucfirst($song->title) }} Song Download,
                    {{ ucfirst($song->title) }}
                    Song Download, arjit singh mashup, {{ ucfirst($song->title) }} dj song download, bollywood mashup
                    songs,
                    {{ ucfirst($song->title) }} remix song download, {{ ucfirst($song->title) }} mashup song,
                    {{ ucfirst($song->title) }}
                    new dj remix song, love mashup song download, Download {{ ucfirst($song->title) }} Song from Hindi
                    New Dj
                    Remix Song, {{ ucfirst($song->title) }} hindi dance songs dj remix mp3 download
                </p>
            </div>




            <div class="path"><a title="Home" href="{{ $site_url }}/">Home</a> &raquo; <a
                    title="Bollywood Remix Song" href="{{ $site_url }}/track/{{ $song->category->id }}/{{ str_replace(' ', '-', $song->category->title) }}">{{$song->category->title}}</a> &raquo;
                <a title="{{ $song->category->title }}"
                    href="{{ $site_url }}/track/{{ $song->category->id }}/{{ $song->category->title }}">{{ $song->title }}</a>
            </div>

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
            <h2 class="heading"><i class="fa fa-random" aria-hidden="true"></i>
                Releted Songs</h2>
            @foreach ($related as $song)
                <div class="fl odd">
                    <a class="fileName"
                        href="{{ $site_url }}/song/{{ $song->item }}/{{ str_replace(' ', '-', $song->title) }}">
                        <div>
                            <div><img height="80" class="absmiddle"
                                    src="{{ $site_url }}/uploads/images/{{ $song->image_file }}"
                                    alt="3279_7" /></div>
                            <div>{{ $song->title }}.mp3<br /><span>4.58 mb</span><br /></div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div> <!-- END SIDEBAR -->
        <div class="clearDiv"></div>
    </div>



    <div id='fixedban'
        style='width:100%;margin:auto;text-align:center;float:none;overflow:hidden;display:scroll;position:fixed;bottom:0;z-index:999;-webkit-transform:translateZ(0);'>

        <div>

            <a id='close-fixedban' onclick='document.getElementById("fixedban").style.display = "none";'
                style='cursor:pointer;'><img alt='close' src='/images/close.webp' title='close button'
                    style='vertical-align:middle;' /></a>
        </div>


    </div>
    <div class="footer text-center">
        <div><a href="/info/privacypolicy">Privacy Policy</a> | <a href="/info/termsofcondition">Terms of
                Condition</a> | <a href="/info/disclaimer">Disclaimer</a> | <a href="/info/about">About Us</a> | <a
                href="/info/contact">Contact Us</a></div>
        <a href="/">©2017 - 2022 {{ $site_title }}</a>
        <div class="smalltext">Powered By : AlldjsMashup Records</div>
    </div>

</html>
