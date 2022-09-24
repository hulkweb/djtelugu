@extends('layouts.admin')
@section('content')
    <div class="container">
        <h2>Recent Artists</h2>

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
                        <a href="#" class="" data-pjax>Name</a>
                    </th>

                    <th>
                        <a href="#" class="" data-pjax>Action</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($artists as $i => $artist)
                    <tr>
                        <th>
                            <input type="checkbox" name="delete" value="{{ $artist->id }}" class="checkboxes">
                            {{ $i + 1 }}
                        </th>
                        <th>
                            <img src="/uploads/artists/{{ $artist->image_file }}" height="80">
                        </th>
                        <th>
                            <a href="#" class="" data-pjax>{{ $artist->name }}</a>
                        </th>

                        <th>
                            <a class="btn btn-danger m-1" href="/admin/artist/delete/{{ $artist->id }}"> <i
                                    class="fa fa-trash"></i> </a>

                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
@endsection
