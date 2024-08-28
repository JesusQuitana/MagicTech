<?php
    include 'includes/template/header.php';
?>

<main class="contenedorSmall contacto">
    <h2>Contacto<a href="login.php">.</a></h2>
    <picture>
        <source srcset="build/img/contacto.avif" type="image/avif">
        <source srcset="build/img/contacto.webp" type="image/webp">
        <img loading="lazy" src="build/img/contacto.jpg" alt="contacto">
    </picture>

    <form>
        <fieldset class="contenedor_contacto">
            <legend>Informacion de Contacto</legend>
            <label for="nombre">Tu Nombre Completo</label>
            <input type="text" id="nombre" name="nombre" class="inputs_contacto">
            <label for="correo">Tu Correo</label>
            <input type="email" id="correo" name="correo" class="inputs_contacto">
            <label for="telf">Tu Telefono</label>
            <div class="telefono">
                <select id="telf">
                    <option selected disabled>-Seleccione-</option>
                    <option>0414</option>
                </select>
                <input type="number" id="telf" name="telf" class="inputs_contacto" min="1" max="9" maxlength="7">
            </div>
            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" class="inputs_contacto"></textarea>
        </fieldset>
        <input type="submit" class="btn verde btn_contacto" value="Enviar">
    </form>
</main>

<?php
    include 'includes/template/footer.php';
?>