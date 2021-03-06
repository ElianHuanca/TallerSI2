@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista mecanicos</h1>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a class="btn btn-primary" href="{{route('mecanicos.create')}}">Registrar mecanico</a>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered shadow-lg mt-4" id="mecanicos">
            <thead>
                <tr>
                    <th >Id</th>
                    <th >CI</th>
                    <th >Nombres</th>
                    <th >Email</th>
                    <th >Fecha Nac</th>
                    <th >Especialidad</th>
                    <th >Genero</th>
                    <th >Celular</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mecanico as $mecanicos)
                <tr>
                    <td>{{$mecanicos->id}}</td>
                    <td>{{$mecanicos->ci}}</td>
                    <td>{{$mecanicos->nombre}}</td>
                    <td>{{$mecanicos->email}}</td>
                    <td>{{$mecanicos->fecha}}</td>
                    <td>{{$mecanicos->especialidad}}</td>
                    <td>{{$mecanicos->genero}}</td>
                    <td>{{$mecanicos->celular}}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{route('mecanicos.edit',$mecanicos)}}">Editar</a>
                        <form action="{{route('mecanicos.destroy',$mecanicos)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#mecanicos').DataTable({
            autoWidth:false
        });
    </script>
@endsection
