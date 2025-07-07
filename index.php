<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$conexion = mysqli_connect(getenv('MYSQL_HOST'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'), "examen");

// Verificar conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$consulta = "SELECT 
    p.id_persona,
    p.nombre,
    p.edad,
    p.correo,
    p.fecha_nacimiento,
    o.descripcion AS origen,
    p.anio_nacimiento,
    p.telefonos
FROM Persona p
JOIN Origen o ON p.id_origen = o.id_origen";

$resultado = mysqli_query($conexion, $consulta);
?>

<html>
<head>
  <meta charset="utf-8">
  <title>Catálogo de Personas</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <div class="jumbotron mt-4">
    <h1 class="display-4">Catálogo de Personas</h1>
    <p class="lead">Ejemplo simple de PHP + MySQL para listar personas</p>
    <hr class="my-4">
  </div>

  <table class="table table-striped table-bordered">
    <thead class="thead-dark">
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Edad</th>
        <th>Correo</th>
        <th>Fecha Nacimiento</th>
        <th>Año Nacimiento</th>
        <th>Origen</th>
        <th>Teléfonos</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($resultado && mysqli_num_rows($resultado) > 0) {
          while ($fila = mysqli_fetch_assoc($resultado)) {
              echo "<tr>
                      <td>{$fila['id_persona']}</td>
                      <td>{$fila['nombre']}</td>
                      <td>{$fila['edad']}</td>
                      <td>{$fila['correo']}</td>
                      <td>{$fila['fecha_nacimiento']}</td>
                      <td>{$fila['anio_nacimiento']}</td>
                      <td>{$fila['origen']}</td>
                      <td>{$fila['telefonos']}</td>
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='8'>No se encontraron resultados.</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>
