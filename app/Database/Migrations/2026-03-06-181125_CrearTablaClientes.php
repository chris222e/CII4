<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearTablaClientes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                "type"          => "INT",
                "constraint"    => 11,
                "unsigned"      => true,
                "auto_increment"=> true
            ],
            "apellidos" => [
                "type"          => "VARCHAR",
                "constraint"    => 40,
                "null"          => false
            ],
            "nombres" => [
                "type"          => "VARCHAR",
                "constraint"    => 40,
                "null"          => false
            ],
            "dni" => [
                "type"          => "CHAR",
                "constraint"    => 8,
                "null"          => false
            ],
            "telefono" => [
                "type"          => "CHAR",
                "constraint"    => 9,
                "null"          => false
            ]
        ]);

        //Clave primaria
        $this->forge->addPrimaryKey("id");

        //DNI debe ser único
        $this->forge->addUniqueKey("dni");

        //Crear la tabla
        $this->forge->createTable("clientes");
    }

    public function down()
    {
        $this->forge->dropTable("clientes");
    }
}
