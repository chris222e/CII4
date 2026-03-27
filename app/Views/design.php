<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SENATI</title>
</head>
<body>
  <h1>Estas en Diseño Gráfico Digital</h1>
  <hr>
  <ul>
    <?php foreach($aplicaciones as $app): ?>
    <li><?= $app ?></li>
    <?php endforeach; ?>
  </ul>
</body>
</html>