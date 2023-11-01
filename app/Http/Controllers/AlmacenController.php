<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Camion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Plataforma;
use App\Models\CamionPlataforma;
use App\Models\CamionPlataformaSalida;
use Carbon\Carbon;


class AlmacenController extends Controller
{
    public function mostrarAlmacenes()
    {
        $almacen = Almacen::all()->whereNull('deleted_at');
        return view('almacen.mostrarAlmacenes', ['almacen' => $almacen]);
    }
    
    public function buscarAlmacen(Request $request)
    {
        $ID = $request->input('id');
        $almacen = Almacen::find($ID);
        if (!$almacen) {
            return redirect()->route('vistaBuscarAlmacen')->with(['mensaje' => 'Almacén no encontrado']);
        }
        return view('almacen.buscarAlmacen', ['almacen' => $almacen]);
    }

    public function crearAlmacen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Direccion' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        if (Almacen::where('Direccion', $validatedData['Direccion'])->exists()) {
            return response()->json(['error' => 'La direccion del almacen ya está en uso'], 422);
        }

        Almacen::create($validatedData);

        session()->flash('mensaje', 'Almacen creado exitosamente');
        return redirect()->route('crearAlmacen');
    }

    public function editarAlmacen($ID)
    {
        $almacen = Almacen::find($ID);
        if($almacen->deleted_at != null)
            return redirect()->route('vistaBuscarAlmacen')->with(['mensaje' => 'No puedes editar un almacén eliminado']);
        return view('almacen.editarAlmacen', ['almacen' => $almacen]);
    }
    public function actualizarAlmacen(Request $request, $ID)
    {
        $almacen = Almacen::find($ID);
    
        $validator = Validator::make($request->all(), [
            'Direccion' => 'string|max:255',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('editarAlmacen', ['id' => $almacen->ID])->withErrors($validator)->withInput();
        }
    
        $data = $request->only(['Direccion']);

        if ($almacen->Direccion == $data['Direccion']) {
            return redirect()->route('vistaBuscarAlmacen', ['id' => $almacen->ID])->with('mensaje', 'No se realizaron cambios');
        }
        if ($almacen->update($data)) {
            $almacen->save();
            return redirect()->route('vistaBuscarAlmacen', ['id' => $almacen->ID])->with('mensaje', 'Almacen actualizado exitosamente');
        } else {
            return redirect()->route('vistaBuscarAlmacen', ['id' => $almacen->ID])->with('mensaje', 'Hubo un problema al actualizar el Almacen');
        }
    }
    public function eliminarAlmacen($ID)
    {
        $almacen = Almacen::find($ID);

        if($almacen->deleted_at != null)
            return redirect()->route('vistaBuscarAlmacen')->with(['mensaje' => 'Este almacen ya está eliminado']);
        $almacen->deleted_at = now();
        $almacen->save();

        return redirect()->route('vistaBuscarAlmacen')->with('mensaje', 'Almacen eliminado con éxito');
    }

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
}
