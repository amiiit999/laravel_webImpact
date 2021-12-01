@extends('layouts.admin')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-light"><b>{{ __('Add New User') }}</b>

                    <a class="btn btn-sm btn-danger float-right" href="{{route('admin.users.index')}}"> Back</a>
                </div>

                <div class="card-body text-left">


                    <form action="{{route('admin.users.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <strong>Name</strong>
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Name" class="form-control">

                            </div>
                        </div>

                        <div class="col-md-12">
                            <strong>Email</strong>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <strong>Password</strong>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <strong>Confirm Password</strong>
                            <div class="form-group">
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">

                            </div>
                        </div>

                        <div class="col-md-12">
                            <strong>Role</strong>
                            <div class="form-group">
                                <select name="role" id="" class="form-control">
                                    <option value="" selected class="text-secondary">Select</option>
                                    @if($roles)
                                    @foreach($roles as $row)
                                    <option value="{{$row}}" class="text-capitalize">{{$row}}</option>
                                    @endforeach
                                    @else
                                    <option value=""></option>
                                    @endif
                                </select>
                               
                            </div>
                        </div>


                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-sm0 btn-secondary" name="Search">Submit</button>

                            <a class="btn btn-sm0 btn-danger" href="{{ route('admin.users.index') }}" title="">Cancel </a>

                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
        Dropzone.options.imageUpload = {
            maxFilesize: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
        };
    </script>
@endsection