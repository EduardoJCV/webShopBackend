<?php

require_once "../models/Categoria.php";

class CategoriaController{

    public static function getAll(){

        $conexion = new Categoria();

        $result = $conexion->mostrarTodas();

        return $result;
    }

    public function crear($data){
        if ( $data ) {
            $categoria = new Categoria();

            $categoria->setNombre($data['nombre']);
            $categoria->setTipo($data['tipo']);

            $categoria->save();
        }
    }

}