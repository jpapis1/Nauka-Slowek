@extends('layout.app')
@section('customCSS')
    <link rel="stylesheet" type="text/css" href="/css/main.css">
@endsection
@section('content')
    <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="">Nauka Słówek</a>
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
@php (extract($data))

    <main role="main" class="container">
        <div class="starter-template">
<h1>Słowo nr {{session()->get('wordSetData')['stanObecny']+1}}</h1>
            @if(!$last)
                @if(session()->get('wordSetData')['typ']==='learning')
                {!! Form::open(array('action'=>['ZestawController@learning','kategoria'=>$kategoria,
            'podkategoria'=>$podkategoria,'zestaw'=>$zestaw,'lang1'=>$lang1,'lang2'=>$lang2,'alg'=>$alg],
             'method' => 'POST')) !!}
                    @elseif(session()->get('wordSetData')['typ']==='testing')
                    {!! Form::open(array('action'=>['ZestawController@testing','kategoria'=>$kategoria,
            'podkategoria'=>$podkategoria,'zestaw'=>$zestaw,'lang1'=>$lang1,'lang2'=>$lang2,'alg'=>$alg],
             'method' => 'POST')) !!}
                    @endif
            @else
                {!! Form::open(array('action'=>['ZestawController@checkAndShowResult','kategoria'=>$kategoria,
            'podkategoria'=>$podkategoria,'zestaw'=>$zestaw,'lang1'=>$lang1,'lang2'=>$lang2,'alg'=>$alg],
             'method' => 'GET')) !!}
            @endif


                {{ csrf_field() }}
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Słówko/zdanie 1</th>
                    <th scope="col">Słówko/zdanie 2</th>
                </tr>
                </thead>
                <tr>
                    <td>{{session()->get('wordSetData')['zestawy']['zawartosc'][session()->get('wordSetData')['stanObecny']]['0']}}</td>
                    <td><input type="text" name="nazwa" id="inputText" class="form-control" placeholder="Nazwa" required autofocus></td>

                </tr>
            </table>

                @if (!$last)
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Dalej</button>
                @else

                <button class="btn btn-lg btn-primary btn-block" type="submit">Pokaż wynik</button>
                @endif
            @if (isset(session()->get('wordSetData')['ostatnieSlowo']))
                <p></p>
                <p></p>
                <h1>Poprzednia odpowiedź</h1>
                <p></p>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Słówko/zdanie 1</th>
                        <th scope="col">Słówko/zdanie 2</th>
                        <th scope="col">Odpowiedź</th>
                    </tr>
                    </thead>
                    @if(!isset($data['ostatnieSlowo1']))
                    @if(session()->get('wordSetData')['zestawy']['success'][session()->get('wordSetData')['ostatnieSlowo']]==false)
                            <tr class="p-3 mb-2 bg-danger text-black">
                        @else
                            <tr class="p-3 mb-2 bg-success text-black">

                                @endif
                                <td> {{session()->get('wordSetData')['zestawy']['zawartosc'][session()->get('wordSetData')['ostatnieSlowo']]['0']}}</td>
                                <td> {{session()->get('wordSetData')['zestawy']['zawartosc'][session()->get('wordSetData')['ostatnieSlowo']]['1']}}</td>
                                <td> {{session()->get('wordSetData')['zestawy']['odpowiedz'][session()->get('wordSetData')['ostatnieSlowo']]}}</td>

                            </tr>
                    @else

                                    <tr class="p-3 mb-2 bg-danger text-black">
                                        <td> {{$data['ostatnieSlowo1']}}</td>
                                        <td> {{$data['ostatnieSlowo2']}}</td>
                                        <td> {{$data['ostatniaOdpowiedz']}}</td>

                                    </tr>

                        @endif


                </table>

            @endif


            {!! Form::close() !!}


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