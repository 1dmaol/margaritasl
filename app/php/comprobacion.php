<?php

    if(isset($_POST['usuario'])){

        $sql = "SELECT * FROM usuarios WHERE nombre='" . $_POST['usuario'] . "' AND clave='". $_POST['clave'] ."' LIMIT 1";
        $result = mysqli_query($conexion,$sql);
        if ( mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
		$_SESSION['id'] = $row['id'];
		$_SESSION['nombre'] = $row['nombre'];
		$_SESSION['email'] = $row['email'];
            header('Location: parcelas.php');
            exit();
        } else {
		header("location:login.php?msg=failed");
        }
    }
?>
