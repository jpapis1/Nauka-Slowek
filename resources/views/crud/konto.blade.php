@extends('layout.app')
@section('customCSS')
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

	<main role="main" class="container">

		<div class="starter-template">

			<div class="container">

				<h1>Panel administratora</h1>
				<p></p>

				<ul class="nav nav-tabs">

					<li class="nav-item">
						<a class="nav-link active" href="/adminPanel/konta">Konta</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/adminPanel/kategorie">Kategorie</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/adminPanel/podkategorie">Podkategorie</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/adminPanel/jezyki">Języki</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/adminPanel/wyniki">Wyniki</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/adminPanel/uprawnienia">Uprawnienia</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/adminPanel/role">Role</a>
					</li>

				</ul>


			</div>

		</div>
		<div class="table-responsive">
		<table class="table">
			<thead>
			<tr>
				<th scope="col">Akcje</th>
				<th scope="col">Login</th>
				<th scope="col">Imię</th>
				<th scope="col">Nazwisko</th>
				<th scope="col">Email</th>
				<th scope="col">Hasło</th>
				<th scope="col">Typ</th>
			</tr>
			</thead>
            @foreach ($konta as $konto)
				@if($konto->login!=session('loggedUser')->login)


			<tr>
				<td>
					<a style="text-decoration:none;" href="/adminPanel/konta/delete/{{$konto->id}}" title="Usuń rekord" data-toggle="popover" data-trigger="hover" data-content="Ten rekord będzie usunięty z bazy danych!">
						<i class="fa fa-times-circle" aria-hidden="true"></i>
					</a>
					<a style="text-decoration:none;" href="/adminPanel/konta/edit/{{$konto->id}}" title="Edytuj rekord" data-toggle="popover" data-trigger="hover" data-content="Przejdź do strony dzięki której zmodyfikujesz dany rekord.">
					<i class="fa fa-edit" aria-hidden="true"></i>
					</a>

				</td>
				<td>{{$konto->login}}</td>
				<td>{{$konto->imie}}</td>
				<td>{{$konto->nazwisko}}</td>
				<td>{{$konto->email}}</td>
				<td>{{$konto->haslo}}</td>
				<td>
					@foreach ($konto->rola_id as $rola)
						{{ $rola->nazwa }}
					@endforeach
				</td>
			</tr>
                @endif
            @endforeach
{!! Form::open(array('route' => 'createKonto', 'method' => 'POST')) !!}
			<tr>
			<td></td>
			<td><input type="text" name="login" id="inputLogin" class="form-control" placeholder="Login" required autofocus></td>
			<td><input type="text" name="imie" id="inputName" class="form-control" placeholder="Imię" required autofocus></td>
			<td><input type="text" name="nazwisko" id="inputName" class="form-control" placeholder="Nazwisko" required autofocus></td>
			<td><input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus></td>
			<td><input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Hasło" required autofocus></td>
			<td>
				<select class="custom-select d-block w-200" name="rola" id="rola" required>
					<option value="">Rola</option>
					@foreach ($role as $rola)
					<option>
						{{$rola}}
					</option>
					@endforeach
				</select>
				</td>
			</tr>
		</table>
		</div>
		<p></p>
		{!! Form::submit("Utwórz konto", array('class' => "btn btn-outline-success",'role' => "btn btn-success")) !!}
{!! Form::close() !!}
<p></p>


	</main><!-- /.container -->
	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
	<script src="../../../../assets/js/vendor/popper.min.js"></script>
	<script src="../../../../dist/js/bootstrap.min.js"></script>
	<script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();
        });
	</script>
	</body>
@endsection