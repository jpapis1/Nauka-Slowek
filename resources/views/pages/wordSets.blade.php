@extends('layout.app')
@section('customCSS')
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js">
        function beforePrintHandler () {
            for (var id in Chart.instances) {
                Chart.instances[id].resize()
            }
        }
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <h1>Zestawy słówek - {{$data['podkategoria']}}</h1>
            <p>Tutaj możesz wybrać interesujący Cię zestaw słówek.</p>
            @if (session()->has('loggedUser'))

            <div class="float-left" style="height: 50px;">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#utworzZestaw">
                            Utwórz zestaw
                        </button>

                        <div class="modal fade" id="utworzZestaw">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Utwórz zestaw</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="form-group">
                                            {!! Form::open(array('action'=>['ZestawController@create','kategoria'=>$data['kategoria'],
            'podkategoria'=>$data['podkategoria']], 'name' => 'add_name', 'id' => 'add_name', 'method' => 'POST')) !!}


                                                <div class="alert alert-danger print-error-msg" style="display:none">
                                                    <ul></ul>
                                                </div>


                                                <div class="alert alert-success print-success-msg" style="display:none">
                                                    <ul></ul>
                                                </div>


                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="dynamic_field">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="3" scope="col">
                                                                @if($data['canCreate']==true || session()->get('loggedUser')->rola_id==1)
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="checkbox" class="form-check-input"  name="private" value=true>Zestaw publiczny
                                                                    </label>
                                                                </div>
                                                                    @else
                                                                    <div class="form-check disabled">
                                                                        <label class="form-check-label">
                                                                            <input type="checkbox" class="form-check-input" name="private" value=true disabled>Zestaw publiczny
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="3" scope="col"><input type="text" name="nazwaZestawu" placeholder="Nazwa zestawu" class="form-control name_list" required/></th>
                                                        </tr>
                                                        </thead>
                                                        <tr>
                                                            <td>
                                                                <select class="custom-select d-block w-200" name="jezyk1" required>
                                                                    <option value="">Jezyk 1</option>
                                                                    @foreach ($data['jezyki'] as $jezyk)
                                                                        <option>
                                                                            {{$jezyk->nazwa}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="custom-select d-block w-200" name="jezyk2" required>
                                                                    <option value="">Jezyk 2</option>
                                                                    @foreach ($data['jezyki'] as $jezyk)
                                                                        <option>
                                                                            {{$jezyk->nazwa}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>

                                                        </tr>
                                                    </table>

                                                    <button type="button" name="add" id="add" class="btn btn-outline-primary btn-block">Dodaj wiersz</button><p></p>
                                                        <button class="btn btn-outline-success btn-block" type="submit">Utwórz zestaw</button>
                                                        {!! Form::close() !!}



                                                    <p></p>
                                                </div>


                                            </form>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
                                    </div>

                                </div>
                            </div>
                        </div>

            </div>
            @endif
            <table class="table table-bordered">

                <thead>
                <tr>
                    <th scope="col">Akcje</th>
                    <th scope="col">Zestaw</th>
                    <th scope="col">Język 1</th>
                    <th scope="col">Język 2</th>
                    <th scope="col">Ilość słówek</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Ostatnia edycja</th>
                    @if (session()->has('loggedUser'))
                    <th scope="col">Wynik</th>
                    @endif
                </tr>
                </thead>
                @php ($i=0)
                @foreach ($data['zestawy'] as $zestaw)
                <tr>
                    <td>
                        @if(session()->has('loggedUser'))
                        @if((session()->get('loggedUser')->rola_id==1)||
                        ((session()->get('loggedUser')->rola_id==2)&&($data['canCreate']==true))||
                        ((session()->get('loggedUser')->rola_id==3)&&($zestaw->konto_id==session()->get('loggedUser')->id)))
                        <a style="text-decoration:none;" href="/crud/category/{{$data['kategoria']}}/delete/{{$zestaw->id}}" title="Usuń rekord" data-toggle="popover" data-trigger="hover" data-content="Ten rekord będzie usunięty z bazy danych!">
                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                        </a>
                            <a style="text-decoration:none;" href="/crud/category/{{$data['kategoria']}}/edit/{{$zestaw->id}}" title="Edytuj rekord" data-toggle="popover" data-trigger="hover" data-content="Przejdź do strony dzięki której zmodyfikujesz dany rekord.">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                        @endif
                            @endif
                    </td>
                    <td><a href="/category<?php echo '/' ;echo $data['kategoria'] . '/';echo $data['podkategoria'] . '/';echo $zestaw->nazwa_zestawu;?>"><?php echo $zestaw->nazwa_zestawu?></a></td>
                    <td><?php echo $zestaw->jezyk1?></td>
                    <td><?php echo $zestaw->jezyk2?></td>
                    <td><?php echo $zestaw->ilosc_slowek?></td>
                    <td><?php echo $zestaw->login;
                        if(!empty($zestaw->imie)||!empty($zestaw->nazwisko)) {
                            echo ' ( ' . $zestaw->imie . ' ' . $zestaw->nazwisko . ' )';
                        }

                        ?></td>
                    <td><?php echo $zestaw->data_edycji?></td>
                    @if (session()->has('loggedUser'))

                    <td>
                        @if($data['wyniki'][$i]!=null)
                        <div class="chart-container" style="position: relative; height:13vh; width:15vw">
                            <canvas id="myChart{{$i}}"></canvas>
                        </div>
                        <script>
                            var ctx = document.getElementById('myChart{{$i}}').getContext('2d');
                            var chart = new Chart(ctx, {
                                // The type of chart we want to create
                                type: 'line',

                                // The data for our dataset

                                data: {

                                    labels: [
                                        @foreach($data['wyniki'][$i] as $wynik)
                                            <?php echo "'" . substr($wynik['data_wyniku'],5,strlen($wynik['data_wyniku'])-5) . "',"?>
                                        @endforeach
                                    ],


                                    datasets: [{
                                        backgroundColor: 'rgb(255, 99, 132)',
                                        borderColor: 'rgb(255, 99, 132)',
                                        data: [
                                            @foreach($data['wyniki'][$i] as $wynik)
                                            {{$wynik['wynik'] . ','}}
                                            @endforeach
                                        ],
                                    }]

                                },

                                // Configuration options go here
                                options: {
                                    legend: {
                                        display: false
                                    }
                                }
                            });
                        </script>
                    </td>
                    @endif
                        @php($i++)
                        @endif
                </tr>
                @endforeach


            </table>
            @if(isset($data['zestawyPrywatne']))
                @if(count(($data['zestawyPrywatne']))>0)
                <h1>Twoje zestawy</h1>
            <p></p>
            <table class="table table-bordered">

                <thead>
                <tr>
                    <th scope="col">Akcje</th>
                    <th scope="col">Zestaw</th>
                    <th scope="col">Język 1</th>
                    <th scope="col">Język 2</th>
                    <th scope="col">Ilość słówek</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Ostatnia edycja</th>
                    @if (session()->has('loggedUser'))
                        <th scope="col">Wynik</th>
                    @endif
                </tr>
                </thead>
                @php ($i=0)

                @foreach ($data['zestawyPrywatne'] as $zestaw)
                    <tr>
                        <td>
                            <a style="text-decoration:none;" href="/crud/category/{{$data['kategoria']}}/delete/{{$zestaw->id}}" title="Usuń rekord" data-toggle="popover" data-trigger="hover" data-content="Ten rekord będzie usunięty z bazy danych!">
                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                            </a>
                            <a style="text-decoration:none;" href="/crud/category/{{$data['kategoria']}}/edit/{{$zestaw->id}}" title="Edytuj rekord" data-toggle="popover" data-trigger="hover" data-content="Przejdź do strony dzięki której zmodyfikujesz dany rekord.">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>

                        </td>
                        <td><a href="/category<?php echo '/' ;echo $data['kategoria'] . '/';echo $data['podkategoria'] . '/';echo $zestaw->nazwa_zestawu;?>"><?php echo $zestaw->nazwa_zestawu?></a></td>
                        <td><?php echo $zestaw->jezyk1?></td>
                        <td><?php echo $zestaw->jezyk2?></td>
                        <td><?php echo $zestaw->ilosc_slowek?></td>
                        <td><?php echo $zestaw->login;
                            if(!empty($zestaw->imie)||!empty($zestaw->nazwisko)) {
                                echo ' ( ' . $zestaw->imie . ' ' . $zestaw->nazwisko . ' )';
                            }

                            ?></td>
                        <td><?php echo $zestaw->data_edycji?></td>
                        @if (session()->has('loggedUser'))

                            <td>
                                @if($data['wynikiPrywatne'][$i]!=null)
                                    <div class="chart-container" style="position: relative; height:13vh; width:15vw">
                                        <canvas id="myCharta{{$i}}"></canvas>
                                    </div>
                                    <script>
                                        var ctx = document.getElementById('myCharta{{$i}}').getContext('2d');
                                        var chart = new Chart(ctx, {
                                            // The type of chart we want to create
                                            type: 'line',

                                            // The data for our dataset

                                            data: {

                                                labels: [
                                                    @foreach($data['wynikiPrywatne'][$i] as $wynik)
                                                    <?php echo "'" . substr($wynik['data_wyniku'],5,strlen($wynik['data_wyniku'])-5) . "',"?>
                                                    @endforeach
                                                ],


                                                datasets: [{
                                                    backgroundColor: 'rgb(255, 99, 132)',
                                                    borderColor: 'rgb(255, 99, 132)',
                                                    data: [
                                                        @foreach($data['wynikiPrywatne'][$i] as $wynik)
                                                        {{$wynik['wynik'] . ','}}
                                                        @endforeach
                                                    ],
                                                }]

                                            },

                                            // Configuration options go here
                                            options: {
                                                legend: {
                                                    display: false
                                                }
                                            }
                                        });
                                    </script>
                            </td>
                        @endif
                        @php($i++)
                        @endif
                    </tr>
                @endforeach
            </table>
            @endif
                @endif




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
            $('[data-toggle="popover"]').popover();
        });
    </script>
    <script type="text/javascript">

        $(document).ready(function(){
            var postURL = "<?php echo url('addmore'); ?>";
            var i=1;


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


            function printErrorMsg (msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $(".print-success-msg").css('display','none');
                $.each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
            }

        });

    </script>
    </body>
@endsection