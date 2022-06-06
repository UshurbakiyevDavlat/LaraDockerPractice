@extends('components.layouts.main')
@section('content')
    <a href="{{route('user.create')}}">
        <button class="btn btn-success">Add new one</button>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Posts</th>
            <th scope="col">Claims</th>
            <th scope="col">Infos</th>
            <th scope="col">Created</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>

                <td>
                    @foreach($user->posts as $post)
                        {{$post->title}}
                    @endforeach
                </td>
                <td>
                    @foreach($user->claims as $claim)
                        {{$claim->comment}}
                    @endforeach
                </td>
                <td>
                    @foreach($user->infos as $info)
                        {{$info->title}}
                    @endforeach
                </td>
                <td>{{$user->created_at}}</td>
                <td><a href="{{route('user.edit',$user)}}">
                        <button class="btn btn-primary">Edit</button>
                    </a></td>
                <form action="{{route('user.delete',$user)}}" method="post">
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
