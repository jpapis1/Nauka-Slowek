@extends('layout.app')
@section('customCSS')
    <link rel="stylesheet" type="text/css" href="/projekt/public/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

        <h1>Edycja kategorii - {{$kategoria['nazwa']}}</h1>
        {!! Form::open(array('action'=>['KategoriaController@makeEdit','id'=>$id ], 'method' => 'POST')) !!}
        {{ csrf_field() }}
        <p></p>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nazwa</h4>
                <input type="text" name="nazwa" id="inputText" value="{{$kategoria['nazwa']}}" class="form-control" placeholder="Login" required>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Opis</h4>
                <input type="text" name="opis" id="inputText" value="{{$kategoria['opis']}}" class="form-control" placeholder="Nazwisko" required>
            </div>
        </div>

        <p></p>
        <button class="btn btn-outline-success btn-block" type="submit">Potwierdź modyfikacje kategorii</button>
        {!! Form::close() !!}






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