<?php

namespace App\Models;

use CodeIgniter\Model;

class VehiculoModel extends Model
{
    protected $table      = 'vehiculos';
    protected $primaryKey = 'codigo';

    protected $allowedFields = ['placa', 'codMarca', 'modelo', 'anioFabricacion','codCliente', 'habilitado'];

    public function __construct() {
        parent::__construct();
    }

    function getMarcas()
    {
        $query = $this->db->query("call get_marcas();");
		return $query->getResult();
    }

    function getVehiculos()
    {
        $query = $this->db->query("call get_vehiculos();");
		return $query->getResult();
    }

    function saveContacto($datosContacto)
    {
        $db = \Config\Database::connect();
        $db->table('clientes')->insert($datosContacto);
        return $db->insertID();
    }

    function updateOrsaveContacto($datosContacto)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('clientes');

        $nrodoc = $datosContacto['nroDoc'];
        $contacto = $builder->where('nroDoc', $nrodoc)->get()->getRowArray();

        if ($contacto) {
            // Si existe, actualizar y devolver el código
            $builder->where('codigo', $contacto['codigo'])->update($datosContacto);
            return $contacto['codigo'];
        } else {
            // Si no existe, crearlo y devolver el código
            $builder->insert($datosContacto);
            return $db->insertID();
        }

    }

    function saveVehiculo($datosVehiculo)
    {
        return $this->insert($datosVehiculo);
    }

    function getVehiculoById($codVehiculo)
    {
        $query = $this->db->query("call get_vehiculo_x_codigo(".$codVehiculo.");");
		return $query->getResult();
    }

    function updateVehiculo($codVehiculo, $datosVehiculo)
    {
        return $this->update($codVehiculo, $datosVehiculo);
    }

    function getContactoById($codCliente)
    {
        $query = $this->db->query("call get_cliente_x_codigo(".$codCliente.");");
		return $query->getResult();
    }
}