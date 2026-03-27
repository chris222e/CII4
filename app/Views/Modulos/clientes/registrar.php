<?= $header ?>
<div class="row">
  <div class="col-md-12">
    <h5>Registro de nuevos clientes</h5>

    <form action="<?= base_url('/clientes/guardar') ?>" method="post" id="form-clientes" autocomplete="off">
      <div class="form-group">
        <label for="apellidos">Apellidos</label>
        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
      </div>

      <div class="form-group">
        <label for="nombres">Nombres</label>
        <input type="text" class="form-control" id="nombres" name="nombres" required>
      </div>

      <div class="form-group">
        <label for="dni">DNI</label>
        <input type="text" class="form-control" id="dni" name="dni" minlength="8" maxlength="8" required>
      </div>

      <div class="form-group">
        <label for="telefono">Teléfono</label>
        <input type="text" class="form-control" id="telefono" name="telefono" minlength="9" maxlength="9" required>
      </div>

      <button type="submit" class="btn btn-primary">Registrar</button>
      <button type="reset" class="btn btn-outline-secondary">Cancelar</button>
    </form>

  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {

    const formulario = document.querySelector("#form-clientes")

    formulario.addEventListener("submit", function (event){
      event.preventDefault() //STOP

      if (!confirm("¿Está seguro de registrar?")) { return; }
      formulario.submit()

    })

  })
</script>

<?= $footer ?>