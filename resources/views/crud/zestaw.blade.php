<!DOCTYPE html>
<html>
<head>
    <title>Laravel Dependent Dropdown Example with demo</title>
    <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
</head>
<body>


<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Select State and get bellow Related City</div>
        <div class="panel-body">
            <div class="form-group">
                <label for="title">Select State:</label>
                <select name="kategoria" class="form-control" style="width:350px">
                    <option value="">--- Select State ---</option>

                    @foreach ($kategorie as $kategoria)

                        <option value="{{ $kategoria->id }}">{{ $kategoria->nazwa }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">Select City:</label>
                <select name="podkategoria" class="form-control" style="width:350px">
                </select>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="kategoria"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    url: '/myform/ajax/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {


                        $('select[name="podkategoria"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="podkategoria"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });


                    }
                });
            }else{
                $('select[name="podkategoria"]').append('haeheaeah');
            }
        });
    });
</script>


</body>
</html>