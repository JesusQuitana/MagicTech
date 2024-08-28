<?php
namespace App;

use Exception;
use PDO;

abstract class BaseDatos {
//################ATRIBUTOS DE LA CLASE PADRE##########
    protected static $conexionDB;
    protected static $columnaDB = [];
    protected static $errores = [];
    protected static $atributos = [];
    protected static $tabla = "";

//################METODOS DE LA CLASE PADRE############
    public static function conectarDB() {
        self::$conexionDB = conectarDB();
    }

    protected static function crearObjetos(array $registro) {
        $objeto = new static;
        foreach($registro as $key=>$value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

//################METODO CREATE (C)####################
    protected static function create() {
        $query = "INSERT INTO " . static::$tabla;
        $query .= " (" . join(", ", array_keys(self::$atributos)) . ") VALUES";
        $query .= " (:" . join(", :", array_keys(self::$atributos)) . ")";
        try {
            $consulta = self::$conexionDB->prepare($query);
            foreach(self::$atributos as $key=>$value) {
                $consulta->bindValue(":".$key, $value);
            }
            $consulta->execute();
            if($consulta->rowCount()!=0) {
                return true;
            }
        }
        catch(Exception $e) {
            return "ERROR: " . $e->getMessage();
            die;
        }
    }

//################METODO SELECT (R)####################
    public static function select(string $id = "", string $condicion = "") : array {
        $array = [];
        if(!$id=="") {
            $query = "SELECT * FROM " . static::$tabla . " WHERE id=" . $id;
        }
        else if(!$condicion=="") {
            $query = "SELECT * FROM " . static::$tabla . " " . $condicion;
        }
        else if($id=="" && !$condicion=="") {
            $query = "SELECT * FROM " . static::$tabla . " " . $condicion;
        }
        else {
            $query = "SELECT * FROM " . static::$tabla;
        }
        
        try {
            $consulta = self::$conexionDB->prepare($query);
            $consulta->execute();
            $registros = $consulta->fetchAll(PDO::FETCH_ASSOC);
            foreach($registros as $registro) {
                $array[]=self::crearObjetos($registro);
            }
            return $array;
        }
        catch(Exception $e) {
            return "ERROR: " . $e->getMessage();
        }
    }

//################METODO UPDATE (U)####################
    public static function update($id) {
        foreach(self::$atributos as $key=>$value) {
            $array[] = $key . "=:" . $key;
        }
        $query = "UPDATE " . static::$tabla;
        $query .= " SET ";
        $query .= join(", ", $array);
        $query .= ' WHERE id=' . $id;
        
        try {
            $consulta = self::$conexionDB->prepare($query);
            foreach(self::$atributos as $key=>$value) {
                $consulta->bindValue(":".$key, $value);
            }
            $consulta->execute();
            if($consulta->rowCount()!=0) {
                return true;
            }

        }
        catch(Exception $e) {
            return "ERROR: " . $e->getMessage();
            die;
        }
    }


//################METODO DELETE (D)####################
    public static function delete($id) {
        $query = "DELETE FROM " . static::$tabla . " WHERE id=:id";
        try {
            $consulta = self::$conexionDB->prepare($query);
            $consulta->bindValue(":id", $id);
            $consulta->execute();
            if($consulta->rowCount()!=0) {
                return true;
            }
        }
        catch(Exception $e) {
            return "ERROR: " . $e->getMessage();
            die;
        }
    }

}
?>