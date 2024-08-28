<?php

include 'includes/app.php';

    $usuario = "admin01";
    $password = 123456;
    $correo = "correo@correo.com";
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $conexion = new PDO("mysql: host=localhost; dbname=magictech", "root", "K-jh564.*");
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "INSERT INTO usuarios (USUARIO, CLAVE, EMAIL) VALUES (:usuario, :password, :correo)";
        $consulta = $conexion->prepare($query);
        $consulta->bindValue(":usuario", $usuario);
        $consulta->bindValue(":password", $passwordHash);
        $consulta->bindValue(":correo", $correo);
        $consulta->execute();

        if($consulta->rowCount()!=0) {
            header("location: index.php");
        }
    }
    catch(Exception $e) {
        echo "ERROR: " . $e->getMessage();
    }



?>