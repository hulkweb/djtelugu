@extends('layouts.admin')
@section('content')
    <div class="container container-sm">
        <h1>Post Creation</h1>

        <section>
            <form action="{{ route('admin.keyword.store') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-sm-7">
                        <label for="name">Keyword Name / Playlist Id</label>
                        <input type="text" class="form-control" name="keyword" required>
                    </div>

                    <div class="form-group col-sm-7">
                        <label for="name">No Of videos</label>
                        <input type="number" class="form-control" name="results" value="1" required>
                    </div>
                    <div class="form-group  col-sm-7 ">
                        <label>Choose category</label> <br>
                        <select name="category_id" class="form-control" id="">
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-7 text-center">
                        <button class="btn btn-primary">create</button>
                    </div>

                </div>

            </form>
        </section>
    </div>
@endsection
