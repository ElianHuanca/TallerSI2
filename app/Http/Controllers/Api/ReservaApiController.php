<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\cliente;
use App\Models\Reserva;
use App\Models\reservaServicio;
use App\Models\Servicio;
use App\Models\vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class ReservaApiController extends Controller
{
    public function getServicios(){
        $servicios = Servicio::where('tipo','Domicilio')->get();
        //$servicios=Servicio::all();
        return response($servicios,200);
    }
    public function getReservas(){
        $reservas = Reserva::where('tipo','Domicilio')->get();
        //$servicios=Servicio::all();
        return response($reservas,200);
    }
    public function registerReserva(Request $request){
       // return $request->servicios;
        $request->validate([
            'fecha' => 'required',
            'hora' => 'required',
            'userId' =>'required',
        ]);       
        $cliente=cliente::where('user_id', $request->userId)->first();
        $vehiculo =vehiculo::where('cliente_id', $cliente->id)->first();
        $reserva = new Reserva();
        $reserva->fecha = $request->fecha;
        $reserva->hora=$request->hora;
        $reserva->tipo='Domicilio';
        $reserva->estado='Por Confirmar';
        $reserva->cliente_id=$cliente->id;
        $reserva->vehiculo_id=$vehiculo->id;
        $reserva->save();
        if ($request->servicio) {
            $reserva->servicios()->attach($request->servicio);
        } 
        return $reserva;
    }

    public function coordenadas(Request $request ){
        $request->validate([
            'latitud' => 'required',
            'longitud' => 'required',      
        ]);        
        $reserva=Reserva::where('estado', "Por Confirmar")->first();
        $reserva->latitud=$request->latitud;
        $reserva->longitud=$request->longitud;
        $reserva->save();
        return $reserva;
    }

}
