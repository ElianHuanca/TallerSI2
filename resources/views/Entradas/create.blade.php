@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Registrar nueva Entrada</h1>
@stop

@section('content')
    <form action="{{route('entradas.store')}}" method="POST">
        @csrf

        <label for="hora">Ingrese la hora</label>
        <input type="time" name="hora" class="form-control" placeholder="">
        @error('hora')
        <small>*{{$message}}</small>
        <br><br>
        @enderror
        <br>

        <label for="fecha">Ingrese la fecha</label>
        <input type="date" name="fecha" class="form-control" placeholder="">
        @error('fecha')
        <small>*{{$message}}</small>
        <br><br>
        @enderror
        <br>

        {{-- <label for="tipo">Seleccione el tip</label>
        <select name="tipo" id="" class="form-control">
            <option value=1>Entrada</option>
            <option value=2>Salida</option>
        </select> --}}

        <label for="descripcion">Ingrese una descripcion (Opcional)</label>
        <input type="text" name="descripcion" class="form-control" >
        @error('descripcion')
        <small>*{{$message}}</small>
        <br><br>
        @enderror
        <br>

        <label for="file">Subir imágenes (Opcional)</label>
        <br>
        <input type="file" name="file">
        @error('file')
        <small>*{{$message}}</small>
        <br><br>
        @enderror
        <br>
        <br>

        <input type="number" value=1 name="tipo" hidden>

        <div class="card">
            <span>Imágenes:</span>
            
        </div>

        <button  class="btn btn-danger btn-sm" type="submit">Registrar Entrada</button>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
