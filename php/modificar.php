<?php
$ruta = '../';
require ("encabezado.php");
?>

<main>

    <h1 class="h1-modphp">Administracion de Usuarios</h1>

    <?php
    include ('conexion.php');
    $conexion = conectar();

    if ($conexion && isset($_GET['id'])) {
        $id = $_GET['id'];

        $consulta = 'SELECT usuario, tipo, foto
                    FROM usuario
                    WHERE id_usuario = ?';

        $sentencia = mysqli_prepare($conexion, $consulta);

        mysqli_stmt_bind_param($sentencia, 'i', $id);

        $q = mysqli_stmt_execute($sentencia);

        mysqli_stmt_bind_result($sentencia, $usuario, $tipo, $foto);

        mysqli_stmt_store_result($sentencia);

        $cantFilas = mysqli_stmt_num_rows($sentencia);

        if ($cantFilas > 0) {
            mysqli_stmt_fetch($sentencia);
        }
    }
    ?>


    <section>
        <a href="usuario_listado.php">Mostrar</a>
    </section>

    <h2>Modificar:</h2>

    <section>
        <a href="../index.php">Cancelar</a>
    </section>

    <form style="border:1px solid #000;" action="aceptar.php" method="post">
        <fieldset style ="border:1px solid #000;">
            <legend style="color:#000">Datos de Usuario</legend>
            <section class="body-form-mod">
                <label for="usu">Usuario: </label>
                <input value="<?php echo $usuario ?>" style ="border:1px solid #000;" type="text" name="usuario" id="usu">
            </section>

            <section class="body-form-mod">
                <label for="tipy">Tipo: </label>
                <select style ="border:1px solid #000;" name="tipo" id="type">
                    <option value="administrador">administrador</option>
                    <option value="comun">comun</option>
                </select>
            </section>
            <input type="hidden" value="<?php echo $id ?>" name="id">
            <section>
                <input type="submit" value="actualizar">
            </section>

        </fieldset>


    </form>

</main>

<?php
require ("pie.php");
?>