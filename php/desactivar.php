<?php
    $ruta = '../';
    require("encabezado.php");
?>

<?php
    include 'conexion.php';

    $conexion = conectar();

    if ($conexion && isset($_GET['id'])) {
        $id = $_GET['id'];
        $estado = 'N';

        $consulta = 'UPDATE usuario
                    SET activado = ?
                    WHERE id_usuario = ?';
        
        $sentencia = mysqli_prepare($conexion,$consulta);

        mysqli_stmt_bind_param($sentencia, 'si', $estado,$id);

        $q =mysqli_execute($sentencia);

        if ($q) {
            echo "<p>El Estado fue desactivado</p>";
            header("refresh:1;url=usuario_listado.php");
        }else{
            echo "<p>Error al desactivar el estado</p>";

        }
    }
?>