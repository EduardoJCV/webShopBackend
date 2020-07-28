<?php

require_once "../models/Pedido.php";
require_once "../models/Producto.php";

class PedidoController{

    public function crear($data){
        $todo = array();
        $productos = array();
        $productosPrecioTotal = 0;
        $conexionProducto = new Producto();
        $conexionPedido = new Pedido();
        // $pedido = $conexion->crear();

        for ($i=0; $i < count($data['productos']) ; $i++) {
            $elemEditado = mysqli_fetch_assoc( $conexionProducto->busquedaID( $data['productos'][$i]['id'] ) );
            $elemEditado['cantidad'] = $data['productos'][$i]['cantidad'];
            array_push( $productos,  $elemEditado);
        }

        for ($i=0; $i < count($productos) ; $i++) { 
            for ($ind=0; $ind < $productos[$i]['cantidad'] ; $ind++) { 
                $productosPrecioTotal += floatval( $productos[$i]['oferta'] );
            }
        }

        $res = $conexionPedido->crear(  $data['userToken']['id'],
                                        $data['direccion']['estado'], 
                                        $data['direccion']['ciudad'], 
                                        $data['direccion']['direccion'], 
                                        $productosPrecioTotal, 
                                        'Pendiente'
                                    );
        $resArr = mysqli_fetch_assoc($res);
        $res2 = array();
        for ($i=0; $i < count($productos) ; $i++) { 
            array_push($res2, $conexionPedido->crearLinea($resArr['LAST_INSERT_ID()'], $productos[$i]['id'], $productos[$i]['cantidad']));
        }
        return $res2;

    }

    public function getPedidos($user){
        $conexion = new Pedido();
        $pedidos = $conexion->obtenerTodos($user['id']);
        $resp = array();
        while ( $pedido = mysqli_fetch_assoc($pedidos) ){
            array_push( $resp, $pedido );
        }
        return $resp;
    }


}