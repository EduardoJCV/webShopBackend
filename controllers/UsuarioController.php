<?php

require_once "../models/Usuario.php";

class UsuarioController{

    public function save($data){

        if ( !empty($data['nombre']) && !empty($data['apellidos']) && !empty($data['email']) && !empty($data['password']) ) {
            $usuario = new Usuario();

            $usuario->setNombre($data['nombre']);
            $usuario->setApellido($data['apellidos']);
            $usuario->setEmail($data['email']);
            $usuario->setPassword($data['password']);
            $usuario->setRol('user');

            // var_dump($usuario);
            
            $query = mysqli_fetch_assoc($usuario->save());

            if ( $query ) {
                $_SESSION['usuario']['nombre'] = $usuario->getNombre();
                $_SESSION['usuario']['apellido'] = $usuario->getApellido();
                $_SESSION['usuario']['email'] = $usuario->getEmail();
                $_SESSION['usuario']['password'] = $usuario->getPassword();
                $_SESSION['usuario']['rol'] = $usuario->getRol();
                $_SESSION['usuario']['imagen'] = $usuario->getImagen();
                $_SESSION['usuario']['id'] = $query['LAST_INSERT_ID()'];
                return $_SESSION['usuario'];
            }else{
                return "El formulario No es Valido intentelo otra vez";
            }
        } else {
            return "El formulario No es Valido intentelo otra vez";
        }
    }

    public static function entr( $emailData, $passwordData ){
        if ( isset($emailData) && isset($passwordData) ) {
            $errores = [];
            $email = $emailData;
            $passw = $passwordData;
            if ( !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) ) {
                $emailValidado = true;
            }else{
                $emailValidado = false;
                $errores['error-email'] = 'El email no es correcto';
            }
            // validar campo password
            if ( !empty($passw) ) {
                $passwValidado = true;
            }else{
                $passwValidado = false;
                $errores['error-password'] = 'El password no es correcto';
            }
            $saveUser = false;
            if ( count($errores) == 0 ) {
                $saveUser = true;
                $_SESSION['errores'] = [];
                $conexion = new Usuario();
                $conexion->setEmail($email);
                $usuario = $conexion->log($passw);
                return $usuario;
            }else{
                return $_SESSION['errores'];
            }
        }else{
            return false;
        }
    }

}