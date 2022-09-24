@extends('layouts.admin')
@section('content')
    <div class="container container-sm">
        <h1>Post Creation</h1>

        <section>
            <form action="{{ route('admin.keyword.video') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="name">video Id</label>
                        <input type="text" class="form-control" name="video_id" required>
                    </div>

                    <div class="form-group  col-sm-6 text-center">
                        <label>Choose category</label> <br>
                        <select name="category_id" class="form-control" id="">
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6 text-center">
                        <button class="btn btn-primary">create</button>
                    </div>

                </div>

            </form>
        </section>
    </div>
@endsection
