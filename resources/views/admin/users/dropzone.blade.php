<!-- <!DOCTYPE html>
<html>
<head>
    <title>Drag & Drop File Uploading using Laravel 8 Dropzone JS - Tutsmake.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
     
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
     
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
</head>
<body> -->
@extends('layouts.admin')

@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info radius-0 text-light"><b>Upload Image for "{{$user ? $user->name : 'User'}}" </b></div>
                <div class="card-body">
                    <form action="{{ route('admin.user.dropzone.store',$user->id) }}" method="post" enctype="multipart/form-data" id="image-upload" class="dropzone">
                        @csrf

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
    Dropzone.options.imageUpload = {
        maxFilesize: 1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif"
    };
</script>

<!-- </body>
</html> -->