@extends('layouts.admin')
@section('content')
    <div class="container">
        <h2>Recent Posts</h2>

        <div class="header-reponsive">
            <button class="btn btn-danger" id="delete_all" onclick="deleteAll()">Delete</button>
        </div>
        <table class="table portal-table section asd">
            <thead>
                <tr>
                    <th>
                        Num
                    </th>
                    <th>
                        Thumnail
                    </th>
                    <th>
                        <a href="#" class="" data-pjax>Title</a>
                    </th>
                    <th>
                        <a href="#" class="" data-pjax>Audio</a>
                    </th>

                    <th>
                        <a href="#" class="" data-pjax>Category</a>
                    </th>
                    <th>
                        <a href="#" class="" data-pjax>views</a>
                    </th>
                    <th>
                        <a href="#" class="" data-pjax>downloads</a>
                    </th>
                    <th>
                        <a href="#" class="" data-pjax>Action</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($songs as $post)
                    <tr>
                        <th>
                            <input type="checkbox" name="delete" value="{{ $post->id }}" class="checkboxes">
                        </th>
                        <th>
                            <img src="/uploads/images/{{ $post->image_file }}" height="80">
                        </th>
                        <th>
                            <a href="#" class="" data-pjax>{{ $post->title }}</a>
                        </th>
                        <th>
                            <Audio src="/uploads/audios/{{ $post->audio_file }}" controls>
                            </Audio>

                        </th>
                        <th>
                            <a href="#" class="" data-pjax>{{ $post->category->title }}</a>
                        </th>
                        <th>
                            <a href="#" class="" data-pjax>{{ $post->views }}</a>
                        </th>
                        <th>
                            <a href="#" class="" data-pjax>{{ $post->downloads }}</a>
                        </th>
                        <th>
                            <a class="btn btn-danger m-1" href="/admin/song/delete/{{ $post->id }}"> <i
                                    class="fa fa-trash"></i> </a>

                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
@endsection
