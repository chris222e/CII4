<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearTablaProveedores extends Migration
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
            "nombre" => [
                "type"          => "VARCHAR",
                "constraint"    => 100,
                "null"          => false
            ],
            "contacto" => [
                "type"          => "VARCHAR",
                "constraint"    => 60,
                "null"          => false
            ],
            "telefono" => [
                "type"          => "VARCHAR",
                "constraint"    => 15,
                "null"          => false
            ],
            "email" => [
                "type"          => "VARCHAR",
                "constraint"    => 100,
                "null"          => false
            ]
        ]);

        //Clave primaria
        $this->forge->addPrimaryKey("id");

        //Email debe ser único
        $this->forge->addUniqueKey("email");

        //Crear la tabla
        $this->forge->createTable("proveedores");
    }

    public function down()
    {
        $this->forge->dropTable("proveedores");
    }
}
