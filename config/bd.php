<?php

class Database{
    public static function conection(){
        $conexion = new mysqli("localhost", "root", "", "web_shop");
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
}

