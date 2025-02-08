<?php
function connectMariaDB()
{
  $host = 'localhost';
  $user = 'cv_user';
  $password = 'password';
  $dbname = 'cv_db';

  $mysqli = new mysqli($host, $user, $password, $dbname);
  // Comprobar conexión
  if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
  }
  return $mysqli;
}
// Función para obtener información del CV
function getCVInfoMariaDB($mysqli)
{
  $sql = "SELECT * FROM cv_info LIMIT 1";
  $result = $mysqli->query($sql);
  if ($result->num_rows > 0) {
    return $result->fetch_assoc();
  } else {
    return null;
  }
}

$mysqli = connectMariaDB();

// Obtener información del CV
$cv_info = getCVInfoMariaDB($mysqli);

// Cerrar conexión
$mysqli->close();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mini CV de Joan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <div class="card shadow-lg">
      <div class="card-header bg-primary text-white">
        <h3>Curriculum Vitae</h3>
      </div>
      <div class="card-body">
        <h4>Información Personal</h4>
        <p><strong>Nombre:</strong> <?php echo $cv_info['name']; ?></p>
        <p><strong>Profesión:</strong> <?php echo $cv_info['profession']; ?></p>
        <p><strong>Correo Electrónico:</strong> <?php echo $cv_info['email']; ?></p>
        <h4>Experiencia</h4>
        <p><?php echo $cv_info['experience']; ?></p>
      </div>
    </div>
  </div>
  <div style="width: 100%; display: flex; justify-content: center;">
    <button class="btn btn-secondary mt-3" onclick="showMoreInfo()">Ver más detalles</button>
  </div>
  <script>
    function showMoreInfo() {
      alert("Más información sobre el autor: <?php echo $cv_info['name'] ?> ha trabajado en proyectos de desarrollo web avanzados, especializándose en frontend y backend.");
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>