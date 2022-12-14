<html>
    <head>
        <title>
            @yield('title')
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="{{asset("assets/css/bootstrap.min.css")}}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css">

    </head>
    <body>

        @section('header')
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="{{ request()->routeIs('formations.index') ? 'nav-link active' : 'nav-link'  }}" href="{{ route('formations.index')}}">Formations<span class="sr-only"></span></a>
                        </li>
                    </ul>
                </div>
                    <a href="{{ route('login')}}"><button class="btn btn-info">Connexion</button></a>

            </nav>
        @show

        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show"  role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif



        <div class="container">
            @yield('content')
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{asset("assets/js/bootstrap.bundle.min.js")}}"></script>
        <script src="{{asset("assets/js/script.js")}}"></script>
    </body>
</html>
