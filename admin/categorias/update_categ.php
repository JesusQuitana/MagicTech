<?php

use App\Categoria;

include '../../includes/app.php';
include AUTOLOAD;
verificarSesion();
template("header");

//###########VALIDAR QUE EL ID EXISTA######################
$id = filter_var($_GET["id"], FILTER_VALIDATE_INT);
if(!$id) {
    header("location: index.php");
}

//############CONSULTAR EL PRODUCTO A EDITAR################
$objetos = Categoria::select($id);
foreach($objetos as $objeto) {
    $categoria = $objeto;
}

//############CREAR EL PRODUCTO A EDITAR####################
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $datos = $_POST;
    $categoria = new Categoria($datos);
    $categoria->id = $id;
    $errores = $categoria->validar("update");
}

?>

<main class="contenedorSmall contacto">
    <h2>Crear Categoria</h2>

    <?php
//##############ITERAR SOBRE LA VALIDACION#############
        foreach($errores as $error) {
            echo "<p class='alerta roja'>".$error."</p>";
        }
    ?>
<!--################FORMULARIO#############################-->
    <form method="post" enctype="multipart/form-data">
        <fieldset class="contenedor_contacto">
            <legend>Informacion</legend>
            <label for="categoria">Nombre de la Categoria</label>
            <input type="text" id="categoria" name="categoria" class="inputs_contacto" value="<?php echo $categoria->categoria ?? ""; ?>">
        </fieldset>
        <input type="submit" class="btn verde btn_contacto" value="Enviar" style="margin-top: 20px; margin-right: 50px;">
        <a href="../categorias/" class="btn verde" style="margin-left: 50px;">Volver</a>
    </form>
</main>

<?php
template("footer");
?>