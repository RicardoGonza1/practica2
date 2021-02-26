<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Nuevo usuario creado satisfactoriamente';
    } else {
      $message = 'Lo sentimos hubo un problema al crear su cuenta';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <header>
      <a href="index.html">Ir a Jardineria Alvarado</a>
    </header>

    <header>
      <a href="index.php">Inicio</a>
    </header>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Registarse </h1>
    <span>or <a href="login.php">Iniciar sesion</a></span>

    <form action="signup.php" method="POST">
      <input name="email" type="text" placeholder="Ingrese su email">
      <input name="password" type="password" placeholder="Ingrese su contraseña">
      <input name="confirm_password" type="password" placeholder="Confirme su cotraseña">
      <input type="submit" value="Enviar">
    </form>

  </body>
</html>
