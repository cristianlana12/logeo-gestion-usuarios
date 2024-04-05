<?php
$ruta = '../';
require ("encabezado.php");
?>
<main>


    <?php
    include 'conexion.php';
    $conexion = conectar();

    if ($conexion && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $consulta = 'SELECT usuario, tipo
                    FROM usuario WHERE id_usuario = ?';
        $sentencia = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($sentencia, 'i', $id);
        mysqli_stmt_execute($sentencia);
        mysqli_stmt_bind_result($sentencia, $us, $tip);
        mysqli_stmt_store_result($sentencia);
        $cantFilas = mysqli_stmt_num_rows($sentencia);
        if ($cantFilas > 0) {
            echo '<h2>Esta por eliminar a: </h2>';
            echo '<table><tr><th>Usuario</th><th>Tipo</th></tr>';
            while (mysqli_stmt_fetch($sentencia)) {
                echo '<tr><td>' . $us . '</td><td> ' . $tip . ' </td></tr>';
                echo '</table>';
                echo '<a href="borrar.php?id=' . $id . '">Aceptar</a>';
                echo '<hr>';
                echo '<a href="usuario_listado.php">Cancelar</a>';
            }

        }

    }
    ?>
</main>