@extends('layouts.admin')
@section('content')
    <div class="container container-sm">
        <h1>Artist Creation</h1>

        <section>
            <form action="{{ route('admin.artist.store') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="name">Artist Name</label>
                        <input type="text" class="form-control" name="name" v required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="name"> Image</label>
                        <input type="file" class="form-control" name="image_file" v required>
                    </div>
                    <div class="form-group col-sm-6 text-center">
                        <button class="btn btn-primary">create</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection
