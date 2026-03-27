<?= $header ?>
<div class="row">
  <div class="col-md-12">
    <h5>Actualizando datos de clientes</h5>

    <form action="<?= base_url('/clientes/actualizar') ?>" method="post" id="form-clientes" autocomplete="off">

      <input type="hidden" id="idcliente" name="idcliente" value="<?= $registro['id'] ?>">

      <div class="form-group">
        <label for="apellidos">Apellidos</label>
        <input type="text" value="<?= $registro['apellidos'] ?>" class="form-control" id="apellidos" name="apellidos" required>
      </div>

      <div class="form-group">
        <label for="nombres">Nombres</label>
        <input type="text" value="<?= $registro['nombres'] ?>" class="form-control" id="nombres" name="nombres" required>
      </div>

      <div class="form-group">
        <label for="dni">DNI</label>
        <input type="text" value="<?= $registro['dni'] ?>" class="form-control" id="dni" name="dni" minlength="8" maxlength="8" required>
      </div>

      <div class="form-group">
        <label for="telefono">Teléfono</label>
        <input type="text" value="<?= $registro['telefono'] ?>" class="form-control" id="telefono" name="telefono" minlength="9" maxlength="9" required>
      </div>

      <button type="submit" class="btn btn-primary">Actualizar</button>
      <a href="<?= base_url('/clientes') ?>" class="btn btn-outline-secondary">Cancelar</a> 
    </form>

  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function(){
    const form = document.getElementById('form-clientes');
    form.addEventListener('submit', function(event){
      event.preventDefault();
      if(!confirm('¿Estás seguro de actualizar este cliente?')){ return; }
      form.submit();
    });
  });
</script>

<?= $footer ?>