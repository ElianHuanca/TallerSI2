<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservaServicio extends Model
{
    protected $table = 'reserva_servicio';
    //protected $fillable=["reserva_id","servicio_id"];
    use HasFactory;
}
