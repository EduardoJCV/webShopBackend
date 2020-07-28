<?php

include_once '../config/bd.php';

class Usuario{
    private $id;
    private $nombre;
    private $apellido;
    private $email;
    private $password;
    private $imagen;
    private $rol;

    private $db;

    public function __construct(){
        $this->db = Database::conection();
    }
    
    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getImagen(){
        return $this->imagen;
    }
    public function getRol(){
        return $this->rol;
    }

    public function setId($id){
        $this->id = $id;
    }
    public function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    public function setApellido($apellido){
        $this->apellido = $this->db->real_escape_string($apellido);
    }
    public function setEmail($email){
        $this->email = $this->db->real_escape_string($email);
    }
    public function setPassword($password){
        $this->password = password_hash($this->db->real_escape_string($password), PASSWORD_BCRYPT, ['cost' => 4]);
    }
    public function setImagen($imagen){
        $this->imagen = $this->db->real_escape_string($imagen);
    }
    public function setRol($rol){
        $this->rol = $this->db->real_escape_string($rol);
    }

    public function save(){
        $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->nombre}', '{$this->apellido}', '{$this->email}', '{$this->password}', 'user', NULL)";
        $query = $this->db->query($sql);
        $query2 = $this->db->query("SELECT LAST_INSERT_ID();");
        return $query2;
    }

    public function log($password){
        $sql = "SELECT * FROM usuarios WHERE email = '{$this->email}'";
        $login = mysqli_query($this->db, $sql);

        if ( $login && mysqli_num_rows($login) == 1 ) {

            $user = mysqli_fetch_assoc($login);

            if (password_verify($password, $user['password'])) {
                //iniciar una sesion para guardar el usuario logueado
                $_SESSION['usuario'] = $user;
                $_SESSION['completado'] = 'Sesion iniciada correctamente';

                return $user;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}