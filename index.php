<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "34.71.26.50"; 
$user = "root"; 
$password = "123456"; 
$database = "examen";

$conexion = mysqli_connect($host, $user, $password, $database);

if (!$conexion) {
  die("Error de conexión: " . mysqli_connect_error());
}

$consulta = "SELECT 
    p.nombre,
    p.edad,
    p.correo,
    p.fecha_nacimiento,
    p.anio_nacimiento,
    o.descripcion AS origen,
    p.telefonos
  FROM Persona p
  JOIN Origen o ON p.id_origen = o.id_origen";

$resultado = mysqli_query($conexion, $consulta);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>DATOS PERSONALES DE LUIS ROMERO PEREZ</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
    crossorigin="anonymous">
</head>
<body>
  <div class="container mt-5">
    <h1 class="display-4 text-center">DATOS PERSONALES LUIS EDUARDO ROMERO PEREZ</h1>
    <hr>

    <?php
    if ($resultado && mysqli_num_rows($resultado) > 0) {
      echo "
      <table class='table table-bordered table-striped mt-4'>
        <thead class='thead-dark'>
          <tr>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Correo</th>
            <th>Fecha de Nacimiento</th>
            <th>Año de Nacimiento</th>
            <th>Origen</th>
          </tr>
        </thead>
        <tbody>";

      while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "
          <tr>
            <td>{$fila['nombre']}</td>
            <td>{$fila['edad']}</td>
            <td>{$fila['correo']}</td>
            <td>{$fila['fecha_nacimiento']}</td>
            <td>{$fila['anio_nacimiento']}</td>
            <td>{$fila['origen']}</td>
          </tr>";
      }

      echo "</tbody></table>";
    } else {
      echo "<p class='text-danger text-center'>No se encontraron registros de personas.</p>";
    }
    ?>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
    crossorigin="anonymous"></script>
</body>
</html>
