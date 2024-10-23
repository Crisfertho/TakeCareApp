<?php

namespace Models;
use Models\ActiveRecord;

class User extends ActiveRecord {
    //DB
    protected static $table = 'users';
    protected static $columnsDB = ['id', 'name', 'lastname', 'email', 'password','phone','admin', 'confirm', 'token'];
    
    public $id;
    public $name;
    public $lastname;
    public $email;
    public $password;
    public $phone;
    public $admin;
    public $confirm;
    public $token;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->lastname = $args['lastname'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirm = $args['confirm'] ?? '0';
        $this->token = $args['token'] ?? '';
    }

    public function validateLogin () {
        if(!$this->email) {
            self::$alerts['error'][] = 'El correo electrónico es obligatorio';
        }
        if(!$this->password) {
            self::$alerts['error'][] = 'La contraseña es obligatoria';
        }

        return self::$alerts;
    }

    public function validateEmail () {
        if(!$this->email) {
            self::$alerts['error'][] = 'El correo electrónico es obligatorio';
        }
        
        return self::$alerts;
    }

    public function validatePassword () {
        if(!$this->password) {
            self::$alerts['error'][] = 'La contraseña es obligatorio';
        }
        if(strlen(!$this->password)) {
            self::$alerts['error'][] = 'La contraseña debe tener al menos 6 caracteres';
        }

        return self::$alerts;
    }

    //Mesj de Validación Register
    public function validateNewUser () {

        self::$alerts = ['error' => []]; // Inicializar el arreglo de alertas
        if(!$this->name) { //si no hay nombre
            self::$alerts['error'][] = 'El nombre del cliente es obligatorio';
        }if(!$this->lastname) {
            self::$alerts['error'][] = 'El apellido del cliente es obligatorio';
        }if (!$this->phone) {
            self::$alerts['error'][] = 'El teléfono es obligatorio';
        }
        if (!$this->email) {
            self::$alerts['error'][] = 'El correo electrónico es obligatorio';
        }
        if (!$this->password) {
            self::$alerts['error'][] = 'La contraseña es obligatoria';
        }
        if(strlen($this->password) < 6) {
            self::$alerts['error'][] = 'La contraseña debe tener al menos 6 caracteres';
        }

        return self::$alerts;
    }

    public function existUser() {
        $query = " SELECT * FROM " . self::$table . " WHERE email = '" . $this->email . "' LIMIT 1";

        $result = self::$db->query($query);

        if($result->num_rows) {
            self::$alerts['error'][] = 'El usuario ya esta registrado';
        }
        return $result;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function createToken(){
        $this->token = uniqid(); 
    }

    //Comprobar contraseña y que el usuario este verificado
    public function findoutPassAndVerified($password){ 
        $result = password_verify($password, $this->password); 

        if(!$result || !$this->confirm) {
            self::$alerts['error'][] = 'Contraseña incorrecta o tu cuenta aún no ha sido confirmada';
        } else {
            return true;
        }
    }

}