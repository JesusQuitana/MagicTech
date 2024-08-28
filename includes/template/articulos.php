<?php
include '../app.php';
include 'vendor/autoload.php';
use App\Productos;

//###############OBTENER LOS PRODUCTOS DE LA BASE DE DATOS#############################
$productos = Productos::select("", "LIMIT 5");
?>

<section class="main-2">
    <div class="contenedorSmall">
        <h2>Productos</h2>

        <?php
        foreach($productos as $producto) : ?>
            <article class="articulo">
                <picture>
                    <img loading="lazy" src="../../build/img/imagenes/<?php echo $producto->imagen; ?>" alt="producto1">
                </picture>
                <div>
                    <h3><?php echo $producto->nombre; ?></h3>
                    <p><?php echo $producto->descripcion; ?></p>
                </div>
            </article>
        <?php endforeach ?>

        <a href="inventario.php" class="btn verde">Ver Todos</a>
    </div>
</section>