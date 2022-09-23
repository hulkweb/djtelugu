@extends('layouts.admin')
@section('content')
    <div class="container">
        <h2>Recent Categories</h2>

       
        <div class="container">
           
       
        <table class="table portal-table section asd">
            <thead>
                <tr>
                    <th>
                        Num
                    </th>
                    
                    <th>
                        <a href="#" class="" data-pjax>Title</a>
                    </th>
                   
                    <th>
                        <a href="#" class="" data-pjax>Action</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $i=>$post)
                    <tr>
                      <th>
                               {{$i+1}}
                      </th>
                        <th>
                            <a href="#" class="" data-pjax>{{ $post->title }}</a>
                        </th>
                      
                        <th>
                            <a class="btn btn-danger m-1" href="/admin/post/delete/{{ $post->id }}"> <i
                                    class="fa fa-trash"></i> </a>

                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    </div>
@endsection
