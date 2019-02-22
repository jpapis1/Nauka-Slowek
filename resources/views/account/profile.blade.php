@extends('layout.app')
@section('customCSS')
    <link rel="stylesheet" type="text/css" href="/css/main.css">

@endsection
@section('content')

    <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="/">Nauka Słówek</a>
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
                            <a class="nav-link" href="/profile">{{'Profil ' . session('loggedUser')->login}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout">Wyloguj się</a>
                        </li>

                    </ul>
                </form>
            @else
                <form class="form-inline my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Zarejestruj się</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Zaloguj się</a>
                        </li>

                    </ul>
                </form>
            @endif

        </div>
    </nav>

    <main role="main" class="container">

        <div class="starter-template">
            @if(session('response'))
                {{session('response')}}
            @endif
                <h1>Profil użytkownika</h1>


        </div>

        <div class="container">
            @if (session()->has('loggedUser'))
                @if(session('loggedUser')->rola_id==1)
                    <a href="/adminPanel" class="btn btn-outline-primary" role="button">Panel administratora</a>
                @endif
            @endif
                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#editModal">Edytuj konto</button>
                <div class="modal fade" id="editModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Edycja konta</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                {!! Form::open(array('action'=>'KontoController@changeData', 'method' => 'POST')) !!}
                                {{ csrf_field() }}
                                <input type="text" name="login" id="input" class="form-control" placeholder="Nazwa użytkownika" value={{session('loggedUser')->login}} required autofocus>
                                <input type="text" name="imie" id="input" class="form-control" placeholder="Imię" value={{session('loggedUser')->imie}} required autofocus>
                                <input type="text" name="nazwisko" id="input" class="form-control" placeholder="Nazwisko" value={{session('loggedUser')->nazwisko}} required autofocus>
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Zmień dane</button>
                                {!! Form::close() !!}
                                <p></p><p></p>
                                {!! Form::open(array('action'=>['KontoController@changePassword'], 'method' => 'POST')) !!}
                                    {{ csrf_field() }}
                                    <input type="password" name="oldPass" id="input" class="form-control" placeholder="Stare hasło" required autofocus>
                                    <input type="password" name="newPass" id="input" class="form-control" placeholder="Nowe hasło" required autofocus>
                                    <button class="btn btn-lg btn-primary btn-block" type="submit">Zmień hasło</button>
                                {!! Form::close() !!}
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
                            </div>

                        </div>
                    </div>
                </div>
            <p></p>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Login</h4>
                    <p class="card-text">{{session('loggedUser')->login}}</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Imię</h4>
                    <p class="card-text">{{session('loggedUser')->imie}}</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Nazwisko</h4>
                    <p class="card-text">{{session('loggedUser')->nazwisko}}</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Typ konta</h4>
                    <p class="card-text">{{$nazwa_roli}}</p>
                </div>
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