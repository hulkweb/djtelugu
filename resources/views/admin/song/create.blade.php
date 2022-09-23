@extends('layouts.admin')
@section('content')
    <h1>Upload Psd</h1>
    <form method="post" action="{{ route('admin.song.store') }}" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-5">
                @csrf
                <div class="form-group">
                    <label>title</label>
                    <input type="text" name="title" class="form-control" placeholder="Ex. Mahaveer , brambedkar ">
                </div>

                <div class="form-group">
                    <label>Choose category</label> <br>
                    <select name="category_id" class="form-control" id="">
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Descripion</label> <br>
                    <textarea name="details" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Image File </label>
                    <input type="file" name="image_file" class="form-control" accept="image/*">
                </div>
                <div class="form-group">
                    <label>Audio File</label>
                    <input type="file" name="audio_file" class="form-control" accept="audio/*">
                </div>


                <button class="btn btn-primary" name="upload_photopatti">Upload</button>

            </div>

        </div>
    </form>
    <script>
        let normal = 1;
        let reseller = 1;

        function AddNormalPsd() {
            normal++;
            $("#normal_psd").html($("#normal_psd").html() +
                ` <div class="form-group">
                        <label>Reseller PSD ${normal}</label>
                        <input type="file" name="normal_${normal}" class="form-control">
            </div>`);

            $("#count").val(normal);
        }

        function AddResellerPsd() {
            reseller++;
            $("#reseller_psd").html($("#reseller_psd").html() +
                `<div class="form-group">
                        <label>Reseller PSD ${reseller}</label>
                        <input type="file" name="reseller_${reseller}" class="form-control">
            </div>`);
            $("#reseller_count").val(reseller);
        }
    </script>
@endsection
