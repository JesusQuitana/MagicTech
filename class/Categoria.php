<?php
namespace App;

use App\BaseDatos;
BaseDatos::conectarDB();

class Categoria extends BaseDatos {
//###############ATRIBUTOS DE LA CLASE CATEGORIA######################
    protected static $tabla = "categoria";
    protected static $columnaDB = ["categoria"];

    public $id = "";
    public $categoria;

//###############CONSTRUCTOR######################
    public function __construct(array $datos = [])
    {
        $this->categoria = $datos["categoria"] ?? "";
    }

//###############METODOS#############################
    public function validar(string $accion) {
        if(!$this->categoria) {
            self::$errores[] = "Debe de añadir un nombre a la categoria";
        }
    //################SI LA VALIDACION ES CORRECTA#############################
        if(empty(self::$errores)) {
            if($accion=="create") {
                //############INSERCCION EN LA BASE DE DATOS###################
                $this->setAtributos();
                $resultado = $this::create();
                if($resultado) {
                    header("location: ../categorias/index.php?resultado=1");
                }
            }
            else if($accion=="update") {
                //############INSERCCION EN LA BASE DE DATOS###################
                $this->setAtributos();
                $resultado = $this::update($this->id);
                if($resultado) {
                    header("location: ../categorias/index.php?resultado=2");
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