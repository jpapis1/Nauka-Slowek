@extends('layout.app')
@section('customCSS')
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

        <h1>Edycja Podkategorii - {{$podkategoria['nazwa']}}</h1>
        {!! Form::open(array('action'=>['PodkategoriaController@makeEdit','id'=>$id ], 'method' => 'POST')) !!}
        {{ csrf_field() }}
        <p></p>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nazwa</h4>
                <input type="text" name="nazwa" id="inputText" value="{{$podkategoria['nazwa']}}" class="form-control" placeholder="Nazwa" required>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Opis</h4>
                <input type="text" name="opis" id="inputText" value="{{$podkategoria['opis']}}" class="form-control" placeholder="Opis" required>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Kategoria</h4>
                <select class="custom-select d-block w-200" name="kategoria" required>
                    <option value="{{$mojaKategoria['nazwa']}}">{{$mojaKategoria['nazwa']}}</option>
                    @foreach ($kategorie as $kategoria)
                        @if($kategoria['nazwa']!=$mojaKategoria['nazwa'])
                            <option>
                                {{$kategoria['nazwa']}}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <p></p>
        <button class="btn btn-outline-success btn-block" type="submit">Potwierdź modyfikacje podkategorii</button>
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