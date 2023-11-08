<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Camion;
use App\Models\ChoferCamion;
use App\Models\Chofer;
use App\Models\Paquete;
use App\Models\LoteCamion;
use App\Models\Lote;
use App\Models\Forma;
use App\Models\CamionPlataforma;
use App\Models\Persona;

class CamionController extends Controller
{
    public function mostrarCamiones()
    {
        $camion = Camion::all();
        
        $data = [];
        foreach ($camion as $camiones) {

            $choferCamion = ChoferCamion::where('ID_Camion', $camiones->ID)->first();
            $nombre = $choferCamion ? Persona::find($choferCamion->ID_Chofer)->Nombre : 'No tiene';
            $camionPlataforma = CamionPlataforma::where('ID_Camion', $camiones->ID)->first();
            $plataforma = $camionPlataforma ? $camionPlataforma->Numero_Plataforma : 'No tiene';
            $almacen = $camionPlataforma ? $camionPlataforma->ID_Almacen : 'No tiene';
            $loteCamion = LoteCamion::where('ID_Camion', $camiones->ID)->first();
            $lote = $loteCamion ? $loteCamion->ID_Lote : 'No tiene';

            $data[] = [
                'id' => $camiones->ID,
                'matricula' => $camiones->Matricula,
                'pesoMaximoKg' => $camiones->PesoMaximoKg,
                'chofer' => $nombre,
                'almacen' => $almacen,
                'plataforma' => $plataforma,
                'lote' => $lote,
            ];
        }
        
        return view('camion.mostrarCamiones', ['datos' => $data] , ['camion' => $camion]);
    }
    public function buscarCamion(Request $request)
    {
        $matricula = $request->input('matricula');
        $camion = Camion::where('Matricula', $matricula)->first();

        if (!$camion) {
            return redirect()->route('vistaBuscarCamion')->with(['mensaje' => 'Camión no encontrado']);
        }

        $choferCamion = ChoferCamion::where('ID_Camion', $camion->ID)->first();
        $chofer = Persona::find($choferCamion->ID_Chofer);
        $nombre = $chofer ? $chofer->Nombre : 'No tiene';
        $camionPlataforma = CamionPlataforma::where('ID_Camion', $camion->ID)->first();
        $plataforma = $camionPlataforma ? $camionPlataforma->Numero_Plataforma : 'No tiene';
        $almacen = $camionPlataforma ? $camionPlataforma->ID_Almacen : 'No tiene';
        $loteCamion = LoteCamion::where('ID_Camion', $camion->ID)->first();
        $lote = $loteCamion ? $loteCamion->ID_Lote : 'No tiene';

        $datos = [
            'id' => $camion->ID,
            'matricula' => $camion->Matricula,
            'pesoMaximoKg' => $camion->PesoMaximoKg,
            'chofer' => $nombre,
            'almacen' => $almacen,
            'plataforma' => $plataforma,
            'lote' => $lote,
            'created_at' => $camion->created_at,
            'updated_at' => $camion->updated_at,
            'deleted_at' => $camion->deleted_at,
        ];
        
        return view('camion.buscarCamion', ['camiones' => $datos]);
    }

    public function crearCamion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'matricula' => 'required|string|unique:camion|regex:/^[A-Za-z]{3}[0-9]{4}$/',
            'pesoMaximoKg' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('crearCamion')->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        if (Camion::where('matricula', $validatedData['matricula'])->exists()) {
            return redirect()->route('crearCamion')->with('mensaje', 'La matricula del camión ya existe');
        }

        $camion = Camion::create([
            'Matricula' => $validatedData['matricula'],
            'PesoMaximoKg' => $validatedData['pesoMaximoKg'],
        ]);
        $camion -> save();
        session()->flash('mensaje', 'Camion creado exitosamente');
        return redirect()->route('crearCamion');
    }
    
    public function editarCamion($matricula)
    {
        $camion = Camion::where('matricula', $matricula)->first();

        if ($camion->deleted_at != null) {
            return redirect()->route('vistaBuscarCamion')->with('mensaje', 'No puedes modificar un camión eliminado');
        }

        return view('camion.editarCamion', ['camion' => $camion]);
    }

    public function actualizarCamion(Request $request, $matricula)
    {
        $camion = Camion::where('matricula', $matricula)->first();

        $validator = Validator::make($request->all(), [
            'matricula' => 'string|regex:/^[A-Za-z]{3}[0-9]{4}$/',
            'pesoMaximoKg' => 'numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('editarCamion', ['matricula' => $camion->Matricula])->withErrors($validator)->withInput();
        }

        $data = $request->only(['matricula', 'pesoMaximoKg']);

        if ($data['matricula'] != $camion->Matricula) {
            if (Camion::where('matricula', $data['matricula'])->exists()) {
                return redirect()->route('editarCamion', ['matricula' => $camion->Matricula])->with('mensaje', 'La matricula del camión ya existe');
            }
        }

        $camion -> update([
            'Matricula' => $data['matricula'],
            'PesoMaximoKg' => $data['pesoMaximoKg'],
        ]);

        return redirect()->route('vistaBuscarCamion', ['matricula' => $camion->Matricula])
            ->with('mensaje', 'Camión actualizado exitosamente');
    }

    public function asignarChofer(Request $request)
    {
        $validator = Validator::make($request -> all(),[
            'ID_Camion' => 'required', 'numeric',
            'ID_Chofer' => 'required', 'numeric',
            'estado' => 'required', 'numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('vistaAsignarCamion')->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $camionID = $data['ID_Camion'];
        $choferID = $data['ID_Chofer'];
        $estado = $data['estado'];

        $camion = Camion::find($camionID);
        if (!$camion) {
            return redirect()->route('vistaAsignarChofer')->with('mensaje', 'Camion no encontrado');
        }
        if ($camion->deleted_at != null) {
            return redirect()->route('vistaAsignarChofer')->with('mensaje', 'No puedes asignar un chofer a un camión eliminado');
        }
        
        $camionAsignado = ChoferCamion::where('ID_Camion', $camion->ID);
        if($camionAsignado){
            return redirect()->route('vistaAsignarChofer')->with('mensaje', 'Camion ya tiene un chofer asignado');
        }

        $chofer = Chofer::find($choferID);
        if (!$chofer) {
            return redirect()->route('vistaAsignarChofer')->with('mensaje', 'Chofer no encontrado');
        }
        if ($chofer->deleted_at != null) {
            return redirect()->route('vistaAsignarChofer')->with('mensaje', 'No puedes asignar un chofer eliminado');
        }

        $choferAsignado = ChoferCamion::where('ID_Chofer', $chofer->ID);
        if($choferAsignado){
            return redirect()->route('vistaAsignarChofer')->with('mensaje', 'Chofer ya tiene un camion asignado');
        }

        $choferCamion = ChoferCamion::create([
            'ID_Camion' => $camionID,
            'ID_Chofer' => $choferID,
            'ID_Estado' => $estado,
            'Fecha_Hora_Inicio' => now(),
        ]);

        $choferCamion->save();

        session()->flash('mensaje', 'Camion vinculado con Chofer existosamente');
        return redirect()->route('asignarChofer');
    }
    public function contenidoCamion($matricula)
    {
        $camion = Camion::where('Matricula', $matricula)->first();
        
        if (!$camion) {
            return redirect()->route('vistaBuscarCamion')->with('mensaje', 'El camión no se encontró');
        }

        $choferCamion = ChoferCamion::where('ID_Camion', $camion->ID)->first();
        
        if (!$choferCamion) {
            return redirect()->route('vistaBuscarCamion')->with('mensaje', 'El camión no tiene chofer asignado');
        }

        $lotesCamion = LoteCamion::where('ID_Camion', $camion->ID)->first();

        if(!$lotesCamion){
            return redirect()->route('vistaBuscarCamion')->with('mensaje', 'El camión no tiene lote asignado');
        }

        $lote = Lote::where('ID', $lotesCamion->ID_Lote)->first();

        $forma = Forma::where('ID_Lote', $lote->ID)->first();
        if(!$forma){
            return redirect()->route('vistaBuscarCamion')->with('mensaje', 'El camión no tiene lote asignado');
        }

        $paquete = Paquete::find($forma->ID_Paquete);

        $datosLote = [
            'lote' => $lote ? $lote->ID : 'No disponible',
            'descripcionLote' => $lote ? $lote->Descripcion : 'No disponible',
            'pesoLote' => $lote ? $lote->Peso_Kg : 'No disponible',
        ];
    
        $datosPaquete = [
            'paquete' => $paquete ? $paquete->ID : 'No disponible',
            'descripcionPaquete' => $paquete ? $paquete->Descripcion : 'No disponible',
            'pesoPaquete' => $paquete ? $paquete->Peso_Kg : 'No disponible',
        ];

        return view('camion.contenidoCamion', ['datosLote' => $datosLote, 'datosPaquete' => $datosPaquete ]);
    }

    public function eliminarCamion($matricula)
    {
        $camion = Camion::where('Matricula', $matricula)->first();
        if($camion -> deleted_at != null){
            return redirect()->route('vistaBuscarCamion')->with('mensaje', 'No puedes eliminar un camión eliminado');
        }

        $camion->deleted_at = now();
        $camion->save();

        return redirect()->route('vistaBuscarCamion')->with('mensaje', 'Camion eliminado con éxito');
    }
}