@extends('layouts.admin')
@section('content')
    <div class="container container-sm">
        <h1>Post Creation</h1>

        <section>
            <form action="{{route('admin.category.store')}}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="name">Category Name</label>
                        <input type="text" class="form-control" id="name_f" name="title" v required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="name">Category details</label>
                        <input type="text" class="form-control" id="name_f" name="details" v required>
                    </div>
                    <div class="form-group col-sm-6 text-center">
                        <button class="btn btn-primary">create</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection
