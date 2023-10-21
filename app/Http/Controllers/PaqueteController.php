<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paquete;
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
            'descripcion' => 'required|string',
            'peso_kg' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('crearPaquete')->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        Paquete::create($validatedData);

        session()->flash('mensaje', 'Paquete creado exitosamente');
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
            return redirect()->route('vistaBuscarPaquete')->with(['mensaje' => 'Paquete no encontrado']);
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
    

    public function eliminarPaquete($id)
    {
        $paquete = Paquete::find($id);

        $paquete->deleted_at = now();
        $paquete->save();

        return redirect()->route('vistaBuscarPaquete')->with('mensaje', 'Paquete eliminado con éxito');
    }
}
