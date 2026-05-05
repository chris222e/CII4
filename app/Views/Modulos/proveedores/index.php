<?= $header ?>
<div class="row">
  <div class="col-md-12">
    <h5>Lista de proveedores</h5>
    <a href="<?= base_url('proveedores/registrar') ?>" class="btn btn-sm btn-primary">Agregar</a>
    
    <table class="table mt-3">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Contacto</th>
          <th>Teléfono</th>
          <th>Comandos</th>
        </tr>
      </thead>
      <tbody id="content-table">
      <?php foreach ($proveedores as $proveedor): ?>
        <tr>
          <td><?= $proveedor['id'] ?></td>
          <td><?= $proveedor['nombre'] ?></td>
          <td><?= $proveedor['contacto'] ?></td>
          <td><?= $proveedor['telefono'] ?></td>
          <td>

            <!-- Eliminación directa -->
            <a href="<?= base_url('proveedores/eliminar/') ?><?= $proveedor['id'] ?>" class="btn btn-sm btn-dark">Eliminar</a>

            <!-- Eliminación con confirmación -->
            <a 
              href="#" 
              class="btn btn-sm btn-danger btn-eliminar" 
              data-idproveedor="<?= $proveedor['id'] ?>" 
              data-nombre="<?= $proveedor['nombre'] ?>"
              >
              Eliminar
            </a>

            <a href="<?= base_url('proveedores/buscar/') ?><?= $proveedor['id'] ?>" class="btn btn-sm btn-info">Editar</a>

          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>

  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const dataTable = document.querySelector("#content-table")

  dataTable.addEventListener("click", function(event) {
    
    if (event.target.classList.contains('btn-eliminar')){
        const idproveedor = event.target.getAttribute('data-idproveedor')
        const nombre = event.target.getAttribute('data-nombre')

        if (!confirm("¿Desea eliminar el registro de " + nombre + "?")) return;

        window.location.href = "<?= base_url('proveedores/eliminar/') ?>" + idproveedor
    }

  })

})
</script>

<?= $footer ?>