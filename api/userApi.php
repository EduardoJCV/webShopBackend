<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Request-Whith, Content-Type, Accept');
header('Content-Type: application/json');

require_once '../controllers/UsuarioController.php';





switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if ( isset($_GET['email']) && isset($_GET['password']) ) {

            $cont = new UsuarioController();

            $res = $cont->entr( $_GET['email'], $_GET['password']);

            unset($res['password']);

            echo json_encode($res);

        }
    break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (  $data['action'] == 'registrar' ) {

            $cont = new UsuarioController();

            $res = $cont->save( $data['data'] );

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