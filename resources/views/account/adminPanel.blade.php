@extends('layout.app')
@section('customCSS')
    <link rel="stylesheet" type="text/css" href="/projekt/public/css/main.css">
@endsection
@section('content')

    <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="/projekt/public">Nauka Słówek</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">

            </ul>
            @if (session()->has('loggedUser'))
                <form class="form-inline my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/projekt/public/profile">{{'Profil ' . session('loggedUser')->login}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/projekt/public/logout">Wyloguj się</a>
                        </li>

                    </ul>
                </form>
            @else
                <form class="form-inline my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/projekt/public/register">Zarejestruj się</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/projekt/public/login">Zaloguj się</a>
                        </li>

                    </ul>
                </form>
            @endif

        </div>
    </nav>

    <main role="main" class="container">

        <div class="starter-template">

            <div class="container">
                <h1>Panel administratora</h1>
                <p></p>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="/projekt/public/adminPanel/konta">Konta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/projekt/public/adminPanel/kategorie">Kategorie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/projekt/public/adminPanel/podkategorie">Podkategorie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/projekt/public/adminPanel/zestawy">Zestawy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/projekt/public/adminPanel/jezyki">Jezyki</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/projekt/public/adminPanel/wyniki">Wyniki</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/projekt/public/adminPanel/role">Role</a>
                </li>
            </ul>
        </div>

        </div>

    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
    </body>
@endsection