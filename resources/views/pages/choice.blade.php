@extends('layout.app')
@section('customCSS')
    <link rel="stylesheet" type="text/css" href="/css/main.css">
@endsection
@section('content')

    <body>
    {{ csrf_field() }}
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

    <main role="main" class="container">

        <div class="starter-template">
            <div class="container">
                <div class="card">
                    <div class="card-header"><h1>Zestaw słówek - {{$data['zestaw']}}</h1></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-xl-12 item">
                                <h2>Tryb nauki</h2>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-xs-12 col-xl-12 item">
                                <h5>Z języka {{$data['lang1']->nazwa}}->{{$data['lang2']->nazwa}}</h5>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-xl-12 item">
                                <a href="/category/{{$data['kategoria']}}/{{$data['podkategoria']}}/{{$data['zestaw']}}/learning/{{$data['lang1']->id}}/{{$data['lang2']->id}}/1" class="btn btn-primary btn-block" role="button">Wymieszaj słówka, pytaj się dokładnie 1 raz
                                </a>
                            </div>

                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-xs-12 col-xl-12 item">
                                <a href="/category/{{$data['kategoria']}}/{{$data['podkategoria']}}/{{$data['zestaw']}}/learning/{{$data['lang1']->id}}/{{$data['lang2']->id}}/2" class="btn btn-primary btn-block" role="button">Wymieszaj słówka, pytaj się do poprawnej odpowiedzi</a>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-xs-12 col-xl-12 item">
                                <a href="/category/{{$data['kategoria']}}/{{$data['podkategoria']}}/{{$data['zestaw']}}/learning/{{$data['lang1']->id}}/{{$data['lang2']->id}}/3" class="btn btn-primary btn-block" role="button">Sortuj alfabetyczne, pytaj się dokładnie 1 raz</a>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-xs-12 col-xl-12 item">
                                <h5>Z języka {{$data['lang2']->nazwa}}->{{$data['lang1']->nazwa}}</h5>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-xl-12 item">
                                <a href="/category/{{$data['kategoria']}}/{{$data['podkategoria']}}/{{$data['zestaw']}}/learning/{{$data['lang2']->id}}/{{$data['lang1']->id}}/1" class="btn btn-primary btn-block" role="button">Wymieszaj słówka, pytaj się dokładnie 1 raz
                                </a>
                            </div>


                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-xs-12 col-xl-12 item">
                                <a href="/category/{{$data['kategoria']}}/{{$data['podkategoria']}}/{{$data['zestaw']}}/learning/{{$data['lang2']->id}}/{{$data['lang1']->id}}/2" class="btn btn-primary btn-block" role="button">Wymieszaj słówka, pytaj się do poprawnej odpowiedzi</a>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-xs-12 col-xl-12 item">
                                <a href="/category/{{$data['kategoria']}}/{{$data['podkategoria']}}/{{$data['zestaw']}}/learning/{{$data['lang2']->id}}/{{$data['lang1']->id}}/3" class="btn btn-primary btn-block" role="button">Sortuj alfabetyczne, pytaj się dokładnie 1 raz</a>
                            </div>
                        </div>
                        <p></p>
                        <hr></hr>
                        <div class="row">
                            <div class="col-xs-12 col-xl-12 item">
                                <h2>Tryb sprawdzania wiedzy</h2>
                            </div>
                        </div>
                        <p></p>
                        <div class="col-xs-12 col-xl-12 item">
                            <h5>Z języka {{$data['lang1']->nazwa}}->{{$data['lang2']->nazwa}}</h5>
                        </div>
                        <div class="col-xs-12 col-xl-12 item">
                            <a href="/category/{{$data['kategoria']}}/{{$data['podkategoria']}}/{{$data['zestaw']}}/testing/{{$data['lang1']->id}}/{{$data['lang2']->id}}/1" class="btn btn-primary btn-block" role="button">Wymieszaj słówka, pytaj się dokładnie 1 raz
                            </a>
                        </div>
                        <p></p>
                        <div class="col-xs-12 col-xl-12 item">
                            <h5>Z języka {{$data['lang2']->nazwa}}->{{$data['lang1']->nazwa}}</h5>
                        </div>
                        <div class="col-xs-12 col-xl-12 item">
                            <a href="/category/{{$data['kategoria']}}/{{$data['podkategoria']}}/{{$data['zestaw']}}/testing/{{$data['lang2']->id}}/{{$data['lang1']->id}}/1" class="btn btn-primary btn-block" role="button">Wymieszaj słówka, pytaj się dokładnie 1 raz
                            </a>
                        </div>


                    </div>
                </div>
            </div>

            <p></p>
            <div class="container">
                <div class="card">
                    <div class="card-header"><h1>Zawartość Zestawu</h1></div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Słowo/zdanie 1</th>
                                <th scope="col">Słowo/zdanie 2</th>
                            </tr>
                            </thead>
                            @for($i=0;$i<count($data['zestawDoDanych']);$i++)
                                <tr>
                                    <td>{{$data['zestawDoDanych'][$i][0]}}</td>
                                    <td>{{$data['zestawDoDanych'][$i][1]}}</td>
                                </tr>
                            @endfor

                        </table>


                    </div>
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