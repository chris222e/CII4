<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SENATI</title>
</head>
<body>
  <h1>Estas en Ingeniería de Software</h1>
  <h2>Programador: <?= $desarrollador ?> </h2>
  <hr>

  <ul>
    <?php foreach($lenguajes as $lp):  ?>
    <li><?= $lp ?></li>
    <?php endforeach; ?>
  </ul>

</body>
</html>