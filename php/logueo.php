<?php
if (!empty($_POST['correo']) && !empty($_POST['pass'])) {
    $correoIngresado = $_POST['correo'];
    $contraseñaIngresada = sha1($_POST['pass']);
    include 'conexion.php';

    $conexion = conectar();

    if ($conexion) {
        $consulta ='SELECT usuario, pass 
                    FROM usuario 
                    WHERE usuario = ? AND pass = ?'; //consulta

        $sentencia = mysqli_prepare($conexion, $consulta);  //preparo la consulta

        mysqli_stmt_bind_param($sentencia, 'ss' , $correoIngresado, $contraseñaIngresada);

        $q = mysqli_stmt_execute($sentencia); //ejecuto la consulta

        mysqli_stmt_bind_result($sentencia, $usuarioDB, $contraseñaDB);
        if ($q) {
            mysqli_stmt_fetch($sentencia);
            if ($usuarioDB == $correoIngresado && $contraseñaDB == $contraseñaIngresada) {
                header("refresh:0;url=usuario_listado.php");
            }else{
                echo '<h1>Usuario o contraseña incorrecta</h1>';
                header("refresh:2;url=../index.php");
            }
        }else{
            echo '<h1>error de ejecucion de consulta sql</h1>';
        }
        desconectar($conexion);
    }else{
        echo '<p>Debe Ingresar datos en el formulario</p>';
        header('refresh:3;url=../index.php');
    }

}

?>