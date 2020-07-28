<?php

require_once "../models/Producto.php";

class ProductoController{

    public function crear(){

    }

    public function todos($all){
        $conexion = new Producto();
        $productos = $conexion->obtenerTodos($all);
        $resp = array();
        while ( $producto = mysqli_fetch_assoc($productos) ){
            array_push( $resp, $producto );
        }
        return $resp;
    }

    public function buscar($id){
        $conexion = new Producto();
        $productos = $conexion->busqueda($id);
        $resp = array();
        while ( $producto = mysqli_fetch_assoc($productos) ){
            array_push( $resp, $producto );
        }
        return $resp;
    }

    public function buscarID($id){
        $conexion = new Producto();
        
        $productos = $conexion->busquedaID($id);

        return mysqli_fetch_assoc($productos);
    }

    public function categoria($id){

        $conexion = new Producto();

        $productoCats = $conexion->obtenerPorCategoria($id);
        $resp = array();
        while ( $producto = mysqli_fetch_assoc($productoCats) ){
            array_push( $resp, $producto );
        }
        return $resp;
    }
}