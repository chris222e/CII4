<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class Producto extends BaseController
{

  public function index(): string
  {
    $data = [
      'header' => view('Partials/header'),
      'footer' => view('Partials/footer'),
    ];
    return view("Modulos/productos/index", $data);
  }

}