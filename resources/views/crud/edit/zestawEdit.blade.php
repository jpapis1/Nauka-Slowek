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
            <h1>Edycja zestawu - {{$zestaw['nazwa']}}</h1>
            {!! Form::open(array('action'=>['ZestawController@makeEdit','kategoria'=>$kat,'id'=>$id ], 'method' => 'POST')) !!}
            {{ csrf_field() }}
            <div class="table-responsive">
            <table class="table table-bordered" id="dynamic_field">
                <tr>
                <td colspan="2"><input type="text" name="nazwa" id="inputText" value="{{$zestaw['nazwa']}}" class="form-control" placeholder="Nazwa zestawu" required></td>
                </tr>
            <tr>

                <td>
                    <select class="custom-select d-block w-200" name="jezyk1" required>
                        <option value="{{$jezyk1['nazwa']}}">{{$jezyk1['nazwa']}}</option>
                        @foreach ($jezyki as $jezyk)
                            @if($jezyk['nazwa']!=$jezyk1['nazwa'])
                            <option>

                                {{$jezyk['nazwa']}}

                            </option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td>
                    <select class="custom-select d-block w-200" name="jezyk2" required>
                        <option value="{{$jezyk2['nazwa']}}">{{$jezyk2['nazwa']}}</option>
                        @foreach ($jezyki as $jezyk)
                            @if($jezyk['nazwa']!=$jezyk2['nazwa'])
                            <option>

                                {{$jezyk['nazwa']}}

                            </option>
                            @endif
                        @endforeach
                    </select>
                </td>
            </tr>
                @php ($i=1)
                @foreach($zestaw['zestaw'] as $z)
                    <tr id="row{{$i}}" class="dynamic-added">
                        <td><input type="text" name="name[]" value="{{$z[0]}}" placeholder="Wpisz słowo 1" class="form-control name_list" required/></td>
                        <td><input type="text" name="name[]" value="{{$z[1]}}" placeholder="Wpisz słowo 2" class="form-control name_list" required/></td>
                        <td><button type="button" name="remove" id="{{$i}}" class="btn btn-danger btn_remove">X</button></td>
                    </tr>
                    @php($i++)

                @endforeach
            </table>
            </div>
            <button type="button" name="add" id="add" data-content="{{$i}}" class="btn btn-outline-primary btn-block">Dodaj wiersz</button><p></p>
            <button class="btn btn-outline-success btn-block" type="submit">Potwierdź modyfikacje zestawu (tym samym zostaną usunięte wyniki zestawu)</button>
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
    <script>
        $(document).ready(function(){
            var postURL = "<?php echo url('addmore'); ?>";
            //var i=1;
            var i = document.getElementById("add");
            i = i.dataset.content;
            $('[data-toggle="popover"]').popover();
            $('#add').click(function(){
                i++;
                $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added">' +
                    '<td><input type="text" name="name[]" placeholder="Wpisz słowo 1" class="form-control name_list" required/></td>' +
                    '<td><input type="text" name="name[]" placeholder="Wpisz słowo 2" class="form-control name_list" required/></td>' +
                    '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>' +
                    '</tr>');

            });
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#submit').click(function(){
                $.ajax({
                    url:postURL,
                    method:"POST",
                    data:$('#add_name').serialize(),
                    type:'json',
                    success:function(data)
                    {
                        if(data.error){
                            printErrorMsg(data.error);
                        }else{
                            i=1;
                            $('.dynamic-added').remove();
                            $('#add_name')[0].reset();
                            $(".print-success-msg").find("ul").html('');
                            $(".print-success-msg").css('display','block');
                            $(".print-error-msg").css('display','none');
                            $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                        }
                    }
                });
            });
        });
    </script>
    </body>
@endsection