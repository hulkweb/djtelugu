@extends('layouts.admin')
@section('content')
    <h1>Welcome</h1>
    <div class="header-responsive d-flex flex-wrap mb-4 mt-4" style="justify-content:space-between">


    </div>
    <div class="mt-2">
        <div class="row" id="data">

            <div class="col-sm-3 p-4">
                <a href="admin/songs" class="card m-0 p-0">
                    <div class="card  shadow ">
                        <i class="fa fa-music fa-3x" aria-hidden="true"></i>
                        <br>
                        <h3>songs ( {{ $songs }} )</h3>
                    </div>
                </a>
            </div>
            <div class="col-sm-3 p-4">
                <a href="admin/songs" class="card m-0 p-0">
                    <div class="card  shadow ">
                        <i class="fa fa-bookmark fa-3x" aria-hidden="true"></i>

                        <br>
                        <h3>categories ( {{ $categories }} )</h3>
                    </div>
                </a>
            </div>
            <div class="col-sm-3 p-4">
                <a href="admin/songs" class="card m-0 p-0">
                    <div class="card  shadow ">
                        <i class="fa fa-download fa-3x" aria-hidden="true"></i>
                        <br>

                        <h3>downloads ( {{ $downloads }} )</h3>
                    </div>
                </a>
            </div>
            <div class="col-sm-3 p-4">
                <a href="admin/songs" class="card m-0 p-0">
                    <div class="card  shadow ">
                        <i class="fa fa-eye fa-3x" aria-hidden="true"></i>
                        <br>
                        <h3>views ( {{ $views }} )</h3>
                    </div>
                </a>
            </div>




        </div>
    </div>
@endsection
