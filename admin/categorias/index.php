<?php
include '../../includes/app.php';
include AUTOLOAD;
use App\Categoria;
verificarSesion();
template("header");

//###############MOSTRAR ALERTA###################
$resultados = resultadoAdmin($_GET["resultado"]);

//###############OBTENER RESULTADOS###################
$categorias = Categoria::select();

//###############ELIMINAR CATEGORIA##################
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $id = intval($_POST["id"]);
    if(!filter_var($id, FILTER_VALIDATE_INT)) {
        header("location: " . __DIR__);
    }
    if(Categoria::delete($id)) {
        header("location: ../categorias/index.php?resultado=3");
    }
}
?>

<main class="contenedorSmall admin">  
    <h2>Categorias</h2>
    <a href="create_categ.php" class="btn verde" style="margin-right:50px;">Agregar Categoria</a>
    <a href="../" class="btn verde" style="margin-left:50px;">Volver</a>

    <?php
    //###############MOSTRAR ALERTA###################
        foreach($resultados as $resultado) {
            echo $resultado;
        }
    ?>

    <table class="contenedor articulos_admin">
        <thead>
            <td>ID</td>
            <td>Categoria</td>
            <td style="width: 50%;">Acción</td>
        </thead>
        <tbody>
             <?php
                foreach($categorias as $categoria) {
                    echo "<tr>";
                    echo "<td>".$categoria->id."</td>";
                    echo "<td>".$categoria->categoria."</td>";
                    echo "<td style='display:flex; justify-content: space-evenly; padding: 10px;'><a href='update_categ.php?id=".$categoria->id."' class='btn verde'>Editar</a>";
                    echo "<form method='post'><input type='hidden' name='id' value='".$categoria->id."'><input type='submit' class='btn rojo' value='Eliminar'></form></td>";
                    echo "</tr>";
                }
             ?>
        </tbody>
    </table>

</main>

<?php
template("footer");
?>