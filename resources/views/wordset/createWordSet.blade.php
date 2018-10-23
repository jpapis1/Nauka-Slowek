@extends('layout.app')
@section('customCSS')
    <link rel="stylesheet" type="text/css" href="/projekt/public/css/main.css">
@endsection
@section('content')

    <body>
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

    <main role="main" class="container">

        <div class="starter-template">
            <h1>Tworzenie zestawu słówek</h1>
            <p>Proszę wybrać języki</p>
                @foreach ($zestawy as $zestaw)
                    @foreach ($zestaw->jezyk1_id as $jezyk1)
                        {{ $jezyk1->nazwa }}
                    @endforeach
                @endforeach
                 @foreach ($zestawy as $zestaw)
                    @foreach ($zestaw->jezyk2_id as $jezyk2)
                        {{ $jezyk2->nazwa }}
                    @endforeach
                @endforeach

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