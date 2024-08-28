<?php
namespace App;

use App\BaseDatos;
BaseDatos::conectarDB();

class Productos extends BaseDatos {

//###############ATRIBUTOS DE LA CLASE PADRE REESCRITOS###############
    protected static $tabla = "productos";
    protected static $columnaDB = ["nombre","precio","descripcion","imagen","disponible","cantidad","categoria_id"];

//###############ATRIBUTOS DE LA CLASE PRODUCTOS######################
    public $id = "";
    public $nombre;
    public $precio;
    public $descripcion;
    public $imagen;
    public $disponible;
    public $cantidad;
    public $categoria_id;

//###############CONSTRUCTOR######################
    public function __construct(array $datos = [], array $imagen = [])
    {
        $this->nombre = $datos["nombre"] ?? "";
        $this->precio = $datos["precio"] ?? 0;
        $this->descripcion = $datos["descripcion"] ?? "";
        $this->imagen = $imagen ?? "";
        $this->disponible = $datos["disponible"] ?? "";
        $this->cantidad = $datos["cantidad"] ?? 0;
        $this->categoria_id = $datos["categoria_id"] ?? 0;
    }

//###############METODOS#############################
    public function validar(string $accion) {
        if(!$this->nombre) {
            self::$errores[] = "Debe de añadir un nombre del producto";
        }
        if(!$this->precio) {
            self::$errores[] = "Debe de añadir un precio";
        }
        if(!$this->descripcion) {
            self::$errores[] = "Debe de añadir una descripcion";
        }
        if(!$this->disponible) {
            self::$errores[] = "Debe de añadir un disponible";
        }
        if(!$this->cantidad) {
            self::$errores[] = "Debe de añadir un cantidad";
        }
        if(!$this->categoria_id) {
            self::$errores[] = "Debe de añadir una categoria";
        }
        if($this->imagen["tmp_name"] == "") {
            self::$errores[] = "Debe de añadir una imagen";
        }
    //################SI LA VALIDACION ES CORRECTA#############################
        if(empty(self::$errores)) {
            //###############CREACION DE LA CARPETA DE IMAGEN##################
            $carpetaImagen = dirname(__DIR__) . "/build/img/imagenes/";
            $nombreImagen = md5(uniqid(rand(1, 10), true))  . "." . explode("/", $this->imagen["type"])[1];
            if(!is_dir($carpetaImagen)) {
                mkdir($carpetaImagen);
            }
            if($accion=="create") {
                //############SUBIDA DE ARCHIVOS###############################
                move_uploaded_file($this->imagen["tmp_name"], $carpetaImagen . $nombreImagen);
                $this->imagen = $nombreImagen;
                $this->setAtributos();
                //############INSERCCION EN LA BASE DE DATOS###################
                $resultado = $this::create();
                if($resultado) {
                    header("location: ../index.php?resultado=1");
                }
            }
            else if($accion=="update") {
                unlink($carpetaImagen . $this->imagen["name"]);
                //############SUBIDA DE ARCHIVOS###############################
                move_uploaded_file($this->imagen["tmp_name"], $carpetaImagen . $nombreImagen);
                $this->imagen = $nombreImagen;
                $this->setAtributos();
                //############INSERCCION EN LA BASE DE DATOS###################
                $resultado = $this::update($this->id);
                if($resultado) {
                    header("location: ../index.php?resultado=2");
                } else {
                    echo $resultado;
                }
            }
        }
        return self::$errores;
    }

    public function setAtributos() {
        foreach(self::$columnaDB as $columna) {
            self::$atributos[$columna] = $this->$columna; 
        }
    }

}

?>