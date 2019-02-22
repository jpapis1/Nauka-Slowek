@extends('layout.app')
@section('customCSS')
<link rel="stylesheet" type="text/css" href="../css/signin.css">
@endsection
@section('content')
    <body class="text-center">
<form class="form-signin" method="post">
    {{ csrf_field() }}
    <h1 class="h3 mb-3 font-weight-normal">Zaloguj się:</h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="text" name="login" id="inputText" class="form-control" placeholder="Nazwa użytkownika" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Hasło" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Dalej</button>
</form>
    </body>
@endsection