<?php
    $ruta='../';
    require("encabezado.php");
?>

<?php
    include 'conexion.php';

    $conexion = conectar();

    if ($conexion && !empty($_GET['id'])) {
        $id = $_GET['id'];

        $consulta = 'DELETE FROM usuario
                    WHERE id_usuario = ?';
        
        $sentencia = mysqli_prepare($conexion,$consulta);

        mysqli_stmt_bind_param($sentencia, 'i', $id);

        $resultado = mysqli_stmt_execute($sentencia);

        if ($resultado) {
            echo '<p>Elimido exitosamente</p>';
            header("refresh:1;url=usuario_listado.php");
        }else{
            echo '<p>no se pudo eliminar</p>';
        }
    }else{
        echo '<p>no se realizo la eliminacion</p>';
    }
?>