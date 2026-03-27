<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ClienteModel;

class Cliente extends BaseController
{

  /**
   * Retorna la vista con los datos de clientes
   * @return string
   */
  public function index(): string
  {
    $cliente = new ClienteModel();

    //$data es toda información que enviaremos a la vista
    $data = [
      'header'    => view('Partials/header'),
      'clientes'  => $cliente->findAll(),
      'footer'    => view('Partials/footer'),
    ];

    return view("Modulos/clientes/index", $data);
  }

  /**
   * Retorna la vista para el registro de clientes
   * @return string
   */
  public function create(): string{
    $data = [
      'header'    => view('Partials/header'),
      'footer'    => view('Partials/footer')
    ];

    return view('Modulos/clientes/registrar', $data);
  }


  
  public function buscar(int $id = null){

    $cliente = new ClienteModel();
    $registro = $cliente->find($id); //[id, apellidos, nombres, dni, telefono]

    $data = [
      'header'    => view('Partials/header'),
      'footer'    => view('Partials/footer'),
      'registro'  => $registro
    ];

    return view('Modulos/clientes/actualizar', $data);
  }

  /**
   * Almacena los datos en la tabla Clientes
   * @return \CodeIgniter\HTTP\RedirectResponse
   */
  public function registrarCliente(){
    $cliente = new ClienteModel();

    //Se debe validar antes de insertar los datos
    $apellidos = $this->request->getPost('apellidos');
    $nombres = $this->request->getPost('nombres');
    $dni = $this->request->getPost('dni');
    $telefono = $this->request->getPost('telefono');

    $cliente->insert([
      'apellidos' => $apellidos,
      'nombres'   => $nombres,
      'dni'       => $dni,
      'telefono'  => $telefono
    ]);

    return redirect()->to('/clientes');
  }

  /**
   * Elimina el registro de manera física de la tabla
   * @param int $id
   * @return \CodeIgniter\HTTP\RedirectResponse
   */
  public function eliminar(int $id = null){
    $cliente = new ClienteModel();
    $cliente->delete($id);
    return redirect()->to('/clientes');
  }

  public function actualizar(){
    $cliente = new ClienteModel();

    $idcliente = $this->request->getPost('idcliente');
    $apellidos = $this->request->getPost('apellidos');
    $nombres = $this->request->getPost('nombres');
    $dni = $this->request->getPost('dni');
    $telefono = $this->request->getPost('telefono');

    $cliente->update($idcliente, [
      'apellidos' => $apellidos,
      'nombres'   => $nombres,
      'dni'       => $dni,
      'telefono'  => $telefono
    ]);

    return redirect()->to('/clientes');
  }

}