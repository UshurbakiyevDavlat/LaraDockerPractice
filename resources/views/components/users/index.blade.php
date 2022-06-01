@extends('components.layouts.main')
@section('content')
    <a href="{{route('user.create')}}"><button class="btn btn-success">Add new one</button></a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Created</th>
            <th scope="col">Edit</th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->created_at}}</td>
            <td><a href="{{route('user.edit',$user)}}"><button class="btn btn-primary">Edit</button></a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
