<?php

namespace App\Models;

use CodeIgniter\Model;

class ProveedorModel extends Model {

  protected $table = "proveedores";
  protected $primaryKey = "id";
  protected $returnType = "array";
  protected $allowedFields = ["nombre", "contacto", "telefono", "email"];
  protected $useTimestamps = false;

}
