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
   * Almacena los datos en la tabla Clientes de forma asincrónica
   * Retorna respuesta JSON
   * @return \CodeIgniter\HTTP\ResponseInterface
   */
  public function registrarCliente(){
    $cliente = new ClienteModel();

    //Validar los datos del formulario
    if (!$this->validate([
      'apellidos' => 'required|string|max_length[40]',
      'nombres'   => 'required|string|max_length[40]',
      'dni'       => 'required|string|exact_length[8]|numeric|is_unique[clientes.dni]',
      'telefono'  => 'required|string|exact_length[9]|numeric'
    ])) {
      return $this->response->setJSON([
        'success' => false,
        'message' => 'Error de validación',
        'errors'  => $this->validator->getErrors()
      ])->setStatusCode(400);
    }

    //Se deben validar antes de insertar los datos
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

    return $this->response->setJSON([
      'success' => true,
      'message' => 'Cliente registrado correctamente',
      'id'      => $cliente->getInsertID()
    ])->setStatusCode(201);
  }

  /**
   * Obtiene los datos de un cliente específico (asincrónico)
   * @param int $id
   * @return \CodeIgniter\HTTP\ResponseInterface
   */
  public function obtenerCliente(int $id = null){
    $cliente = new ClienteModel();
    
    if ($id === null) {
      return $this->response->setJSON([
        'success' => false,
        'message' => 'ID requerido'
      ])->setStatusCode(400);
    }

    $registro = $cliente->find($id);

    if (!$registro) {
      return $this->response->setJSON([
        'success' => false,
        'message' => 'Cliente no encontrado'
      ])->setStatusCode(404);
    }

    return $this->response->setJSON([
      'success' => true,
      'data'    => $registro
    ])->setStatusCode(200);
  }

  /**
   * Elimina el registro de manera física de la tabla
   * @param int $id
   * @return \CodeIgniter\HTTP\ResponseInterface
   */
  public function eliminar(int $id = null){
    $cliente = new ClienteModel();
    
    if ($id === null) {
      return $this->response->setJSON([
        'success' => false,
        'message' => 'ID requerido'
      ])->setStatusCode(400);
    }

    if (!$cliente->find($id)) {
      return $this->response->setJSON([
        'success' => false,
        'message' => 'Cliente no encontrado'
      ])->setStatusCode(404);
    }

    $cliente->delete($id);
    
    return $this->response->setJSON([
      'success' => true,
      'message' => 'Cliente eliminado correctamente'
    ])->setStatusCode(200);
  }

  /**
   * Actualiza un cliente de forma asincrónica
   * @return \CodeIgniter\HTTP\ResponseInterface
   */
  public function actualizar(){
    $cliente = new ClienteModel();

    //Validar los datos
    if (!$this->validate([
      'id'        => 'required|integer|is_not_empty',
      'apellidos' => 'required|string|max_length[40]',
      'nombres'   => 'required|string|max_length[40]',
      'dni'       => 'required|string|exact_length[8]|numeric',
      'telefono'  => 'required|string|exact_length[9]|numeric'
    ])) {
      return $this->response->setJSON([
        'success' => false,
        'message' => 'Error de validación',
        'errors'  => $this->validator->getErrors()
      ])->setStatusCode(400);
    }

    $idcliente = $this->request->getPost('id');
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

    return $this->response->setJSON([
      'success' => true,
      'message' => 'Cliente actualizado correctamente'
    ])->setStatusCode(200);
  }

  /**
   * Obtiene todos los clientes en formato JSON (asincrónico)
   * @return \CodeIgniter\HTTP\ResponseInterface
   */
  public function listar(){
    $cliente = new ClienteModel();
    $clientes = $cliente->findAll();

    return $this->response->setJSON([
      'success' => true,
      'data'    => $clientes,
      'total'   => count($clientes)
    ])->setStatusCode(200);
  }

}
