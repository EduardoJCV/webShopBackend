<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Request-Whith, Content-Type, Accept');
header('Content-Type: application/json');

require_once '../controllers/pedidoController.php';


switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':

    break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if ( $data['action'] == 'pagarCarrito' ) {

            $cont = new PedidoController();

            echo  json_encode( $cont->crear($data) );

        }elseif ( $data['action'] == 'getPedidos' ) {
            
            $cont = new PedidoController();

            echo  json_encode( $cont->getPedidos($data['userToken']) );

        }
    break;
    case 'PUT':
        echo json_encode($datos);
    break;
    case 'DELETE':
        echo json_encode($datos);
    break;
    default:
    break;
}