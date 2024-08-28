<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="icon" href="../../build/img/icons/favicon.png">
    <link rel="preload" href="../../build/css/app.css" as="style">
    <link rel="stylesheet" href="../../build/css/app.css">

    <title>MagicTech</title>
</head>
<body>

<header>
    <div class="fondo_header">
        <div class="contenedor header">
            <h1><a href="/*" class="titulo">Magic<span>Tech</span></a></h1>

            <nav class="barra_nav">
                <a href="contacto.php">Contacto</a>
                <?php
                    session_start();
                    if($_SESSION["login"]) {
                        echo '<a href="../../cerrar_sesion.php">Cerrar Sesion</a>';
                    }
                ?>
            </nav>
        </div>
    </div>
</header>