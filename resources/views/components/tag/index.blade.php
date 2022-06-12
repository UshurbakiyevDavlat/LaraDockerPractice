@extends('components.layouts.main')
@section('content')
    <a href="{{route('tag.create')}}">
        <button class="btn btn-success">Add new one</button>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Status</th>
            <th scope="col">Created</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>

        @foreach($tags as $tag)
            <tr>
                <th scope="row">{{$tag->id}}</th>
                <td>{{$tag->name}}</td>
                <td>{{$tag->status}}</td>
                <td>{{$tag->created_at}}</td>
                <td><a href="{{route('tag.edit',$tag)}}">
                        <button class="btn btn-primary">Edit</button>
                    </a></td>
                <form action="{{route('tag.destroy',$tag)}}" method="post">
                    @csrf
                    @method('delete')
                    <td>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </form>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
