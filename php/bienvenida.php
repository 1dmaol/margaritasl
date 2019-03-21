<?
if(isset($_GET['salir'])){
        unset($_SESSION['id']);
        unset($_SESSION['nombre']);
        unset($_SESSION['email']);
        header('Location: index.php');
    }
$sql = "SELECT * FROM usuarios WHERE id=" . $_SESSION['id'];
        $result = mysqli_query($conexion,$sql);
        if ( mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);
		$nombre = $row['nombre'];
		$rol = $row['rol'];
        }
?>
