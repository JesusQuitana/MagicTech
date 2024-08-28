<?php
include '../includes/app.php';
include '../vendor/autoload.php';
verificarSesion();
use App\Productos;
template("header");

//###############MOSTRAR ALERTA###################
$resultados = resultadoAdmin($_GET["resultado"]);

//###############OBTENER RESULTADOS###################
$productos = Productos::select();

//###############ELIMINAR UN PRODUCTO DEL STOCK#######
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $id = intval($_POST["id"]);
    if(!filter_var($id, FILTER_VALIDATE_INT)) {
        header("location: " . __DIR__);
    }
    if(Productos::delete($id)) {
        header("location: ../admin/index.php?resultado=3");
    }
}

?>

<main class="contenedor admin">
    <h2>Panel de Administracion</h2>
    <a href="../admin/actions/create.php" class="btn verde" style="margin-right: 50px;">Agregar Articulo</a>
    <a href="../admin/categorias/" class="btn verde" style="margin-left:50px;">Categorias</a>

    <?php
    //###############MOSTRAR ALERTA###################
        foreach($resultados as $resultado) {
            echo $resultado;
        }
    ?>

    <table class="articulos_admin contenedor">
        <thead>
            <td>Nombre</td>
            <td>Precio</td>
            <td>Descripcion</td>
            <td>Imagen</td>
            <td>Acciones</td>
        </thead>
        <tbody>
            <?php
            foreach($productos as $producto) {
                echo "<tr>";
                echo "<td>".$producto->nombre."</td>";
                echo "<td>$".$producto->precio."</td>";
                echo "<td>".$producto->descripcion."</td>";
                echo "<td class='articulo_img'><img width='300' loading='lazy' src='../build/img/imagenes/".$producto->imagen."' alt='producto'></td>";
                echo "<td><div class='articulo_accion'><a href='actions/update.php?id=".$producto->id."' class='btn verde'>Actualizar</a><form method='post'><input type='hidden' name='id' value='".$producto->id."'><input type=submit value='Eliminar' class='btn rojo'></form></div></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</main>

<?php
template("footer");
?>