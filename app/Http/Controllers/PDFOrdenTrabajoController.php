<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orden;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Models\mecanico;
use PDF;


class PDFOrdenTrabajoController extends Controller
{
    public function ordenesTrabajoPdf()
    {
        $orden=orden::all();
        $mecanico=mecanico::all();
        $pdf = PDF::loadView('ordens.pdf', ['orden' => $orden]);
        
        return view('ordens.pdf',compact('orden','mecanico'));
    }
}
