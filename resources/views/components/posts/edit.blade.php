@extends('components.layouts.main')
@section('content')
    <form action="{{route('post.update',$post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" value="{{$post->title}}" name="title" aria-describedby="titleHelp" placeholder="Enter title">
            <small id="titleHelp" class="form-text text-muted">We'll never share your name with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="content">content</label>
            <input type="text" class="form-control" id="content" name="content" value="{{$post->content}}" aria-describedby="contentHelp" placeholder="Enter text content">
            <small id="contentHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <select class="form-select m-auto" name="user_id">
            @foreach($users as $user)
                <option
                    {{$user->id == $post->users->id ? 'selected' : ''}}
                    value="{{$user->id}}">{{$user->name}}
                </option>
            @endforeach
        </select>


        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <img src="/storage/image/{{$post->image}}" alt="" width="100">
        </div>
        <input type="file" class="form-control mt-4" name="image" id="image">


        <button type="submit" class="btn btn-primary mt-4">Submit</button>
        <a href="{{route('post.index')}}"><button type="button" class="btn btn-primary mt-4">back</button></a>
    </form>
@endsection
