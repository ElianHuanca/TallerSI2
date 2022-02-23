<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="card-body">
        <table class="table table-striped table-bordered shadow-lg mt-4" id="ordens">
            <thead>
                <tr>
                    <th >Id</th>
                    <th >Descripcion</th>
                    <th >Estado</th>
                    <th >Fecha Iniciada</th>
                    <th >Fecha Finalizada</th>
                    <th>Mecanico</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orden as $ordens)
                <tr>
                    <td>{{$ordens->id}}</td>
                    <td>{{$ordens->descripcion}}</td>
                    <td>{{$ordens->estado}}</td>
                    <td>{{$ordens->fechai}}</td>
                    <td>{{$ordens->fechaf}}</td>
                    @foreach ($mecanico as $mecanicos)
                        @if($ordens->mecanico_id == $mecanicos->id)
                        <td>{{$mecanicos->nombre}}</td>
                        @endif
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>
</html>