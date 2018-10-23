@extends('backLayout.app')
@section('title')
Konto
@stop

@section('content')

    <h1>Konto <a href="{{ url('konto/create') }}" class="btn btn-primary pull-right btn-sm">Add New Konto</a></h1>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tblkonto">
            <thead>
                <tr>
                    <th>ID</th><th>Id</th><th>Rola Id</th><th>Imie</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($konto as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="{{ url('konto', $item->id) }}">{{ $item->id }}</a></td><td>{{ $item->rola_id }}</td><td>{{ $item->imie }}</td>
                    <td>
                        <a href="{{ url('konto/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">Update</a> 
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['konto', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('#tblkonto').DataTable({
            columnDefs: [{
                targets: [0],
                visible: false,
                searchable: false
                },
            ],
            order: [[0, "asc"]],
        });
    });
</script>
@endsection