<?php
include 'includes/app.php';
template("header");
?>

<main>
    <section class="contenedorSmall main-1">
        <picture>
            <source srcset="build/img/blog1.avif" type="image/avif">
            <source srcset="build/img/blog1.webp" type="image/webp">
            <img loading="lazy" src="build/img/blog1.jpg" alt="blog1">
        </picture>
        <div>
            <h2>Lo nuevo en tecnologia</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa provident exercitationem amet, eveniet, distinctio perspiciatis, quae totam accusamus corporis ex perferendis! Asperiores quae fugit voluptatibus recusandae. Aspernatur recusandae voluptatem quibusdam.</p>
        </div>
    </section>
    
    <?php
        template("articulos");
    ?>

    <section class="contenedorSmall main-1">
        <div>
            <h2>Materiales de Calidad</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa provident exercitationem amet, eveniet, distinctio perspiciatis, quae totam accusamus corporis ex perferendis! Asperiores quae fugit voluptatibus recusandae. Aspernatur recusandae voluptatem quibusdam.</p>
        </div>
            <picture>
                <source srcset="build/img/blog2.avif" type="image/avif">
                <source srcset="build/img/blog2.webp" type="image/webp">
                <img loading="lazy" src="build/img/blog2.jpg" alt="blog2">
            </picture>
    </section>
</main>

<?php
template("footer");
?>
