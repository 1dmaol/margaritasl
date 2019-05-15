<?php
if(isset($_POST['email'])){
require_once("conexion.php");
$sql = "SELECT * FROM usuarios WHERE email='" . $_POST['email'] . "'";

$select = mysqli_query($conexion, $sql);

if (mysqli_num_rows($select) > 0) {
    if($_POST['password'] != $_POST['cpassword']) {
        header("location:recuperarContr.php?msg=failedContr");
    } else {
        mysqli_query($conexion, "UPDATE `usuarios` SET `clave`= '" . $_POST['password'] ."' WHERE `email`= '".$_POST['email']."'") or die(mysql_error());
        header("location:recuperarContr.php?msg=confContr");
    };
/* header('Location: login.php');
exit(); */
    } else {
    header("location:recuperarContr.php?msg=failed");
    };
}
?>


