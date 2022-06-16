<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function datos(Request $request){
        
        $tipoDoc = $request->json('tipoDoc');
        $valorDoc = $request->json('valorDoc');
        switch ($valorDoc) {
            case '20467534026':
               $obj = new \stdClass;
               $obj->error = false;
               $obj->razon = "América Móvil Perú SAC";
               $obj->direccion = "Av. Nicolás Arriola 480 – La Victoria, Lima.";
               $obj->distrito = "La Victoria";
                break;
            case '20543254798':
               $obj = new \stdClass;
               $obj->error = false;
               $obj->razon = "VIETTEL PERU S.A.C.";
               $obj->direccion = "Cal. 21 Nro. 878 – San Isidro, Lima.";
               $obj->distrito = "San Isidro";
                break;
            case '20106897914':
               $obj = new \stdClass;
               $obj->error = false;
               $obj->razon = "Entel Perú S.A.";
               $obj->direccion = "República de Colombia 791 – piso 14, San Isidro, Lima – Perú.";
               $obj->distrito = "San Isidro";
                break;
            case '20507646728':
               $obj = new \stdClass;
               $obj->error = false;
               $obj->razon = "HUAWEI DEL PERU SAC";
               $obj->direccion = "Cal. las Begonias Nro. 415 Int. 2301,  San Isidro, Lima – Perú.";
               $obj->distrito = "San Isidro";
                break;
            case '20337771085':
               $obj = new \stdClass;
               $obj->error = false;
               $obj->razon = "CINEMARK DEL PERU S.R.L";
               $obj->direccion = "Av. Javier Prado Este Nro. 4200, Santiago de Surco, Lima – Perú.";
               $obj->distrito = "San Isidro";
                break;
            default:
                $obj = new \stdClass;
               $obj->error = true;
                break;
        }
        return $obj;
    }
}
