@extends('components.layouts.main')
@section('content')
    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="titleHelp" placeholder="Enter title">
            <small id="titleHelp" class="form-text text-muted">We'll never share your name with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="content">content</label>
            <input type="text" class="form-control" id="content" name="content" aria-describedby="contentHelp" placeholder="Enter text content">
            <small id="contentHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div>
            <label for="users">Users</label>
            <select id="users" class="form-select m-auto" name="user_id">
                @foreach($users as $user)
                    <option class="" value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-3">
            <label for="categories">Category</label>
            <select id="categories" class="form-select m-auto" name="category_id">
                @foreach($categories as $cat)
                    <option class="" value="{{$cat->id}}">{{$cat->title}}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-3">
            <label for="tags">Tags</label>
            <select multiple id="tags" class="form-control" name="tags[]">
                @foreach($tags as $tag)
                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
            </select>
        </div>

        <input type="file" class="form-control mt-4" name="image" id="image">


        <button type="submit" class="btn btn-primary mt-4">Submit</button>
        <a href="{{route('post.index')}}"><button type="button" class="btn btn-primary mt-4">back</button></a>
    </form>
@endsection
