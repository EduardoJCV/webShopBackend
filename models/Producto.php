<?php

require_once '../config/bd.php';

class Producto{
    private $db;

    public function __construct(){
        $this->db = Database::conection();
    }

    public function crear(){
        $sql = "INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `stock`, `oferta`, `fecha`, `imagen`) VALUES (NULL, '1', 'Playera RBa9', 'Playera deportiva con un logo de un jaguar en el centro de ella', '220', '100', '150', '2020-06-30', 'https://http2.mlstatic.com/D_NQ_NP_759752-MLM31196396916_062019-W.jpg');";
        $query = $this->db->query($sql);
        return $query;
    }
    public function obtenerTodos($all){
        $sql = "";
        if ($all == 'si') {
            $sql .= "SELECT * FROM productos ORDER BY id asc;";
        }else{
            $sql .= "SELECT * FROM productos ORDER BY id DESC LIMIT 0,5;";
        }
        
        $query = mysqli_query($this->db, $sql);

        return $query;
    }
    public function obtenerPorCategoria($id){
        $sql = "SELECT * FROM productos WHERE categoria_id = '{$id}';";

        $query = $this->db->query($sql);

        return $query;
    }
    public function busqueda($id){
        $sql = "SELECT * FROM productos WHERE nombre LIKE '%{$id}%';";

        $query = $this->db->query($sql);

        return $query;
    }
    public function busquedaID($id){
        $sql = "SELECT * FROM productos WHERE id = {$id};";

        $query = $this->db->query($sql);

        return $query;
    }
}