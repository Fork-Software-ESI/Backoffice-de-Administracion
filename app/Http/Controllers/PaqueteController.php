<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paquete;
use App\Models\Lote;
use App\Models\Forma;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class PaqueteController extends Controller
{
    public function validarDireccion($direccion)
    {
        $apiKey = '7a6TfdGhaJbpPMG2ehCfSExHYsnzdkIb5a0YlJzjU5U';
        $address = urlencode($direccion);
        $countryName = "Uruguay";
        $url = "https://geocode.search.hereapi.com/v1/geocode?apiKey=$apiKey&q=$address&country=$countryName";

        $response = @file_get_contents($url);
        $data = json_decode($response);

        if ($data == null || empty($data->items)) {
            return true;
        } else {
            return false;
        }
    }
    public function crearPaquete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Descripcion' => 'string',
            'Peso_Kg' => 'required|numeric|min:1',
            'ID_Cliente' => 'required|exists:cliente,ID',
            'ID_Estado' => 'required|exists:estadop,ID',
            'Destino' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->route('crearPaquete')->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();

        $validez = $this->validarDireccion($validatedData['Destino']);
        if (!$validez) {
            return redirect()->route('crearPaquete')->withErrors(['Destino' => 'La dirección ingresada no es válida'])->withInput();
        }
        $validatedData['Codigo'] = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
        Paquete::create($validatedData);

        session()->flash('mensaje', 'Paquete creado exitosamente, codigo: ' . $validatedData['Codigo']);
        return redirect()->route('crearPaquete');
    }

    public function mostrarPaquetes()
    {
        $paquete = Paquete::all();
        return view('paquete.mostrarPaquetes', ['paquete' => $paquete]);
    }

    public function buscarPaquete(Request $request)
    {
        $ID = $request->input('id');
        $paquete = Paquete::find($ID);

        if (!$paquete) {
            return redirect()->route('vistaBuscarPaquete')->with(['mensaje' => 'Paquete no encontrado']);
        }

        return view('paquete.buscarPaquete', ['paquete' => $paquete]);
    }

    public function editarPaquete($id)
    {
        $paquete = Paquete::find($id);
        
        if($paquete -> deleted_at != null){
            return redirect()->route('vistaBuscarPaquete')->with('mensaje', 'No se puede editar un paquete eliminado');
        }
        return view('paquete.editarPaquete', ['paquete' => $paquete]);
    }


    public function actualizarPaquete(Request $request, $id)
    {
        $paquete = Paquete::find($id);

        $validator = Validator::make($request->all(), [
            'descripcion' => 'string',
            'peso_Kg' => 'numeric',
            'ID_Cliente' => 'numeric',
            'ID_Estado' => 'in:1,2,3',
            'destino' => 'string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('editarPaquete', ['id' => $paquete->ID])->withErrors($validator)->withInput();
        }

        $data = $request->only(['descripcion', 'peso_Kg', 'ID_Cliente', 'ID_Estado', 'destino']);
        

        $paquete-> update([
            'Descripcion' => $data['descripcion'],
            'Peso_Kg' => $data['peso_Kg'],
            'ID_Cliente' => $data['ID_Cliente'],
            'ID_Estado' => $data['ID_Estado'],
            'Destino' => $data['destino'],
        ]);

        return redirect()->route('vistaBuscarPaquete', ['id' => $paquete->ID])
        ->with('mensaje', 'Paquete actualizado de forma exitosa');
    }

    public function asignarLote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ID_Paquete' => 'required',
            'ID_Lote' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('vistaAsignarLote')->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $paquete = Paquete::where('ID', $validatedData['ID_Paquete'])->first();
        
        if(!$paquete){
            return redirect()->route('vistaBuscarPaquete')->with('mensaje' , 'Paquete no encontrado');
        }

        $lote = Lote::where('ID', $validatedData['ID_Lote'])->first();

        if(!$lote){
            return redirect()->route('vistaBuscarLote')->with('mensaje', 'Lote no encontrado');
        }

        $paqueteAsignado = Forma::where('ID_Paquete', $validatedData['ID_Paquete'])->first();
        if(!$paqueteAsignado){
            return redirect()->route('vistaAsignarLote')->with('mensaje', 'Paquete ya asignado a un lote');
        }

        $forma = Forma::create([
            'ID_Lote' => $validatedData['ID_Lote'],
            'ID_Paquete' => $validatedData['ID_Paquete'],
            'ID_Estado' => 1,
        ]);

        $forma->save();

        return redirect()->route('vistaAsignarLote')->with('mensaje', 'Paquete asignado a lote');
    }

    public function eliminarPaquete($id)
    {
        $paquete = Paquete::find($id);

        if($paquete -> deleted_at != null){
            return redirect()->route('vistaBuscarPaquete')->with('mensaje', 'No se puede eliminar un paquete eliminado');
        }

        $paquete->deleted_at = now();
        $paquete->save();

        return redirect()->route('vistaBuscarPaquete')->with('mensaje', 'Paquete eliminado con éxito');
    }
}
