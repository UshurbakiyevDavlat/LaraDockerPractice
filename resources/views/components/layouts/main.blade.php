<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }} ">
    <title>Laravel</title>
</head>
<body>
<div class="container">
    <div class="row">


        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{route('home')}}">Auth</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('user.index') }}">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('post.index')}}">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('claim.index')}}">Claim</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('info.index')}}">Info</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('tag.index')}}">Tags</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    @yield('content')
</div>
</body>
</html>
