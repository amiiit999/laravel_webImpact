@extends('layouts.admin')

@section('content')


<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-7">
            <div class="card p-3 py-4">
                @if($image)
                <div class="text-center"> <a href="route('admin.user.dropzone', $user->id)"><img src="{{ url('') }}/images/{{$image->avatar}}" width="150" height="150" class="rounded-circle"></a> </div>
                @else
                <div class="text-center"> <a href="route('admin.user.dropzone', $user->id)"><img src="{{ url('') }}/images/avatar.png" width="150" height="150" class="rounded-circle"></a> </div>
                @endif
                <div class="text-center mt-3"> <span class="bg-secondary p-1 px-4 rounded text-white"><a href="{{route('admin.user.dropzone', $user->id)}}" class="text-white">Change Image</a></span>
                   
                    <div class="px-4 mt-1 text-start">
                        <h3 class="fonts">Name: {{$user->name}}</h3>
                        <p class="fonts">Email: {{$user->email}}</p>
                        <p class="fonts text-capitalize">Role: {{$user->role ? $user->role : 'User'}}</p>
                    </div>
                    
                    <div class="buttons"><a href="{{route('admin.users.edit', $user->id)}}"> <button class="btn btn-outline-primary px-4"> Update </button></a> <form method="post" class="delete_form" action="{{route('admin.users.destroy',$user->id)}}" style="display: inline">@method('DELETE') @csrf <button class="btn btn-danger" type="submit" title="Remove" onclick="return confirm('Are you sure want to delete?')">Delete</i></button>
                                        </form> </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection