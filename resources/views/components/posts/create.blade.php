@extends('components.layouts.main')
@section('content')
    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text"  class="form-control" id="title" name="title" value="{{old('title')}}" aria-describedby="titleHelp" placeholder="Enter title">
            <small id="titleHelp" class="form-text text-muted">We'll never share your name with anyone else.</small>
            @error('title')
            <p class="btn-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="content">content</label>
            <input type="text" class="form-control" id="content" name="content" value="{{old('content')}}" aria-describedby="contentHelp" placeholder="Enter text content">
            <small id="contentHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            @error('content')
            <p class="btn-danger">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="users">Users</label>
            <select id="users" class="form-select m-auto" name="user_id">
                @foreach($users as $user)
                    <option
                        {{$user->id  == old('user_id') ? 'selected' : ''}}
                        class="" value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-3">
            <label for="categories">Category</label>
            <select id="categories" class="form-select m-auto" name="category_id">
                @foreach($categories as $cat)
                    <option
                        {{$cat->id  == old('category_id') ? 'selected' : ''}}
                        class="" value="{{$cat->id}}">{{$cat->title}}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-3">
            <label for="tags">Tags</label>
            <select multiple id="tags" class="form-control" name="tags[]">
                @foreach($tags as $tag)
                    <option
                        @if(old('tags'))
                        {{in_array($tag->id,old('tags')) ? 'selected' : ''}}
                        @endif
                        value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
            </select>
            @error('tags')
            <p class="btn-danger">{{$message}}</p>
            @enderror
        </div>

        <input type="file" class="form-control mt-4" name="image" id="image">
        @error('image')
        <p class="btn-danger">{{$message}}</p>
        @enderror

        <button type="submit" class="btn btn-primary mt-4">Submit</button>
        <a href="{{route('post.index')}}"><button type="button" class="btn btn-primary mt-4">back</button></a>
    </form>
@endsection
