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

            <h1>Edycja konta - {{$konto['login']}}</h1>

        <p></p>


        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#editModal">Zmień hasło</button>
        <p></p>
        <div class="modal fade" id="editModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Zmiana hasła</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        {!! Form::open(array('action'=>['KontoController@changeSomeonesPassword','id' => $id], 'method' => 'POST')) !!}
                        {{ csrf_field() }}

                        <input type="password" name="newPass" id="input" class="form-control" placeholder="Nowe hasło" required autofocus>
                        <p></p>
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
        {!! Form::open(array('action'=>['KontoController@makeEdit','id'=>$id ], 'method' => 'POST')) !!}
        {{ csrf_field() }}


            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Login</h4>
                    <input type="text" name="login" id="inputText" value="{{$konto['login']}}" class="form-control" placeholder="Login" required>
                </div>
            </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Imię</h4>
                <input type="text" name="imie" id="inputText" value="{{$konto['imie']}}" class="form-control" placeholder="Imię" required>
            </div>
        </div>
            <div class="card">
                <div class="card-body">
                   <h4 class="card-title">Nazwisko</h4>
                    <input type="text" name="nazwisko" id="inputText" value="{{$konto['nazwisko']}}" class="form-control" placeholder="Nazwisko" required>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Email</h4>
                    <input type="email" name="email" id="inputEmail" value="{{$konto['email']}}" class="form-control" placeholder="Email" required>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Typ konta</h4>
                    <select class="custom-select d-block w-200" name="rola" required>
                        <option value="{{$mojaRola['nazwa']}}">{{$mojaRola['nazwa']}}</option>
                        @foreach ($role as $rola)
                            @if($rola['nazwa']!=$mojaRola['nazwa'])
                                <option>
                                    {{$rola['nazwa']}}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        <p></p>
        <button class="btn btn-outline-success btn-block" type="submit">Potwierdź modyfikacje konta</button>
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