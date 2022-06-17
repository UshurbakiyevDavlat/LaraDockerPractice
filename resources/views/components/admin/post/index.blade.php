@extends('components.layouts.admin.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
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
                    <th scope="col">Category</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Created</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody>

                @foreach($posts as $post)
                    <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td>
                            <div class="col-md-10 d-flex align-items-center justify-content-center">
                                <img src="/storage/image/{{$post->image}}" alt="" width="100">
                            </div>
                        </td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->content}}</td>
                        <td>{{$post->users->name}}</td>
                        <td>{{$post->category->title}}</td>
                        <td>
                            @foreach($post->tags as $tag)
                                {{$tag->name}}
                            @endforeach
                        </td>
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
            <div>
                {{$posts->withQueryString()->links()}}
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
