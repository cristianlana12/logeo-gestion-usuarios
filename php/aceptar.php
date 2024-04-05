<?php
    $ruta = '../';
    require('encabezado.php');
?>

<?php
    include 'conexion.php';
    $conexion = conectar();

    if ($conexion && isset($_POST['id'])) {
        $usu = $_POST['usuario'];
        $tipo = $_POST['tipo'];
        $id = $_POST['id'];

        $consulta = 'UPDATE usuario
                    SET usuario = ?, tipo = ?
                    WHERE id_usuario = ?';
        $sentencia = mysqli_prepare($conexion,$consulta);
        mysqli_stmt_bind_param($sentencia, 'ssi', $usu, $tipo, $id);
        $estado = mysqli_execute($sentencia);

        if ($estado) {
            echo '<p>Datos Actualizados</p>';
            header("refresh:1;url=usuario_listado.php");
        }else{
            echo '<p>Error en el Actualizado</p>';
        }
    }
?>