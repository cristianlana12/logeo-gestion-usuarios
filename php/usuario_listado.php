<?php
    $ruta = '../';
    require("encabezado.php");
?>

<main class="container">
    <section>
        <article class="row">
            <section class="menu_tmp">
                <a class="btn btn-dark" href="usuario_alta.php">+ Alta usuario</a>
            </section>
            <table class="table table-bordered table-hover table-striped w-auto">
                <caption class="caption-top text-center bg-dark">Listado de usuarios</caption>
                <tr>
                    <th class="bg-secondary text-white">Foto</th>
                    <th class="bg-secondary text-white">Usuario</th>
                    <th class="bg-secondary text-white">Tipo</th>
                    <th class="bg-secondary text-white">Modificar</th>
                    <th class="bg-secondary text-white">Eliminar</th>
                    <th class="bg-secondary text-white">Desactivar</th>
                </tr>

                <?php
                    include 'conexion.php';
                    $conexion = conectar();

                    $consulta = 'SELECT id_usuario, usuario, tipo, foto 
                                FROM usuario';

                    $sentencia = mysqli_prepare($conexion, $consulta);

                    $q = mysqli_stmt_execute($sentencia);

                    mysqli_stmt_bind_result($sentencia,$id ,$usuario, $tipo, $foto);

                    if ($q) {
                        while (mysqli_stmt_fetch($sentencia)) {
                            echo '<tr>';
                            if ($foto != null) {
                                echo '<td><img src = "../img/usuarios/'. $foto .'"></td>';
                            }else{
                                echo '<td><img src = "../img/usuarios/usuario_default.png"></td>';

                            }
                            echo '<td>'. $usuario .'</td>';
                            echo '<td>'. $tipo .'</td>';
                            echo '<td><a href="modificar.php?id='. $id .'"><img src="../img/modificar.png"></a></td>';
                            echo '<td><a href="eliminar.php?id='. $id .'"><img src="../img/eliminar.png"></a></td>';
                            echo '<td><a href="desactivar.php?id='. $id .'"><img src="../img/desactivar.png"></a></td>';
                            echo '</tr>';
                        }

                    desconectar($conexion);
                    }else{
                        echo '<p>No hubo resultados</p>';
                    }
                ?>
            </table>
        </article>
    </section>
    <img src="" alt="">
</main>

<?php
    require("pie.php");
?>