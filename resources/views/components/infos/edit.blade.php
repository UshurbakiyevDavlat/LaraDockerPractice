@extends('components.layouts.main')
@section('content')
    <form action="{{route('user.update',$user->id)}}" method="post">
        @csrf
        @method('patch')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" aria-describedby="nameHelp" placeholder="Enter name">
            <small id="nameHelp" class="form-text text-muted">We'll never share your name with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="{{$user->password}}" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary mt-4">Submit</button>
        <a href="{{route('user.index')}}"><button type="button" class="btn btn-primary mt-4">back</button></a>
    </form>
@endsection
