@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                        @if(\Illuminate\Support\Facades\Session::get('error'))
                            <div class="btn-danger">{{\Illuminate\Support\Facades\Session::get('error')}}</div>
                            <a href="{{route('home')}}"><button class="btn-success" name="back">Ok</button></a>
                        @else
                    <ul>
                        @can('view',auth()->user())
                        <li><a href="{{route('admin.post.index')}}">Admin page</a></li>
                        <li><a href="{{route('info.index')}}">Info</a></li>
                        <li><a href="{{route('user.index')}}">Users</a></li>
                        <li><a href="{{route('post.index')}}">Posts</a></li>
                        <li><a href="{{route('claim.index')}}">Claims</a></li>
                        <li><a href="{{route('tag.index')}}">Tags</a></li>
                        @endcan
                    </ul>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
