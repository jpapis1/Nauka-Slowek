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
        <h1>Witaj w aplikacji!</h1>
        @if(session('response'))
            {{session('response')}}
        @endif
        <p>Aplikacja umożliwia naukę i sprawdzanie znajomości słówek (zdań) z języka obcego. Jest przeznaczona dla dzieci ze szkoły podstawowej i młodzieży gimnazjalnej. Proszę się zalogować/zarejestrować, żeby uzyskać więcej możliwości.</p>

        <p></p>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Kategoria</th>
                <th scope="col">Opis</th>
            </tr>
            </thead>
        <?php
        foreach ($kategorie as $kategoria) {
            ?>
            <tr>
                <td><a href="/category/<?php echo $kategoria->nazwa?>"><?php echo $kategoria->nazwa?></a></td>
                <td><?php echo $kategoria->opis;?></td>
            </tr>
            <?php
            }
            ?>
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