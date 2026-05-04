/**
 * API Helper para operaciones asincrónicas con Clientes
 * Maneja todas las llamadas AJAX al servidor
 */

class ClienteAPI {
  
  constructor(baseUrl = '/clientes') {
    this.baseUrl = baseUrl;
  }

  /**
   * Registra un nuevo cliente de forma asincrónica
   * @param {Object} datos - Datos del cliente {apellidos, nombres, dni, telefono}
   * @returns {Promise}
   */
  async registrar(datos) {
    try {
      const response = await fetch(`${this.baseUrl}/registarCliente`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(datos)
      });

      return await response.json();
    } catch (error) {
      console.error('Error al registrar cliente:', error);
      return { success: false, message: 'Error en la conexión' };
    }
  }

  /**
   * Obtiene todos los clientes en formato JSON
   * @returns {Promise}
   */
  async listar() {
    try {
      const response = await fetch(`${this.baseUrl}/listar`);
      return await response.json();
    } catch (error) {
      console.error('Error al listar clientes:', error);
      return { success: false, message: 'Error en la conexión' };
    }
  }

  /**
   * Obtiene un cliente específico por ID
   * @param {number} id - ID del cliente
   * @returns {Promise}
   */
  async obtener(id) {
    try {
      const response = await fetch(`${this.baseUrl}/obtenerCliente/${id}`);
      return await response.json();
    } catch (error) {
      console.error('Error al obtener cliente:', error);
      return { success: false, message: 'Error en la conexión' };
    }
  }

  /**
   * Actualiza un cliente de forma asincrónica
   * @param {Object} datos - Datos del cliente {id, apellidos, nombres, dni, telefono}
   * @returns {Promise}
   */
  async actualizar(datos) {
    try {
      const response = await fetch(`${this.baseUrl}/actualizar`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(datos)
      });

      return await response.json();
    } catch (error) {
      console.error('Error al actualizar cliente:', error);
      return { success: false, message: 'Error en la conexión' };
    }
  }

  /**
   * Elimina un cliente de forma asincrónica
   * @param {number} id - ID del cliente
   * @returns {Promise}
   */
  async eliminar(id) {
    try {
      const response = await fetch(`${this.baseUrl}/eliminar/${id}`, {
        method: 'DELETE'
      });

      return await response.json();
    } catch (error) {
      console.error('Error al eliminar cliente:', error);
      return { success: false, message: 'Error en la conexión' };
    }
  }
}

// Instancia global para usar en las vistas
const clienteAPI = new ClienteAPI();
