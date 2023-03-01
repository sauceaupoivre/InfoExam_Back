<!DOCTYPE html>
<html lang="fr">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            @yield('title')
        </title>

        <link rel="icon" type="image/x-icon" href="{{asset("assets/favicon.png")}}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
        <link rel="stylesheet" href="{{asset("assets/css/bootstrap.min.css")}}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    </head>
    <body>

        @section('header')
            <nav class="header navbar navbar-expand-lg navbar-dark sticky-top">
                    <button class="navbar-toggler ms-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <img class="ms-4 me-4" src="{{asset("assets/logo/PMRoland.svg")}}">

                    <div class="collapse navbar-collapse justify-content-md-center text-center p-3" id="navbar">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="{{ request()->routeIs('epreuves.index') ? 'nav-link active' : 'nav-link'  }}" href="{{ route('epreuves.index')}}"><button type="button" class="btn btn-light">ÉPREUVES <i class="bi bi-pen"></i></button><span class="sr-only"></span></a>
                            </li>
                            <li class="nav-item">
                                <a class="{{ request()->routeIs('formations.index') ? 'nav-link active' : 'nav-link'  }}" href="{{ route('formations.index')}}"><button type="button" class="btn btn-info">FORMATIONS <i class="bi bi-journal"></i></button><span class="sr-only"></span></a>
                            </li>
                            <li class="nav-item">
                                <a class="{{ request()->routeIs('alertes.index') ? 'nav-link active' : 'nav-link'  }}" href="{{ route('alertes.index')}}"><button type="button" class="btn btn-warning">ALERTES <i class="bi bi-bell"></i></button><span class="sr-only"></span></a>
                            </li>
                            <li class="nav-item d-flex align-items-center">
                                <form action="{{ route('logout')}}" method="POST">
                                    @csrf
                                    <div>
                                        <button type="submit" class="btn btn-secondary ms-2 me-0" id="btn-logout">DÉCONNEXION <i class="bi bi-box-arrow-right"></i></button>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>


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

        @section('footer')
            <div class="footer mt-4">
                <div class="d-flex align-items-center">
                    <p class="text-muted m-1">Créée par</p>
                    <img src="{{asset("assets/logo/Qlopex.png")}}">
                </div>
            </div>
        @show

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{asset("assets/js/bootstrap.bundle.min.js")}}"></script>
        <script src="{{asset("assets/js/script.js")}}"></script>
    </body>
</html>

