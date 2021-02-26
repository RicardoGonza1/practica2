<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /proyecto php');
  }
  require 'database.php';


  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /proyecto php");
    } else {
      $message = 'No sea sapo';
    }
  }

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
  <link rel="shortcut icon" type="image/jpeg" href="logo.jpeg">
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,300&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
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

	<h1>Iniciar sesion</h1>
	<span>or  <a href="Signup.php">Registrarse</a></span>
<?php if (!empty($message)) : ?>
<p><?= $message ?></p>

<?php endif; ?>
	<form action="login.php" method="post">
		<input type="text" name="email" placeholder="Ingrese su email">
		<input type="password" name="password" placeholder="Ingrese su contraseña">
		<input type="submit" value="Enviar">
	</form>

</body>
</html>
