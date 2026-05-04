# Guía de Implementación - Operaciones Asincrónicas

## Resumen de cambios realizados

Se han añadido operaciones asincrónicas completas para los módulos de **Clientes** y **Proveedores** en la rama `Tarea_Seminario_03`.

## Cambios realizados

### 1. **Tabla Proveedores** (Migración)
- Archivo: `app/Database/Migrations/2026-05-04-120000_CrearTablaProveedores.php`
- Campos: `id`, `nombre`, `contacto`, `telefono`, `email` (máximo 5 campos)
- Restricciones: Email único, id primaria

### 2. **ProveedorModel** 
- Archivo: `app/Models/ProveedorModel.php`
- Tabla: `proveedores`
- Campos permitidos: `nombre`, `contacto`, `telefono`, `email`

### 3. **Proveedor Controller (Actualizado)**
- Archivo: `app/Controllers/Proveedor.php`
- Métodos asincrónico que retornan JSON:
  - `index()` - Vista principal con listado
  - `create()` - Formulario para nuevo proveedor
  - `registrarProveedor()` - Inserta proveedor (JSON)
  - `obtenerProveedor($id)` - Obtiene un proveedor (JSON)
  - `actualizar()` - Actualiza proveedor (JSON)
  - `eliminar($id)` - Elimina proveedor (JSON)
  - `listar()` - Lista todos los proveedores (JSON)

### 4. **Cliente Controller (Actualizado)**
- Archivo: `app/Controllers/Cliente.php`
- Métodos ahora retornan JSON en lugar de redirects:
  - `registrarCliente()` - Inserta cliente (JSON)
  - `obtenerCliente($id)` - Obtiene un cliente (JSON)
  - `actualizar()` - Actualiza cliente (JSON)
  - `eliminar($id)` - Elimina cliente (JSON)
  - `listar()` - Lista todos los clientes (JSON)
- Validación completa con mensajes de error

### 5. **Archivos JavaScript para API Asincrónica**

#### Cliente API (`public/js/cliente-api.js`)
```javascript
// Ejemplos de uso:

// Registrar cliente
await clienteAPI.registrar({
  apellidos: 'Pérez',
  nombres: 'Juan',
  dni: '12345678',
  telefono: '987654321'
});

// Listar clientes
const respuesta = await clienteAPI.listar();
console.log(respuesta.data); // Array de clientes

// Obtener cliente por ID
const cliente = await clienteAPI.obtener(1);

// Actualizar cliente
await clienteAPI.actualizar({
  id: 1,
  apellidos: 'García',
  nombres: 'Carlos',
  dni: '87654321',
  telefono: '912345678'
});

// Eliminar cliente
await clienteAPI.eliminar(1);
```

#### Proveedor API (`public/js/proveedor-api.js`)
```javascript
// Ejemplos de uso:

// Registrar proveedor
await proveedorAPI.registrar({
  nombre: 'Distribuidora ABC',
  contacto: 'Juan Pérez',
  telefono: '987654321',
  email: 'info@distribuida.com'
});

// Listar proveedores
const respuesta = await proveedorAPI.listar();
console.log(respuesta.data); // Array de proveedores

// Obtener proveedor por ID
const proveedor = await proveedorAPI.obtener(1);

// Actualizar proveedor
await proveedorAPI.actualizar({
  id: 1,
  nombre: 'Distribuidora XYZ',
  contacto: 'Carlos García',
  telefono: '912345678',
  email: 'contacto@distribuida.com'
});

// Eliminar proveedor
await proveedorAPI.eliminar(1);
```

## Cómo usar en las vistas

### En HTML (registrar cliente)
```html
<script src="/js/cliente-api.js"></script>

<form id="formCliente">
  <input type="text" name="apellidos" placeholder="Apellidos" required>
  <input type="text" name="nombres" placeholder="Nombres" required>
  <input type="text" name="dni" placeholder="DNI" maxlength="8" required>
  <input type="text" name="telefono" placeholder="Teléfono" maxlength="9" required>
  <button type="submit">Registrar</button>
</form>

<script>
  const form = document.getElementById('formCliente');
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(form);
    const datos = Object.fromEntries(formData);
    
    const respuesta = await clienteAPI.registrar(datos);
    
    if (respuesta.success) {
      alert('Cliente registrado: ' + respuesta.message);
      form.reset();
      // Recargar lista de clientes
      await cargarClientes();
    } else {
      alert('Error: ' + respuesta.message);
      console.error(respuesta.errors);
    }
  });

  async function cargarClientes() {
    const respuesta = await clienteAPI.listar();
    if (respuesta.success) {
      console.log(respuesta.data);
      // Actualizar tabla o lista en el DOM
    }
  }
</script>
```

## Respuestas JSON esperadas

### Respuesta exitosa (201/200)
```json
{
  "success": true,
  "message": "Cliente registrado correctamente",
  "id": 5
}
```

### Respuesta con error (400)
```json
{
  "success": false,
  "message": "Error de validación",
  "errors": {
    "dni": "Tha dni field must contain numbers only.",
    "email": "The email field must contain a valid email address."
  }
}
```

### Respuesta al listar (200)
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "apellidos": "Pérez",
      "nombres": "Juan",
      "dni": "12345678",
      "telefono": "987654321"
    },
    {
      "id": 2,
      "apellidos": "García",
      "nombres": "María",
      "dni": "87654321",
      "telefono": "912345678"
    }
  ],
  "total": 2
}
```

## Requisitos cumplidos

✅ **Proveedores sean asincronos** - Todos los métodos del controlador retornan JSON y pueden usarse con async/await

✅ **Tablas con máximo 5 campos** - Tabla Clientes: 5 campos, Tabla Proveedores: 5 campos

✅ **Listar e Insertar** - Ambas funcionalidades están implementadas en ambos módulos

## Cómo ejecutar migraciones

```bash
# En la raíz del proyecto
php spark migrate
```

## Rutas disponibles

### Clientes
- `GET /clientes` - Vista con listado
- `GET /clientes/create` - Formulario para crear
- `POST /clientes/registarCliente` - Registra cliente (JSON)
- `GET /clientes/listar` - Obtiene JSON de todos los clientes
- `GET /clientes/obtenerCliente/{id}` - Obtiene cliente por ID (JSON)
- `POST /clientes/actualizar` - Actualiza cliente (JSON)
- `DELETE /clientes/eliminar/{id}` - Elimina cliente (JSON)

### Proveedores
- `GET /proveedor` - Vista con listado
- `GET /proveedor/create` - Formulario para crear
- `POST /proveedor/registarProveedor` - Registra proveedor (JSON)
- `GET /proveedor/listar` - Obtiene JSON de todos los proveedores
- `GET /proveedor/obtenerProveedor/{id}` - Obtiene proveedor por ID (JSON)
- `POST /proveedor/actualizar` - Actualiza proveedor (JSON)
- `DELETE /proveedor/eliminar/{id}` - Elimina proveedor (JSON)
