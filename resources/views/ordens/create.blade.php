@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Reserva</h2>
    </div>
    <div class="card-body">
        <form method="post" action="{{route('ordens.store')}}" >
        @csrf
        <div class="row">
            <div class="col-6">
            <h5>Fecha:</h5>
            <input type="text"  name="fecha" value="{{$reserva->fecha}}" class="focus border-primary  form-control"readonly>
            <h5>Hora:</h5>
            <input type="text"  name="hora" value="{{$reserva->hora}}" class="focus border-primary  form-control"readonly>                    
            </div>
            <div class="col-6">
            <h5>Tipo:</h5>
            <input type="text"  name="tipo" value="{{$reserva->tipo}}" class="focus border-primary  form-control"readonly>        
            <h5>Estado:</h5>
            <input type="text"  name="estado" value="{{$reserva->estado}}" class="focus border-primary  form-control"readonly>        
            </div>
        </div>
        
        <br>
        </form>
    </div>
</div>


<div class="card">
    <div class="card-header">
        <h2>Registrar Orden De Trabajo</h2>
    </div>
    <div class="card-body">
        <form method="post" action="{{route('ordens.store')}}" >
        @csrf

        <h5>Descripcion:</h5>
        <input type="text"  name="descripcion" class="focus border-primary  form-control">
        @error('descripcion')
        <span class="text-danger">{{$message}}</span>
        @enderror

        <div class="form-group">
            <h5>Estado:</h5>
            <select name="estado"  class="focus border-primary  form-control">
                <option value="En Proceso">En Proceso</option>
                <option value="Finalizado">Finalizado</option>
                <option value="Cancelado">Cancelado</option>
                </select>
        </div>
        <h5>Fecha Iniciada:</h5>
        <input type="date"  name="fechai" class="focus border-primary  form-control">
        @error('fechai')
        <span class="text-danger">{{$message}}</span>
        @enderror

        <h5>Fecha Finalizada:</h5>
        <input type="date"  name="fechaf" class="focus border-primary  form-control">
        @error('fechaf')
        <span class="text-danger">{{$message}}</span>
        @enderror

        <h5>CI del Mecanico Responsable:</h5>
        <input type="text"  name="ci" class="focus border-primary  form-control">
        @error('ci')
        <span class="text-danger">{{$message}}</span>
        @enderror
        
                <h5>Mecanicos Ayudantes:</h5>
            @foreach ($mecanico as $mecanicos)
            <input type="checkbox" value="{{$mecanicos->id}}" name="mecanico[]"
                                class="form-check-input"> {{$mecanicos->nombre}} <br>
            @endforeach
            <input type="text"  name="reserva" value="{{$reserva->id}}"class="focus border-primary  form-control" hidden>            
        <br>
        <button  class="btn btn-primary" type="submit">Registrar</button>
        <a class="btn btn-danger" href="{{route('ordens.index')}}">Volver</a>
        </form>
    </div>
</div>
@stop
