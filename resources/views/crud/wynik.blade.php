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

		<div class="starter-template">

			<div class="container">

				<h1>Panel administratora</h1>
				<p></p>

				<ul class="nav nav-tabs">

					<li class="nav-item">
						<a class="nav-link" href="/adminPanel/konta">Konta</a>
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
						<a class="nav-link active" href="/adminPanel/wyniki">Wyniki</a>
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
					<th scope="col">Konto</th>
					<th scope="col">Zestaw</th>
					<th scope="col">Wynik</th>
					<th scope="col">Data Wyniku</th>
				</tr>
				</thead>
				@foreach ($wyniki as $wynik)
					<tr>
						<td>
							<a style="text-decoration:none;" href="/adminPanel/wyniki/delete/{{$wynik->id}}" title="Usuń rekord" data-toggle="popover" data-trigger="hover" data-content="Ten rekord będzie usunięty z bazy danych!">
								<i class="fa fa-times-circle" aria-hidden="true"></i>
							</a>

						</td>
                        <td>
                            @foreach ($wynik->konto_id as $konto)
                                {{ $konto->login }}
                            @endforeach
                        </td>
                        <td>
                            @foreach ($wynik->zestaw_id as $zestaw)
                                {{ $zestaw->nazwa }}
                            @endforeach
                        </td>
						<td>{{$wynik->wynik}}</td>
						<td>{{$wynik->data_wyniku}}</td>


					</tr>
				@endforeach
				{!! Form::open(array('route' => 'createWynik', 'method' => 'POST')) !!}
				<tr>
					<td></td>

					<td>
						<select class="custom-select d-block w-200" id="country" required>
							<option value="">Konto</option>
							@foreach ($data['konta'] as $konto)
								<option>
									{{$konto->login}}
								</option>
							@endforeach
						</select>
					</td>
                    <td>
                        <select class="custom-select d-block w-200" id="country" required>
                            <option value="">Zestaw</option>
                            @foreach ($data['zestawy'] as $zestaw)
                                <option>
                                    {{$zestaw->nazwa}}
                                </option>
                            @endforeach
                        </select>
                    </td>
					<td><input type="text" name="login" id="inputLogin" class="form-control" placeholder="Wynik" required autofocus></td>
					<td><input type="text" name="imie" id="inputName" class="form-control" placeholder="Data Wyniku" required autofocus></td>
				</tr>
			</table>
		</div>
		<p></p>
		{!! Form::submit("Utwórz wynik", array('class' => "btn btn-outline-success",'role' => "btn btn-success")) !!}
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