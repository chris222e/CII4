<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SENATI</title>

  <!-- Carpeta PUBLIC -->
  <link rel="stylesheet" href="css/estilos.css">

</head>
<body>
  <h1>Bienvenido a SENATI</h1>
  <!-- ¿Cómo funciona la carpeta PUBLIC? -->
  <!-- Esta carpeta sirve cualquier archivo estático de forma DIRECTA -->
  <img src="images/senati.jpg" alt="Logotipo de SENATI">
  <hr>
  <!-- URL ABSOLUTAS -->
  <a href="<?= base_url('programador') ?>">Ingeniería de Software</a> | 
  <a href="<?= base_url('marketing') ?>">Diseño Gráfico Digital</a>
</body>
</html>