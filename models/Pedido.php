<?php

require_once '../config/bd.php';

class Pedido{
    private $db;

    public function __construct(){
        $this->db = Database::conection();
    }

    public function crear($userID, $estado, $ciudad, $direccion, $precio, $status){
        $sql = "INSERT INTO `pedidos` (`id`, `usuario_id`, `provincia`, `localidad`, `direccion`, `coste`, `estado`, `fecha`, `hora`) VALUES (null,	'$userID', '$estado', '$ciudad', '$direccion', '$precio', '$status', CURDATE(),	DATE_FORMAT(NOW(), '%H:%i:%S' ));";
        $query = $this->db->query($sql);
        $query2 = $this->db->query("SELECT LAST_INSERT_ID();");
        return $query2;
    }

    public function crearLinea($pedidoID, $productoID, $unidades){
        $sql = "INSERT INTO `lineas_pedidos` (`id`, `pedido_id`, `producto_id`, `unidades`) VALUES (null, '{$pedidoID}',' {$productoID}', '{$unidades}');";
        $query = $this->db->query($sql);
        return $query;
    }

    public function obtenerTodos($id){
        $sql = "SELECT * FROM pedidos WHERE usuario_id = {$id};";

        $query = $this->db->query($sql);

        return $query;
    }

}