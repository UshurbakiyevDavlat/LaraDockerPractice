@extends('components.layouts.main')
@section('content')
    <a href="{{route('post.create')}}">
        <button class="btn btn-success">Add new one</button>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">User</th>
            <th scope="col">Created</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>

        @foreach($posts as $post)
            <tr>
                <th scope="row">{{$post->id}}</th>
                <td> <div class="col-md-6 d-flex align-items-center justify-content-center">
                        <img src="/storage/image/{{$post->image}}" alt="" width="100">
                    </div></td>
                <td>{{$post->title}}</td>
                <td>{{$post->content}}</td>
                <td>{{$post->users->name}}</td>
                <td>{{$post->created_at}}</td>
                <td><a href="{{route('post.edit',$post)}}">
                        <button class="btn btn-primary">Edit</button>
                    </a></td>
                <form action="{{route('post.destroy',$post)}}" method="post">
                    @csrf
                    @method("delete")
                    <td>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </form>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
