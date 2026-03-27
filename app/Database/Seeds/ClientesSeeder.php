<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClientesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                "apellidos" => "Contreras Pachas",
                "nombres"   => "Carolina",
                "dni"       => "44556677",
                "telefono"  => "956111222"
            ],
            [
                "apellidos" => "Peñaloza Mejía",
                "nombres"   => "Gabriela",
                "dni"       => "77441100",
                "telefono"  => "956000111"
            ],
            [
                "apellidos" => "Salvatierra Mendoza",
                "nombres"   => "Esther",
                "dni"       => "74748585",
                "telefono"  => "956777111"
            ]
        ]; //fin $data

        $this->db->table("clientes")->insertBatch($data);
    }
}
