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
    @php($success=0)
    @for($i=0;$i<count(session()->get('wordSetData')['zestawy']['zawartosc']);$i++)
        @if(session()->get('wordSetData')['zestawy']['success'][$i]==true)
            @php ($success = $success+1)
        @endif
    @endfor
    <main role="main" class="container">

        <div class="starter-template">
            <h1>Wynik</h1>
            <h2>{{$success}}/{{count(session()->get('wordSetData')['zestawy']['zawartosc'])}} - 
                {{number_format((float)$success/count(session()->get('wordSetData')['zestawy']['zawartosc'])*100, 2, '.', '')}}%</h2>
            <div class="float-left">
            <a class="btn btn-outline-primary" href="/projekt/public/category/{{$data['daneOWynikach']['kategoria']}}/{{$data['daneOWynikach']['podkategoria']}}/{{$data['daneOWynikach']['zestaw']}}">Wróć do zestawu</a>
            <a class="btn btn-outline-primary" href="/projekt/public/category/{{$data['daneOWynikach']['kategoria']}}/{{$data['daneOWynikach']['podkategoria']}}">Wróć do podkategorii</a>
            <a class="btn btn-outline-primary" href="/projekt/public/category/{{$data['daneOWynikach']['kategoria']}}">Wróć do kategorii</a>
            </div>
            <br></br>
        <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Słowo/zdanie 1</th>
                    <th scope="col">Słowo/zdanie 2</th>
                    <th scope="col">Twoja odpowiedź</th>
                </tr>
                </thead>

            @for($i=0;$i<count(session()->get('wordSetData')['zestawy']['zawartosc']);$i++)
                    @if(session()->get('wordSetData')['zestawy']['success'][$i]==false)
                        <tr class="p-3 mb-2 bg-danger text-black">
                    @else
                                <tr class="p-3 mb-2 bg-success text-black">

                    @endif
                        <td> {{session()->get('wordSetData')['zestawy']['zawartosc'][$i][0]}}</td>
                        <td> {{session()->get('wordSetData')['zestawy']['zawartosc'][$i][1]}}</td>
                        <td> {{session()->get('wordSetData')['zestawy']['odpowiedz'][$i]}}</td>
                    </tr>
            @endfor

            </table>
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