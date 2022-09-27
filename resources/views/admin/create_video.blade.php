@extends('layouts.admin')
@section('content')
    <div class="container container-sm">
        <h1><i class="fa fa-upload" aria-hidden="true"></i> &nbsp;&nbsp; Upload Song</h1>

        <section>
            <form action="{{ route('admin.keyword.video') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">

                    <div class="form-row px-2 py-3">
                        <div class="form-group  col-sm-6 ">
                            <label>Type</label> <br>
                            <select name="file_type" class="form-control" onchange="checkType(this.value)" id="">

                                <option value="URL">URL</option>
                                <option value="FILE">FILE</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6" id="URL">
                            <label for="name">Youtube video Link</label>
                            <input type="text" class="form-control" name="video_id">
                        </div>
                        <div class="form-group col-sm-6" id="FILE" style="display: none">
                            <label for="name">Audio file</label>
                            <input type="file" class="form-control" accept="audio/*" name="audio_file">
                        </div>


                    </div>
                    <div class="form-row px-2 py-3">
                        <div class="form-group col-sm-6">
                            <label for="name">Name</label>
                            <input type="text" id="title" class="form-control" name="title"
                                onchange="genrateSlug(this.value)" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="name">Slug</label>
                            <input type="text" id="slug" class="form-control" name="slug" required>
                        </div>
                    </div>
                    <div class="form-row">


                        <div class="form-group  col-sm-6 ">
                            <label>Choose category</label> <br>
                            <select name="category_id" class="form-control" id="">
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6" id="thumb" style="display: none">
                            <label for="name">ThumbImage</label>
                            <input type="file" class="form-control" accept="image/*" name="image_file">
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-10 py-3">
                            <label>Desciption</label> <br>

                            <textarea name="description" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6 text-center m-auto">
                            <button class="btn btn-primary" type="submit"> create</button>
                        </div>
                    </div>

                </div>
            </form>
        </section>
    </div>
    <script>
        const URL = document.getElementById("URL");
        const FILE = document.getElementById("FILE");
        const title = document.getElementById("title");
        const slug = document.getElementById("slug");
        const thumb = document.getElementById("thumb");

        function checkType(type) {
            if (type == 'URL') {
                URL.style.display = "block";
                FILE.style.display = "none";
                thumb.style.display = "none";
            } else {
                URL.style.display = "none";
                FILE.style.display = "block";
                thumb.style.display = "block";

            }
        }

        function genrateSlug(val) {

            var val = val.trim().toLowerCase();
            var pointer = 0;
            var last = 0;
            var newstr = "";
            for (var s = 0; s < val.length; s++) {
                var temp = val[s];
                if (val[s] == ' ' || val[s] == '|') {
                    pointer++;
                    temp = '-';
                    if (pointer == 4) {
                        break;
                    }
                }
                newstr += temp;
            }

            slug.value = newstr;
        }
    </script>
@endsection
