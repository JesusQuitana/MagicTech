<?php
include 'includes/app.php';
include 'vendor/autoload.php';
use App\Productos;
template("header");

//#############CONSULTAR PRODUCTOS################
$productos = Productos::select();

?>

<main class="contenedor inventario">
    <h2>Productos Disponibles</h2>

    <?php
    foreach($productos as $producto) : ?>
        
        <article>
            <h3><?php echo $producto->nombre; ?></h3>
            <img loading="lazy" src="build/img/imagenes/<?php echo $producto->imagen; ?>">
            <p><span>$</span><?php echo $producto->precio; ?></p>
            <p><?php echo $producto->descripcion; ?></p>
        </article>
    
    <?php endforeach ?>
</main>

<?php
template("footer");
?>