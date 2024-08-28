<?php

use App\Categoria;

include '../../includes/app.php';
include AUTOLOAD;
verificarSesion();
template("header");

if($_SERVER["REQUEST_METHOD"]=="POST") {
//############ATRIBUTOS DEL PRODUCTO###########################
    $datos = $_POST;
//############Creacion del Obejto###########################
    $categoria = new Categoria($datos);
//############Validacion del Objeto###########################
    $errores = $categoria->validar("create");
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