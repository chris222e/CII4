/**
 * API Helper para operaciones asincrónicas con Proveedores
 * Maneja todas las llamadas AJAX al servidor
 */

class ProveedorAPI {
  
  constructor(baseUrl = '/proveedor') {
    this.baseUrl = baseUrl;
  }

  /**
   * Registra un nuevo proveedor de forma asincrónica
   * @param {Object} datos - Datos del proveedor {nombre, contacto, telefono, email}
   * @returns {Promise}
   */
  async registrar(datos) {
    try {
      const response = await fetch(`${this.baseUrl}/registarProveedor`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(datos)
      });

      return await response.json();
    } catch (error) {
      console.error('Error al registrar proveedor:', error);
      return { success: false, message: 'Error en la conexión' };
    }
  }

  /**
   * Obtiene todos los proveedores en formato JSON
   * @returns {Promise}
   */
  async listar() {
    try {
      const response = await fetch(`${this.baseUrl}/listar`);
      return await response.json();
    } catch (error) {
      console.error('Error al listar proveedores:', error);
      return { success: false, message: 'Error en la conexión' };
    }
  }

  /**
   * Obtiene un proveedor específico por ID
   * @param {number} id - ID del proveedor
   * @returns {Promise}
   */
  async obtener(id) {
    try {
      const response = await fetch(`${this.baseUrl}/obtenerProveedor/${id}`);
      return await response.json();
    } catch (error) {
      console.error('Error al obtener proveedor:', error);
      return { success: false, message: 'Error en la conexión' };
    }
  }

  /**
   * Actualiza un proveedor de forma asincrónica
   * @param {Object} datos - Datos del proveedor {id, nombre, contacto, telefono, email}
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
      console.error('Error al actualizar proveedor:', error);
      return { success: false, message: 'Error en la conexión' };
    }
  }

  /**
   * Elimina un proveedor de forma asincrónica
   * @param {number} id - ID del proveedor
   * @returns {Promise}
   */
  async eliminar(id) {
    try {
      const response = await fetch(`${this.baseUrl}/eliminar/${id}`, {
        method: 'DELETE'
      });

      return await response.json();
    } catch (error) {
      console.error('Error al eliminar proveedor:', error);
      return { success: false, message: 'Error en la conexión' };
    }
  }
}

// Instancia global para usar en las vistas
const proveedorAPI = new ProveedorAPI();
