<?= $header ?>

<div class="row">
  <div class="col-md-6">
    <h5>Registro de nuevos proveedores</h5>

    <form id="form-proveedor">

      <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control">
        <small class="text-danger error-nombre"></small>
      </div>

      <div class="mb-3">
        <label>Contacto</label>
        <input type="text" name="contacto" class="form-control">
        <small class="text-danger error-contacto"></small>
      </div>

      <div class="mb-3">
        <label>Teléfono</label>
        <input type="text" name="telefono" class="form-control">
        <small class="text-danger error-telefono"></small>
      </div>

      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
        <small class="text-danger error-email"></small>
      </div>

      <button class="btn btn-primary">Guardar</button>

    </form>
  </div>
</div>

<script>
const form = document.getElementById("form-proveedor");

form.addEventListener("submit", function(e){
    e.preventDefault();

    // limpiar errores
    document.querySelectorAll("small").forEach(el => el.textContent = "");

    const formData = new FormData(this);

    fetch("<?= base_url('proveedores/guardar') ?>", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {

        if(data.success){
            Swal.fire({
              icon: 'success',
              title: 'Guardado',
              text: data.message,
              timer: 1500,
              showConfirmButton: false
            });

            setTimeout(() => {
              window.location.href = "<?= base_url('proveedores') ?>";
            }, 1500);

        }else{

            // mostrar errores debajo
            if(data.errors){
              for (let campo in data.errors) {
                document.querySelector(".error-" + campo).textContent = data.errors[campo];
              }
            }

        }
    });
});
</script>

<!-- SWEETALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $footer ?>