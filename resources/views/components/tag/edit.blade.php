@extends('components.layouts.main')
@section('content')
    <form action="{{route('tag.update',$tag->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" value="{{$tag->name}}" name="name" aria-describedby="nameHelp" placeholder="Enter name">
            <small id="nameHelp" class="form-text text-muted">We'll never share your name with anyone else.</small>
            @error('name')
            <p class="btn-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="content">Status</label>
            <input type="text" class="form-control" id="Status" name="status" value="{{$tag->status}}" aria-describedby="statusHelp" placeholder="Enter Status">
            <small id="statusHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            @error('status')
            <p class="btn-danger">{{$message}}</p>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary mt-4">Submit</button>
        <a href="{{route('tag.index')}}"><button type="button" class="btn btn-primary mt-4">Back</button></a>
    </form>
@endsection
