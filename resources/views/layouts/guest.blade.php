<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            @yield('title','Connexion')
        </title>

        <link rel="icon" type="image/x-icon" href="{{asset("assets/favicon.png")}}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
        <link rel="stylesheet" href="{{asset("assets/css/bootstrap.min.css")}}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/js/app.js'])
    </head>
    <body>
        @section('header')
            <nav class="header navbar navbar-expand-lg navbar-dark">
                    <button class="navbar-toggler ms-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <img class="ms-4 me-4" src="{{asset("assets/logo/PMRoland.svg")}}">
                    <div class="position-absolute w-100">
                        <h4 style="text-align:center;" class="text-light m-auto">
                            <b>Bienvenue sur le centre de gestion d'InfoExam</b>
                        </h4>
                    </div>
                    @auth
                        <div class="collapse navbar-collapse justify-content-md-center text-center" id="navbar">

                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="{{ request()->routeIs('epreuves.index') ? 'nav-link active' : 'nav-link'  }}" href="{{ route('epreuves.index')}}"><button type="button" class="btn btn-light">ÉPREUVES</button><span class="sr-only"></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="{{ request()->routeIs('formations.index') ? 'nav-link active' : 'nav-link'  }}" href="{{ route('formations.index')}}"><button type="button" class="btn btn-info">FORMATIONS</button><span class="sr-only"></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="{{ request()->routeIs('alertes.index') ? 'nav-link active' : 'nav-link'  }}" href="{{ route('alertes.index')}}"><button type="button" class="btn btn-warning">ALERTES</button><span class="sr-only"></span></a>
                                </li>
                            </ul>
                        </div>
                        <form action="{{ route('logout')}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-secondary">DÉCONNEXION <i class="bi bi-box-arrow-right"></i></button>
                        </form>
                    @endauth
            </nav>
        @show

        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        @section('footer')
            <div class="footer position-absolute bottom-0 mt-4">
                <div class="d-flex align-items-center">
                    <p class="text-muted m-1">CRÉÉ PAR</p>
                    <img src="{{asset("assets/logo/Qlopex_wide.png")}}">
                </div>
                <div class="d-flex">
                    <a href="{{ route('APIDocs')}}" class="text-muted me-1" style="text-decoration: none">API | DOCS</a>
                </div>
            </div>
        @show

    </body>
</html>
