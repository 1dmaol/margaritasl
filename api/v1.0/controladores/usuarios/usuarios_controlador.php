<?php

require('modelos/usuarios/usuarios_modelo_'.$metodo.'.php');

if (isset($_SESSION['id'])){    
    header("Location: ../../app/parcelas.php");
} else {
    header("Location: ../../app/login.php?failed");
}

