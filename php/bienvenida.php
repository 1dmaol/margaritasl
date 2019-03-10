<?
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
