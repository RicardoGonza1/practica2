<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Bienvenido a la Jardineria Alvarado</title>
  <link rel="shortcut icon" type="image/jpeg" href="logo.jpeg">
 	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,300&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
 </head>
 <body>
   <header>
  		<a href="index.html">Ir a Jardineria Alvarado</a>
  	</header>
<?php if (!empty($user)): ?>

  <br>Bienvenido <?= $user['email'] ?>
  <a href="index.html">Inicio</a>

<?php else: ?>

 <h1>Por favor ingrese o registrese</h1>

 <a href="login.php">Ingresar</a> o
 <a href="signup.php">Registrar</a>
<?php endif; ?>
 </body>
 </html>
