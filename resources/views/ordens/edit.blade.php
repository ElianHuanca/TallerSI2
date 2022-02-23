@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Datos De Orden De Trabajo</h1>
@stop

@section('content')
<form method="post" action="{{route('ordens.update',$orden)}}">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-6">
            <h5>Descripcion:</h5>
            <input type="text"  name="descripcion" value="{{$orden->descripcion}}" class="focus border-primary  form-control" >
            @error('descripcion')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-6">
             <div class="form-group">
            <h5>Estado:</h5>
            <select name="estado"  class="focus border-primary  form-control">
                <option value="{{$orden->estado}}">{{$orden->estado}}</option>
                <option value="En Proceso">En Proceso</option>
                <option value="Finalizado">Finalizado</option>
                <option value="Cancelado">Cancelado</option>
                </select>
             </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <h5>Fecha Iniciada:</h5>
            <input type="date"  name="fechai" value="{{$orden->fechai}}" class="focus border-primary  form-control" >
            @error('fechai')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-6">
            <h5>Fecha Finalizada:</h5>
            <input type="date"  name="fechaf" value="{{$orden->fechaf}}" class="focus border-primary  form-control" >
            @error('fechaf')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <h5>CI Del Mecanico Encargado:</h5>
            <input type="text"  name="ci" value="{{$orden->mecanico_id}}" class="focus border-primary  form-control" >
            @error('ci')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>

    <br>
    <button type="submit"  class="btn btn-info">Guardar</button>
    <a class="btn btn-danger" href="{{route('ordens.index')}}">Volver</a>

</form>
<br>
<div class="card">
    <button type="button" data-toggle="modal" data-target="#repuestos-modal" class="btn btn-secondary">Nueva orden de repuesto</button>
</div>

{{-- TABLA PARA VER LAS ORDENES DE REPUESTOS --}}
<div class="card">
    <div class="card-body">
        <table class="table table-striped" id="ordenRepuestos" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">Nro</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Fecha Orden</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($ordenesRepuestos as $ordenRepuesto)
                    <tr>
                        <td>{{$ordenRepuesto->id}}</td>
                        {{-- <td>{{$ordenRepuesto->estado}}</td> --}}
                        <td>
                            <select class="custom-select" id="selectEstadoOrden" onchange="changeEstadoOrden({{$ordenRepuesto->id}})">
                                @if ($ordenRepuesto->estado == 'entregado')
                                    <option value= "entregado">Entregado</option>
                                    <option value= "pendiente">Pendiente</option>

                                @else
                                    <option value= "pendiente">Pendiente</option>
                                    <option value= "entregado">Entregado</option>
                                    
                                @endif
                            </select>
                        </td>

                        <td>{{$ordenRepuesto->created_at}}</td>
                        <td>
                            {{-- <button class="btn btn-info btn-sm" onclick="return confirm('¿ESTA SEGURO DE  BORRAR?')" value="Borrar">Ver detalles</button>  --}}
                            <button type="button" data-toggle="modal" data-target="#repuestosEdit-modal" class="btn btn-secondary" onclick="cargarItems({{$ordenRepuesto->id}})">Ver detalles</button>
                            <input id="modalInputId" type="text" hidden value="{{$ordenRepuesto->id}}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- FIN TABLA DE ORDENES DE REPUESTOS --}} 


{{-- MODAL PARA CREAR UNA NUEVA ORDEN DE TRABAJO --}}
<div class="modal" tabindex="-1" role="dialog" id="repuestos-modal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
    {{-- FORMULARIO PARA EDITAR LA ORDEN DE REPUESTO --}}
    <form action="{{route('ordenRepuestos.store')}}" method="post"> 
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Nueva Orden de repuestos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <div class="modal-body" id="modal-body">
              <div class="row">
                  <div class="col-8">Nombre repuesto</div>
                  <div class="col-4">Cantidad requerida</div>
              </div>
              <div class="row">
                    <div class="col-8">
                        <input class="form-control mt-2" type="text" placeholder="Nombre Repuesto" name="repuestos[]">
                    </div>
                    <div class="col-4">
                        <input class="form-control mt-2" type="text" placeholder="Cantidad" name="cantidades[]">
                    </div>
                </div>
                <button type="button" id="agregarRepuesto" class="btn btn-primary mt-2" onclick="agregarItemRepuesto()" >Agregar Repuesto</button>

            <input type="text" name="ordenId" hidden value="{{$orden->id}}">
            
        </div>
        
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
      </div>
    </div>
  </div>
{{-- FIN MODAL NUEVA ORDEN DE REPUESTO --}}


{{-- MODAL PARA EDITAR LA ORDEN DE REPUESTO --}}
<div class="modal" tabindex="-1" role="dialog" id="repuestosEdit-modal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
    <form action="{{route('ordenRepuestos.store')}}" method="post"> 
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Editar Orden de repuestos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- FORMULARIO PARA CREAR LA ORDEN DE REPUESTO --}}
        <div class="modal-body" id="modalEdit-body">
              <div class="row">
                  <div class="col-8">Nombre repuesto</div>
                  <div class="col-4">Cantidad requerida</div>
    
              </div>
              <div id="itemsEditId">
                  {{-- CARGAR LISTA DE INPUTS CON JS --}}

              </div>

            <button type="button" class="btn btn-primary mt-2" onclick="agregarItemRepuesto()" id="agregarRepuestoEdit">Agregar Repuesto</button>
            <input type="text" name="ordenId" hidden value="{{$orden->id}}">
            
        </div>
        
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
      </div>
    </div>
  </div>
{{-- FIN VER ORDEN DE REPUESTO --}}
@stop

@section('js')
    <script>
        console.log('hola');
        var modal_body = document.getElementById('modal-body');
        var buttonAgregar = document.getElementById('agregarRepuesto');
        var buttonAgregarEdit = document.getElementById('agregarRepuestoEdit');
        // console.log(buttonAgregarEdit);



        const agregarItemRepuesto = () => {
            var div = document.createElement('div');
            div.className = 'row';
            console.log(div);
            var divNombre = document.createElement('div');
            var divPrecio = document.createElement('div');
            divNombre.className = 'col-8 mt-2';
            divPrecio.className = 'col-4 mt-2';

            console.log(divNombre);
            console.log(divPrecio);

            var inputNombre = document.createElement('input');
            inputNombre.className = 'form-control';
            inputNombre.name = 'repuestos[]';
            inputNombre.placeholder = 'Nombre Repuesto';

            var inputPrecio = document.createElement('input');
            inputPrecio.className = 'form-control';
            inputPrecio.name = 'cantidades[]';
            inputPrecio.placeholder = 'Cantidad'

            divNombre.appendChild(inputNombre);
            divPrecio.appendChild(inputPrecio);

            div.appendChild(divNombre);
            div.appendChild(divPrecio);

            modal_body.insertBefore(div, buttonAgregar);
        }

        const cargarItems = (id) => {
            var buttonAgregarEdit = document.getElementById('agregarRepuestoEdit');
            console.log(id);
            var modal_bodyEdit = document.getElementById('itemsEditId');
            modal_bodyEdit.innerHTML = '';
            fetch(`http://localhost/TallerSi2/public/api/itemsOrdenRepuesto/${id}`)
            .then(response => response.json())
            .then(data => {
                //console.log(data);
                data.forEach(element => {
                  console.log(element);
                //crear los html elements mientras se itera
                    var div = document.createElement('div');
                    div.className = 'row';

                    var divNombre = document.createElement('div');
                    var divPrecio = document.createElement('div');
                    divNombre.className = 'col-8 mt-2';
                    divPrecio.className = 'col-4 mt-2';

                    var inputNombre = document.createElement('input');
                    inputNombre.className = 'form-control';
                    inputNombre.name = 'repuestos[]';
                    inputNombre.value = element['nombre'];
                    inputNombre.placeholder = 'Nombre Repuesto';

                    var inputPrecio = document.createElement('input');
                    inputPrecio.className = 'form-control';
                    inputPrecio.name = 'cantidades[]';
                    inputPrecio.placeholder = 'Cantidad'
                    inputPrecio.value = element['cantidad'];


                    divNombre.appendChild(inputNombre);
                    divPrecio.appendChild(inputPrecio);

                    div.appendChild(divNombre);
                    div.appendChild(divPrecio);

                    //modal_bodyEdit.insertBefore(div, buttonAgregarEdit);
                    modal_bodyEdit.appendChild(div);
                });
            });

            
        }

        const changeEstadoOrden = (id)  => {
            var url = 'http://localhost/TallerSi2/public/api/changeEstadoOrdenRepuesto';
            console.log('changeEstadoOrden');
            const valor = document.getElementById('selectEstadoOrden').value
            var data = {id: id, estado: valor};
            fetch(url, {
            method: 'POST', // or 'PUT'
            body: JSON.stringify(data), // data can be `string` or {object}!
            headers:{
                'Content-Type': 'application/json'
            }
            }).then(res => res.json())
            .catch(error => console.error('Error:', error))
            .then(response => console.log('Success:', response));
        }
    </script>
@stop
