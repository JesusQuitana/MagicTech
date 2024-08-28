<?php

//#################CONECTAR A LA BASE DE DATOS#################################
    function conectarDB() : PDO {
        try {
            $conexion = new PDO(DATABASE, USER, PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        }
        catch(Exception $e) {
            return "ERROR: " . $e->getMessage();
        }
    }

//#################TEMPLATES#################################
    function template(string $template) {
        include TEMPLATE_URL . $template . ".php";
    }

//#################DEBUGEAR#################################
    function debugear($variable) {
        echo "<pre class='contenedorSmall'>";
        var_dump($variable);
        echo "</pre>";
        exit;
    }

//#################VERIFICARSESSION#################################
    function verificarSesion() {
        session_start();
        if($_SESSION["login"]!=true) {
            header("location: ../../index.php");
        }
    }

//#################RESULTADOS#################################
    function resultadoAdmin($action) :array {
        switch($action) {
            case null:
                $resultado[] = "";
                return $resultado;
                break;
            case 1:
                $resultado[]="<p class='alerta verde'>Producto Agregado con Exito</p>";
                return $resultado;
                break;
            case 2:
                $resultado[]="<p class='alerta amarilla'>Producto Editado con Exito</p>";
                return $resultado;
                break;
            case 3:
                $resultado[]="<p class='alerta roja'>Producto Eliminado con Exito</p>";
                return $resultado;
                break;
            default:
                $resultado[]="<p class='alerta roja'>Accion No Valida</p>";
                return $resultado;
                break;
        }
    }
?>