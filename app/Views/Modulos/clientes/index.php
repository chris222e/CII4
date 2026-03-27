<?= $header ?>
<div class="row">
  <div class="col-md-12">
    <h5>Lista de clientes</h5>
    <a href="<?= base_url('clientes/registrar') ?>" class="btn btn-sm btn-primary">Agregar</a>
    
    <table class="table mt-3">
      <thead>
        <tr>
          <th>#</th>
          <th>Apellidos</th>
          <th>Nombres</th>
          <th>DNI</th>
          <th>Teléfono</th>
          <th>Comandos</th>
        </tr>
      </thead>
      <tbody id="content-table">
      <?php foreach ($clientes as $cliente): ?>
        <tr>
          <td><?= $cliente['id'] ?></td>
          <td><?= $cliente['apellidos'] ?></td>
          <td><?= $cliente['nombres'] ?></td>
          <td><?= $cliente['dni'] ?></td>
          <td><?= $cliente['telefono'] ?></td>
          <td>

            <!-- Eliminación directa -->
            <a href="<?= base_url('clientes/eliminar/') ?><?= $cliente['id'] ?>" class="btn btn-sm btn-dark">Eliminar</a>

            <!-- Eliminación previa confirmación -->
            <a 
              href="#" 
              class="btn btn-sm btn-danger btn-eliminar" 
              data-idcliente="<?= $cliente['id'] ?>" 
              data-nombres="<?= $cliente['nombres'] ?>"
              >
              Eliminar
            </a>

            <a href="<?= base_url('clientes/buscar/') ?><?= $cliente['id'] ?>" class="btn btn-sm btn-info">Editar</a>

          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>

  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  //Referencia
  const dataTable = document.querySelector("#content-table")

  //Eventos (en todo el cuerpo de la tabla)
  dataTable.addEventListener("click", function(event) {
    
    //Detectar los botones Eliminación
    if (event.target.classList.contains('btn-eliminar')){
        const idcliente = event.target.getAttribute('data-idcliente')
        const nombres = event.target.getAttribute('data-nombres')

        if (!confirm("¿Desea eliminar el registro de " + nombres + "?")) return;

        //Procederé a eliminar...
        window.location.href = "<?= base_url('clientes/eliminar/') ?>" + idcliente
    }

  })

})
</script>

<?= $footer ?>