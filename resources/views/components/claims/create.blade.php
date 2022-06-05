@extends('components.layouts.main')
@section('content')
    <form action="{{route('claim.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Comment</label>
            <input type="text" class="form-control" id="comment" name="comment" aria-describedby="commentHelp" placeholder="Enter comment">
            <small id="commentHelp" class="form-text text-muted">We'll never share your name with anyone else.</small>
        </div>
        <select class="form-select m-auto" name="user_id">
            @foreach($users as $user)
                <option class="" value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary mt-4">Submit</button>
        <a href="{{route('info.index')}}"><button type="button" class="btn btn-primary mt-4">back</button></a>
    </form>
@endsection
