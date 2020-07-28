<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Request-Whith, Content-Type, Accept');
header('Content-Type: application/json');

require_once '../controllers/ProductoController.php';


switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if ( isset($_GET['type']) ) {
            if ( $_GET['type'] == 'search' ) {
                $cont = new ProductoController();

                $res = $cont->buscar($_GET['param']);

                echo json_encode($res);
            } elseif (  $_GET['type'] == 'all'  ){
                $cont = new ProductoController();

                $res = $cont->todos($_GET['param']);

                echo json_encode($res);
            } elseif (  $_GET['type'] == 'categoria'  ){
                $cont = new ProductoController();

                $res = $cont->categoria($_GET['param']);

                echo json_encode($res);
            }elseif (  $_GET['type'] == 'solo'  ){
                $cont = new ProductoController();
                $datos = explode(',', $_GET['param']);
                $res = array();
                for ($i=0; $i < count($datos); $i++) { 
                    array_push($res, $cont->buscarID($datos[$i]));
                }
                echo json_encode($res);
            }
        }
    break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if ( $data['action'] == 'getProdsID' ) {

            $res = array();

            $cont = new ProductoController();

            for ($i=0; $i < count($data['data']); $i++) { 
                array_push($res, $cont->buscarID($data['data'][$i]['id']));
            }
            echo json_encode($res);
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