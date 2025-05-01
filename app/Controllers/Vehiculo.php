<?php

namespace App\Controllers;
use App\Models\VehiculoModel;

class Vehiculo extends BaseController
{
    protected $vehiculoModel;

    public function __construct()
    {
        $this->vehiculoModel = new \App\Models\VehiculoModel();
    }

    public function index(): string
    {
        $datos['marcas'] = $this->vehiculoModel->getMarcas();
        return view('vehiculos', $datos);
    }
    public function listado(): \CodeIgniter\HTTP\Response
    {
        $vehiculos = $this->vehiculoModel->getVehiculos();
        return $this->response->setJSON(['data' => $vehiculos]);
    }

    public function saveVehiculo()
    {
        $datosContacto = [
            'nombres' => $this->request->getPost('nombres'),
            'apellidos' => $this->request->getPost('apellidos'),
            'nroDoc' => $this->request->getPost('nrodoc'),
            'correo' => $this->request->getPost('correo'),
            'telefono' => $this->request->getPost('telefono'),
        ];

        $codContacto = $this->vehiculoModel->saveContacto($datosContacto);

        $datosVehiculo = [
            'placa' => $this->request->getPost('placa'),
            'codMarca' => $this->request->getPost('marca'),
            'modelo' => $this->request->getPost('modelo'),
            'anioFabricacion' => $this->request->getPost('anioFab'),
            'codCliente' => $codContacto,
        ];

        $newVehiculo = $this->vehiculoModel->saveVehiculo($datosVehiculo, $datosContacto);

        if($newVehiculo){
            return $this->response->setJSON([
                'status' => 'ok'
            ]);
        }else{
            return $this->response->setJSON([
                'status' => 'error'
            ]);
        }
    }
    public function getVehiculoById()
    {
        $codvehiculo = $this->request->getPost('codvehiculo');
        $vehiculo = $this->vehiculoModel->getVehiculoById($codvehiculo);

        return $this->response->setJSON($vehiculo);
    }

    public function updateVehiculo()
    {
        $codvehiculo = $this->request->getPost('codvehiculo');
        $isDelete = $this->request->getPost('isDelete');

        if($isDelete == 1){
            //DELETE
            $datosVehiculo = [
                'habilitado' => 0,
            ];
        }else{
            //UPDATE
            $datosContacto = [
                'nombres' => $this->request->getPost('nombres'),
                'apellidos' => $this->request->getPost('apellidos'),
                'nroDoc' => $this->request->getPost('nrodoc'),
                'correo' => $this->request->getPost('correo'),
                'telefono' => $this->request->getPost('telefono'),
            ];
    
            $codContacto = $this->vehiculoModel->updateOrsaveContacto($datosContacto);

            $datosVehiculo = [
                'placa' => $this->request->getPost('placa'),
                'codMarca' => $this->request->getPost('marca'),
                'modelo' => $this->request->getPost('modelo'),
                'anioFabricacion' => $this->request->getPost('anioFab'),
                'codCliente' => $codContacto,
            ];
        }

        $vehiculo = $this->vehiculoModel->updateVehiculo($codvehiculo, $datosVehiculo);

        if($vehiculo){
            return $this->response->setJSON([
                'status' => 'ok'
            ]);
        }else{
            return $this->response->setJSON([
                'status' => 'error'
            ]);
        }
        
    }

    public function getContacto($codCliente)
    {
        $contacto = $this->vehiculoModel->getContactoById($codCliente);
        if($contacto){
            return $this->response->setJSON([
                'status' => 'ok',
                'data' => $contacto,
            ]);
        }else{
            return $this->response->setJSON([
                'status' => 'error'
            ]);
        }
    }
}
