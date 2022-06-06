@extends('components.layouts.main')
@section('content')
    <a href="{{route('info.create')}}">
        <button class="btn btn-success">Add new one</button>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">status</th>
            <th scope="col">user</th>
            <th scope="col">Created</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>

        @foreach($infos as $info)
            <tr>
                <th scope="row">{{$info->id}}</th>
                <td>{{$info->title}}</td>
                <td>{{$info->status}}</td>
                <td>{{$info->users->name}}</td>
                <td>{{$info->created_at}}</td>
                <td><a href="{{route('info.edit',$info)}}">
                        <button class="btn btn-primary">Edit</button>
                    </a></td>
                <form action="{{route('info.destroy',$info)}}" method="post">
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
