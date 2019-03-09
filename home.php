<?php
    include_once("conexion.php");
    session_start();    

if(isset($_GET['salir'])){
        unset($_SESSION['id']);
        header('Location: index.html');
    }
$sql = "SELECT * FROM usuarios WHERE id=" . $_SESSION['id'];
        $result = mysqli_query($conexion,$sql);
        if ( mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);
		$nombre = $row['nombre'];
		$rol = $row['rol'];
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:300,400,700"rel="stylesheet'>
</head>

<body style="min-height:300px">
 <h1><?php echo "Hola " . $nombre . ", eres un " . $rol; ?></h1>

    <a href="./home.php?salir">Salir</a>
</body>

</html>
