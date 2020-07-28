<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Request-Whith, Content-Type, Accept');
header('Content-Type: application/json');

require_once '../controllers/CategoriaController.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $retornar = array();
        $categoriasRes = CategoriaController::getAll();
        while ( $catego =  mysqli_fetch_assoc($categoriasRes) ){
            array_push($retornar, $catego);
        }
        echo json_encode( $retornar );
    break;
    case 'POST':
        echo json_encode($datos);
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