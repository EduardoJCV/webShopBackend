<?php

require_once '../config/bd.php';

class Categoria{
    private $id;
    private $nombre;
    private $tipo;

    private $db;


    public function getNombre(){
        return $this->nombre;
    }
    public function getTipo(){
        return $this->tipo;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

    public function __construct(){
        $this->db = Database::conection();
    }

    public function mostrarTodas(){
        $sql = "SELECT * FROM categorias ORDER BY id DESC";

        $query = $this->db->query($sql);

        return $query;
    }

    public function save(){
        $sql = "INSERT INTO categorias VALUES(NULL, '{$this->nombre}', '{$this->tipo}')";
        $query = $this->db->query($sql);
        return $query;
    }
}