@extends('layout.app')
@section('customCSS')
    <link rel="stylesheet" type="text/css" href="../public/css/signin.css">
@endsection
@section('content')
    <body class="text-center">
    <form class="form-signin" method="post">
        {{ csrf_field() }}
        <h1 class="h3 mb-3 font-weight-normal">Zarejestruj się:</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="text" name="login" id="inputLogin" class="form-control" placeholder="Nazwa użytkownika" required autofocus>
        <input type="text" name="imie" id="inputName" class="form-control" placeholder="Imię" required autofocus>
        <input type="text" name="nazwisko" id="inputSurname" class="form-control" placeholder="Nazwisko" required autofocus>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Adres e-mail" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Hasło" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Dalej</button>
    </form>
    </body>
@endsection