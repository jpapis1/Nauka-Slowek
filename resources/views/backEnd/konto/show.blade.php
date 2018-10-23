@extends('backLayout.app')
@section('title')
Konto
@stop

@section('content')

    <h1>Konto</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Id</th><th>Rola Id</th><th>Imie</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $konto->id }}</td> <td> {{ $konto->id }} </td><td> {{ $konto->rola_id }} </td><td> {{ $konto->imie }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection