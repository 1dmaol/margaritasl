<?php
    if(isset($_SESSION['id'])){
        header('Location: home.php');
    }

    if(isset($_POST['usuario'])){

        $sql = "SELECT * FROM usuarios WHERE nombre='" . $_POST['usuario'] . "' AND clave='". $_POST['clave'] ."' LIMIT 1";
        $result = mysqli_query($conexion,$sql);
        if ( mysqli_num_rows($result) > 0) {
		$_SESSION['id'] = mysqli_fetch_assoc($result)['id'];
            header('Location: home.php');
            exit();
        } else {
		header("location:login.php?msg=failed");
        }
    }
?>
