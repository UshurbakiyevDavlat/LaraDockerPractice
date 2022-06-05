@extends('components.layouts.main')
@section('content')
    <a href="{{route('claim.create')}}">
        <button class="btn btn-success">Add new one</button>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Comment</th>
            <th scope="col">Created</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>

        @foreach($claims as $claim)
            <tr>
                <th scope="row">{{$claim->id}}</th>
                <td>{{$claim->comment}}</td>
                <td>{{$claim->created_at}}</td>
                <td><a href="{{route('claim.edit',$claim)}}">
                        <button class="btn btn-primary">Edit</button>
                    </a></td>
                <form action="{{route('claim.destroy',$claim)}}" method="post">
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
