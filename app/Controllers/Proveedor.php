<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ProveedorModel;

class Proveedor extends BaseController
{

  /**
   * Retorna la vista con los datos de proveedores
   * @return string
   */
  public function index(): string
  {
    $proveedor = new ProveedorModel();

    //$data es toda información que enviaremos a la vista
    $data = [
      'header'      => view('Partials/header'),
      'proveedores' => $proveedor->findAll(),
      'footer'      => view('Partials/footer'),
    ];

    return view("Modulos/proveedores/index", $data);
  }

  /**
   * Retorna la vista para el registro de proveedores
   * @return string
   */
  public function create(): string{
    $data = [
      'header'    => view('Partials/header'),
      'footer'    => view('Partials/footer')
    ];

    return view('Modulos/proveedores/registrar', $data);
  }

  /**
   * Almacena los datos en la tabla Proveedores de forma asincrónica
   * Retorna respuesta JSON
   * @return \CodeIgniter\HTTP\ResponseInterface
   */
  public function registrarProveedor(){
    $proveedor = new ProveedorModel();

    //Validar los datos del formulario
    if (!$this->validate([
      'nombre'   => 'required|string|max_length[100]',
      'contacto' => 'required|string|max_length[60]',
      'telefono' => 'required|string|max_length[15]',
      'email'    => 'required|valid_email|max_length[100]|is_unique[proveedores.email]'
    ])) {
      return $this->response->setJSON([
        'success' => false,
        'message' => 'Error de validación',
        'errors'  => $this->validator->getErrors()
      ])->setStatusCode(400);
    }

    //Se obtienen los datos del formulario
    $nombre   = $this->request->getPost('nombre');
    $contacto = $this->request->getPost('contacto');
    $telefono = $this->request->getPost('telefono');
    $email    = $this->request->getPost('email');

    //Insertar el nuevo proveedor
    $proveedor->insert([
      'nombre'   => $nombre,
      'contacto' => $contacto,
      'telefono' => $telefono,
      'email'    => $email
    ]);

    return $this->response->setJSON([
      'success' => true,
      'message' => 'Proveedor registrado correctamente',
      'id'      => $proveedor->getInsertID()
    ])->setStatusCode(201);
  }

  /**
   * Obtiene los datos de un proveedor específico (asincrónico)
   * @param int $id
   * @return \CodeIgniter\HTTP\ResponseInterface
   */
  public function obtenerProveedor(int $id = null){
    $proveedor = new ProveedorModel();
    
    if ($id === null) {
      return $this->response->setJSON([
        'success' => false,
        'message' => 'ID requerido'
      ])->setStatusCode(400);
    }

    $registro = $proveedor->find($id);

    if (!$registro) {
      return $this->response->setJSON([
        'success' => false,
        'message' => 'Proveedor no encontrado'
      ])->setStatusCode(404);
    }

    return $this->response->setJSON([
      'success' => true,
      'data'    => $registro
    ])->setStatusCode(200);
  }

  /**
   * Actualiza un proveedor de forma asincrónica
   * @return \CodeIgniter\HTTP\ResponseInterface
   */
  public function actualizar(){
    $proveedor = new ProveedorModel();

    //Validar los datos
    if (!$this->validate([
      'id'       => 'required|integer|is_not_empty',
      'nombre'   => 'required|string|max_length[100]',
      'contacto' => 'required|string|max_length[60]',
      'telefono' => 'required|string|max_length[15]',
      'email'    => 'required|valid_email|max_length[100]'
    ])) {
      return $this->response->setJSON([
        'success' => false,
        'message' => 'Error de validación',
        'errors'  => $this->validator->getErrors()
      ])->setStatusCode(400);
    }

    $id       = $this->request->getPost('id');
    $nombre   = $this->request->getPost('nombre');
    $contacto = $this->request->getPost('contacto');
    $telefono = $this->request->getPost('telefono');
    $email    = $this->request->getPost('email');

    $proveedor->update($id, [
      'nombre'   => $nombre,
      'contacto' => $contacto,
      'telefono' => $telefono,
      'email'    => $email
    ]);

    return $this->response->setJSON([
      'success' => true,
      'message' => 'Proveedor actualizado correctamente'
    ])->setStatusCode(200);
  }

  /**
   * Elimina un proveedor de forma asincrónica
   * @param int $id
   * @return \CodeIgniter\HTTP\ResponseInterface
   */
  public function eliminar(int $id = null){
    $proveedor = new ProveedorModel();

    if ($id === null) {
      return $this->response->setJSON([
        'success' => false,
        'message' => 'ID requerido'
      ])->setStatusCode(400);
    }

    if (!$proveedor->find($id)) {
      return $this->response->setJSON([
        'success' => false,
        'message' => 'Proveedor no encontrado'
      ])->setStatusCode(404);
    }

    $proveedor->delete($id);

    return $this->response->setJSON([
      'success' => true,
      'message' => 'Proveedor eliminado correctamente'
    ])->setStatusCode(200);
  }

  /**
   * Obtiene todos los proveedores en formato JSON (asincrónico)
   * @return \CodeIgniter\HTTP\ResponseInterface
   */
  public function listar(){
    $proveedor = new ProveedorModel();
    $proveedores = $proveedor->findAll();

    return $this->response->setJSON([
      'success' => true,
      'data'    => $proveedores,
      'total'   => count($proveedores)
    ])->setStatusCode(200);
  }

}
