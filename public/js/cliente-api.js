/**
 * API Asincrónica para gestionar Clientes
 * Utiliza Fetch API para realizar operaciones CRUD
 */

class ClienteAPI {
  constructor() {
    this.baseUrl = '/clientes';
  }

  /**
   * Listar todos los clientes
   * @returns {Promise<Array>}
   */
  async listar() {
    try {
      const response = await fetch(`${this.baseUrl}/listar`, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json'
        }
      });
      const data = await response.json();
      return data.success ? data.data : [];
    } catch (error) {
      console.error('Error al listar clientes:', error);
      throw error;
    }
  }

  /**
   * Obtener un cliente específico
   * @param {number} id - ID del cliente
   * @returns {Promise<Object>}
   */
  async obtener(id) {
    try {
      const response = await fetch(`${this.baseUrl}/obtenerCliente/${id}`, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json'
        }
      });
      const data = await response.json();
      if (!data.success) throw new Error(data.message);
      return data.data;
    } catch (error) {
      console.error('Error al obtener cliente:', error);
      throw error;
    }
  }

  /**
   * Registrar un nuevo cliente
   * @param {Object} cliente - Objeto con datos del cliente
   * @returns {Promise<Object>}
   */
  async registrar(cliente) {
    try {
      const formData = new FormData();
      formData.append('apellidos', cliente.apellidos);
      formData.append('nombres', cliente.nombres);
      formData.append('dni', cliente.dni);
      formData.append('telefono', cliente.telefono);

      const response = await fetch(`${this.baseUrl}/registrarCliente`, {
        method: 'POST',
        body: formData
      });
      const data = await response.json();
      if (!data.success) throw new Error(data.message);
      return data;
    } catch (error) {
      console.error('Error al registrar cliente:', error);
      throw error;
    }
  }

  /**
   * Actualizar un cliente
   * @param {number} id - ID del cliente
   * @param {Object} cliente - Objeto con datos del cliente
   * @returns {Promise<Object>}
   */
  async actualizar(id, cliente) {
    try {
      const formData = new FormData();
      formData.append('id', id);
      formData.append('apellidos', cliente.apellidos);
      formData.append('nombres', cliente.nombres);
      formData.append('dni', cliente.dni);
      formData.append('telefono', cliente.telefono);

      const response = await fetch(`${this.baseUrl}/actualizar`, {
        method: 'POST',
        body: formData
      });
      const data = await response.json();
      if (!data.success) throw new Error(data.message);
      return data;
    } catch (error) {
      console.error('Error al actualizar cliente:', error);
      throw error;
    }
  }

  /**
   * Eliminar un cliente
   * @param {number} id - ID del cliente
   * @returns {Promise<Object>}
   */
  async eliminar(id) {
    try {
      const response = await fetch(`${this.baseUrl}/eliminar/${id}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        }
      });
      const data = await response.json();
      if (!data.success) throw new Error(data.message);
      return data;
    } catch (error) {
      console.error('Error al eliminar cliente:', error);
      throw error;
    }
  }
}

// Instancia global
const clienteAPI = new ClienteAPI();
