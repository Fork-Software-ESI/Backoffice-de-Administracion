<?php

namespace App\Http\Controllers;

use App\Models\ChoferCamion;
use Illuminate\Http\Request;
use App\Models\Paquete;
use App\Models\Lote;
use App\Models\Forma;
use App\Models\LoteCamion;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class PaqueteController extends Controller
{
    private function validarDireccion($direccion)
    {
        $apiKey = '7a6TfdGhaJbpPMG2ehCfSExHYsnzdkIb5a0YlJzjU5U';
        $address = urlencode($direccion);
        $countryName = "Uruguay";
        $url = "https://geocode.search.hereapi.com/v1/geocode?q=$address&country=$countryName&apiKey=$apiKey";

        $response = @file_get_contents($url);
        $data = json_decode($response);

        if (empty($data->items || $data == null)) {
            /* return response()->json(['error' => 'Dirección inválida'], 400); */
            return 'Direccion invalida';
        }

        if ($data != null && !empty($data->items)) {
            if (count($data->items) > 1) {
                /* return response()->json(['error' => 'Múltiples direcciones', 'Direcciones' => $data], 400); */
                return 'Múltiples direcciones';
            }

            $addressDetails = $data->items[0]->address;

            if (
                isset($addressDetails->street) &&
                isset($addressDetails->houseNumber) &&
                isset($addressDetails->city)
            ) {
                return true;
            } else {
                return 'Direccion invalida - Faltan datos';
            }
        }
    }

    public function crearPaquete(Request $request)
    {
        $validator = $this->validarPaquete($request);

        if ($validator->fails()) {
            return redirect()->route('crearPaquete')->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $validatedData['Destino'] = $this->direccion($validatedData);

        if(!$validatedData['Destino']){
            return $validatedData['Destino'];
        }

        $validatedData['Codigo'] = $this->generarCodigo();

        $validatedData['ID_Estado'] = 1;

        Paquete::create($validatedData);

        session()->flash('mensaje', 'Paquete creado exitosamente, codigo: ' . $validatedData['Codigo']);
        return redirect()->route('crearPaquete');
    }    
    private function validarPaquete($request)
    {
        $validator = Validator::make($request->all(), [
            'Descripcion' => 'alpha|string',
            'Peso_Kg' => 'required|numeric|min:1',
            'ID_Cliente' => 'alpha_num|required|exists:cliente,ID',
            'Calle' => 'regex:/^[\pL\pN\s]+$/u|required|string',
            'Numero_Puerta' => 'required|string|alpha_num',
            'Ciudad' => 'alpha|required|string',
        ]);

        return $validator;
    }
    private function direccion($validatedData)
    {
        $direccion = $validatedData['Calle'] . ', ' . $validatedData['Numero_Puerta'] . ', ' . $validatedData['Ciudad'];

        $direccionValida = $this->validarDireccion($direccion);

        if ($direccionValida !== true) {
            return $direccionValida;
        }

        return $direccion;
    }
    private function generarCodigo()
    {
        $codigo = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
        return $codigo;
    }

    private function mostrarDatosPaquete($paquetes)
    {
        $forma = Forma::where('ID_Paquete', $paquetes->ID)->whereNull('deleted_at')->first();
        $lote = $forma ? $forma->ID_Lote : 'No tiene';
        
        $descripcion = $paquetes->Descripcion;
        return [
            'ID' => $paquetes->ID,
            'Descripcion' => $descripcion ? $descripcion : 'No Tiene',
            'Peso_Kg' => $paquetes->Peso_Kg,
            'ID_Cliente' => $paquetes->ID_Cliente,
            'ID_Estado' => $paquetes->ID_Estado,
            'Destino' => $paquetes->Destino,
            'Codigo'=> $paquetes->Codigo,
            'ID_Lote' => $lote,
        ];
    }
    public function mostrarPaquetes()
    {
        $paquete = Paquete::whereNull('deleted_at')->get();

        $datos = [];

        foreach($paquete as $paquetes){
            $datos[] = $this->mostrarDatosPaquete($paquetes);
        }

        return view('paquete.mostrarPaquetes', ['datos' => $datos]);
    }

    public function buscarPaquete(Request $request)
    {
        $ID = $request->input('id');
        $paquete = Paquete::find($ID);

        if (!$paquete) {
            return redirect()->route('vistaBuscarPaquete')->with('mensaje', 'Paquete no encontrado');
        }

        return view('paquete.buscarPaquete', ['paquete' => $paquete]);
    }

    public function editarPaquete($id)
    {
        $paquete = Paquete::find($id);
        
        if($paquete -> deleted_at != null){
            return redirect()->route('vistaBuscarPaquete')->with('mensaje', 'No se puede editar un paquete eliminado');
        }

        list($calle,$numero_puerta,$ciudad) = $this->variablesDireccion($paquete);

        $datos = $this->datosPaquete($paquete, $calle, $numero_puerta, $ciudad);

        return view('paquete.editarPaquete', ['datos' => $datos]);
    }

    private function variablesDireccion($paquete)
    {
        $direccion = explode(', ', $paquete->Destino);

        $calle = $paquete->Calle = $direccion[0];
        $numero_puerta = $paquete->Numero_Puerta = $direccion[1];
        $ciudad = $paquete->Ciudad = $direccion[2];

        return [
            $calle,
            $numero_puerta,
            $ciudad,
        ];
    }

    private function datosPaquete($paquete, $calle, $numero_puerta, $ciudad)
    {
        return [
            'ID' => $paquete->ID,
            'Descripcion' => $paquete->Descripcion,
            'Peso_Kg' => $paquete->Peso_Kg,
            'ID_Cliente' => $paquete->ID_Cliente,
            'ID_Estado' => $paquete->ID_Estado,
            'Calle' => $calle,
            'Numero_Puerta' => $numero_puerta,
            'Ciudad' => $ciudad,
        ];
    }

    
    public function actualizarPaquete(Request $request, $id)
    {
        $paquete = Paquete::find($id);

        $validator = $this->validatorActualizar($request);

        if ($validator->fails()) {
            return redirect()->route('editarPaquete', ['id' => $paquete->ID])->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $validatedData['Destino'] = $this->direccion($validatedData);

        if(!$validatedData['Destino']){
            return $validatedData['Destino'];
        }

        $paquete->update($validatedData);

        return redirect()->route('vistaBuscarPaquete', ['id' => $paquete->ID])
        ->with('mensaje', 'Paquete actualizado de forma exitosa');
    }
    private function validatorActualizar($request)
    {
        $validator = Validator::make($request->all(), [
            'Descripcion' => 'string',
            'Peso_Kg' => 'numeric',
            'ID_Cliente' => 'numeric',
            'ID_Estado' => 'in:1,2,3',
            'Calle' => 'string|regex:/^[\pL\pN\s]+$/u',
            'Numero_Puerta' => 'string|alpha_num',
            'Ciudad' => 'string|alpha',
        ]);

        return $validator;
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
        if($paqueteAsignado){
            return redirect()->route('vistaAsignarLote')->with('mensaje', 'Paquete ya asignado a un lote');
        }

        $forma = Forma::create([
            'ID_Lote' => $validatedData['ID_Lote'],
            'ID_Paquete' => $validatedData['ID_Paquete'],
            'ID_Estado' => 1,
        ]);

        $forma->save();

        $paquete->update([
            'ID_Estado' => 2,
        ]);

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

    public function paqueteEntregado(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ID_Paquete' => 'required|numeric',
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('vistaPaqueteEntregado')->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $paquete = Paquete::where('ID', $validatedData['ID_Paquete'])->first();
        if (!$paquete) {
            return redirect()->route('vistaPaqueteEntregado')->with('mensaje', 'Paquete no encontrado');
        }

        if($paquete->ID_Estado == 4){
            return redirect()->route('vistaPaqueteEntregado')->with('mensaje', 'Paquete ya entregado');
        }

        $paqueteLote = Forma::where('ID_Paquete', $validatedData['ID_Paquete'])->first();
        if (!$paqueteLote) {
            return redirect()->route('vistaPaqueteEntregado')->with('mensaje', 'Paquete no asignado a un lote');
        }

        $loteCamion = LoteCamion::where('ID_Lote', $paqueteLote->ID_Lote)->first();
        if (!$loteCamion) {
            return redirect()->route('vistaPaqueteEntregado')->with('mensaje', 'Lote no asignado a un camion');
        }

        $lote = Lote::where('ID', $loteCamion->ID_Lote)->first();

        $choferCamion = ChoferCamion::where('ID_Camion', $loteCamion->ID_Camion)->first();

        $paquete -> update([
            'ID_Estado' => 4,
        ]);

        $paqueteLote -> update([
            'ID_Estado' => 3,
        ]);

        $forma = Forma::where('ID_Lote', $lote->ID)->get();

        $paquetesEntregados = 1;
        foreach($forma as $formas){
            $paquetes = Paquete::where('ID', $formas->ID_Paquete)->first();
            if($paquetes && $paquetes->ID_Estado != 4){
                $paquetesEntregados = 0;
                break;
            }
        }

        if($paquetesEntregados == 1){
            Lote::where('ID', $lote->ID)
                ->update([
                    'ID_Estado' => 3,
                ]);

            LoteCamion::where('ID_Lote', $lote->ID)
                ->update([
                    'ID_Estado' => 3,
                ]);

            ChoferCamion::where('ID_Chofer', $choferCamion->ID_Chofer)
                ->where('ID_Camion', $choferCamion->ID_Camion)
                ->update([
                    'ID_Estado' => 5,
                ]);
        }

        return redirect()->route('vistaPaqueteEntregado')->with('mensaje', 'Paquete entregado con éxito');
    }
}
