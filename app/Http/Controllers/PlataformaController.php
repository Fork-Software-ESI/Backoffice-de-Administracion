<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plataforma;
use App\Models\CamionPlataforma;
use App\Models\Camion;
use App\Models\CamionPlataformaSalida;
use Illuminate\Support\Facades\Validator;


class PlataformaController extends Controller
{
    //
    public function mostrarPlataforma()
    {
        $plataforma = Plataforma::all()->whereNull('deleted_at');

        $datos = [];

        foreach($plataforma as $plataformas){
            $camion = CamionPlataforma::where('Numero_Plataforma', $plataformas->Numero)->first();
            $matricula = $camion ? Camion::where('ID', $camion->ID_Camion)->first()->Matricula : 'No asignado';
            $llegada = $camion ? $camion->Fecha_Hora_Llegada : 'No asignado';
            $salida = $camion ? CamionPlataformaSalida::where('Numero_Plataforma', $plataformas->Numero)->first()->Fecha_Hora_Salida : 'No ha salido';

            $datos[] = [
                'Numero' => $plataformas->Numero,
                'ID_Almacen' => $plataformas->ID_Almacen,
                'Camion' => $matricula,
                'horaLlegada' => $llegada,
                'horaSalida' => $salida,
            ];
        }

        return view('almacen.plataforma.mostrarPlataforma', ['datos' => $datos]);
    }

    public function buscarPlataforma(Request $request)
    {
        $numero = $request->input('numero');
        $plataforma = Plataforma::find($numero);

        if (!$plataforma) {
            return redirect()->route('vistaBuscarPlataforma')->with(['mensaje' => 'Plataforma no encontrada']);
        }
        
        $camion = CamionPlataforma::where('Numero_Plataforma', $plataforma->Numero)->first();
        $matricula = $camion ? Camion::where('ID', $camion->ID_Camion)->first()->Matricula : 'No asignado';
        $llegada = $camion ? $camion->Fecha_Hora_Llegada : 'No asignado';
        $salida = $camion ? CamionPlataformaSalida::where('Numero_Plataforma', $plataforma->Numero)->first()->Fecha_Hora_Salida : 'No ha salido';
        
        $datos = [
            'Numero' => $plataforma->Numero,
            'ID_Almacen' => $plataforma->ID_Almacen,
            'Camion' => $matricula,
            'horaLlegada' => $llegada,
            'horaSalida' => $salida,
            'created_at' => $plataforma->created_at,
            'updated_at' => $plataforma->updated_at,
            'deleted_at' => $plataforma->deleted_at,
        ];

        return view('almacen.plataforma.buscarPlataforma', ['datos' => $datos]);
    }
}
