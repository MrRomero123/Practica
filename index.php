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


$id_persona = 6;


$consulta = "SELECT 
    p.nombre,
    p.edad,
    p.correo,
    p.fecha_nacimiento,
    p.anio_nacimiento,
    o.descripcion AS origen,
    p.telefonos
  FROM Persona p
  JOIN Origen o ON p.id_origen = o.id_origen
  WHERE p.id_persona = $id_persona";

$resultado = mysqli_query($conexion, $consulta);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Datos de Persona</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
    crossorigin="anonymous">
</head>
<body>
  <div class="container mt-5">
    <div class="jumbotron">
      <h1 class="display-4">Datos de Persona</h1>
      <p class="lead">by Romero</p>
      <hr class="my-4">
    </div>

    <?php
    if ($resultado && mysqli_num_rows($resultado) > 0) {
      $fila = mysqli_fetch_assoc($resultado);
      echo "
      <h3 class='mt-5'>Datos personales de {$fila['nombre']}</h3>
      <table class='table table-bordered table-striped'>
        <thead class='thead-light'>
          <tr>
            <th>Edad</th>
            <th>Correo</th>
            <th>Fecha de Nacimiento</th>
            <th>Año de Nacimiento</th>
            <th>Origen</th>
            <th>Teléfonos</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{$fila['edad']}</td>
            <td>{$fila['correo']}</td>
            <td>{$fila['fecha_nacimiento']}</td>
            <td>{$fila['anio_nacimiento']}</td>
            <td>{$fila['origen']}</td>
            <td>{$fila['telefonos']}</td>
          </tr>
        </tbody>
      </table>";
    } else {
      echo "<p>No se encontró la persona con ID $id_persona.</p>";
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
