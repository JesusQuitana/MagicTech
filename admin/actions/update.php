<?php
include '../../includes/app.php';
include AUTOLOAD;
verificarSesion();
use App\Categoria;
use App\Productos;
template("header");

//###########CONSULTAR LAS CATEGORIAS######################
$categorias = Categoria::select();

//###########VALIDAR QUE EL ID EXISTA######################
    $id = filter_var($_GET["id"], FILTER_VALIDATE_INT);
    if(!$id) {
        header("location: ../");
    }

//############CONSULTAR EL PRODUCTO A EDITAR################
    $objetos = Productos::select($id);
    foreach($objetos as $objeto) {
        $producto = $objeto;
    }
    $imagenAnterior = $producto->imagen;

//############CREAR EL PRODUCTO A EDITAR####################
    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $datos = $_POST;
        $imagen = $_FILES["imagen"];
        $producto = new Productos($datos, $imagen);
        $producto->id = $id;
        $producto->imagen["name"] = $imagenAnterior;
        $errores = $producto->validar("update");
    }


//############ACTUALIZAR EL PRODUCTO A EDITAR####################

?>

<main class="contenedorSmall contacto">
    <h2>Crear Propiedad</h2>

    <?php
//##############ITERAR SOBRE LA VALIDACION#############
        foreach($errores as $error) {
            echo "<p class='alerta roja'>".$error."</p>";
        }
    ?>
<!--################FORMULARIO#############################-->
    <form method="post" enctype="multipart/form-data">
        <fieldset class="contenedor_contacto">
            <legend>Informacion del Producto</legend>
            <label for="nombre">Nombre del Producto</label>
            <input type="text" id="nombre" name="nombre" class="inputs_contacto" maxlength="20" value="<?php echo $producto->nombre ?? ""; ?>">
            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" class="inputs_contacto" min="0" value="<?php echo $producto->precio ?? ""; ?>">
            <label for="descripcion">Descripcion</label>
            <textarea id="descricpcion" name="descripcion" class="inputs_contacto"><?php echo $producto->descripcion ?? ""; ?></textarea>
        </fieldset>
        <fieldset class="contenedor_contacto">
            <legend>Detalles del Producto</legend>
            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" name="imagen" class="inputs_contacto">
            <label for="disponible">Disponibilidad</label>
            <select id="disponible" name="disponible" class="inputs_contacto">
            <?php
                if($producto->disponible=="si") {
                    echo "<option value=''>-- Seleccione --</option>";
                    echo "<option value='si' selected>Si</option>";
                    echo "<option value='no'>No</option>";
                }
                else if($producto->disponible=="no") {
                    echo "<option value=''>-- Seleccione --</option>";
                    echo "<option value='si'>Si</option>";
                    echo "<option value='no' selected>No</option>";
                }
                else {
                    echo "<option value=''>-- Seleccione --</option>";
                    echo "<option value='si'>Si</option>";
                    echo "<option value='no'>No</option>";
                }
                ?>
            </select>
            <label for="cantidad">Cantidad de Producto</label>
            <input type="number" id="cantidad" name="cantidad" class="inputs_contacto" min="0" value="<?php echo $producto->cantidad ?? ""; ?>">
            <label for="categoria_id">Categoria</label>
            <select id="categoria_id" name="categoria_id" class="inputs_contacto">
                <option selected>-- Seleccione --</option>
                <?php
                foreach($categorias as $categoria) {
                    if($producto->categoria_id==$categoria->id) {
                        echo "<option value='".$categoria->id."' selected>".$categoria->categoria."</option>";
                    }
                    else {
                        echo "<option value='".$categoria->id."'>".$categoria->categoria."</option>";
                    }
                }
                ?>
            </select>
        </fieldset>
        <input type="submit" class="btn verde btn_contacto" value="Enviar" style="margin-top: 20px; margin-right: 50px;">
        <a href="../../admin/" class="btn verde" style="margin-left: 50px;">Volver</a>
    </form>
</main>

<?php
template("footer");
?>