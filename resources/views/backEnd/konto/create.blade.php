@extends('backLayout.app')
@section('title')
Create new Konto
@stop

@section('content')

    <h1>Create New Konto</h1>
    <hr/>

    {!! Form::open(['url' => 'konto', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('id') ? 'has-error' : ''}}">
                {!! Form::label('id', 'Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('rola_id') ? 'has-error' : ''}}">
                {!! Form::label('rola_id', 'Rola Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('rola_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('rola_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('imie') ? 'has-error' : ''}}">
                {!! Form::label('imie', 'Imie: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('imie', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('imie', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('nazwisko') ? 'has-error' : ''}}">
                {!! Form::label('nazwisko', 'Nazwisko: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('nazwisko', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('nazwisko', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('login') ? 'has-error' : ''}}">
                {!! Form::label('login', 'Login: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('login', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('login', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('haslo') ? 'has-error' : ''}}">
                {!! Form::label('haslo', 'Haslo: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('haslo', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('haslo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection