<?php 


    class App{
        public $pdo;
        public $PDO_OPTIONS;
        public function __construct(){
            $this->PDO_OPTIONS = $PDO_OPTIONS = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false);
            // create session
            if(empty($_SESSION))
                session_start();
            // connect to db
            include "config.php";
            $dns = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8;';
            if (!$this->pdo)  
                $this->pdo = new PDO($dns, DB_USERNAME, DB_PASSWORD, $this->PDO_OPTIONS);
            }
        public function run(){
            include_once 'helper.php';
            include_once "models/todo-model.php";
            include_once "models/auth-model.php";
            include_once "errors.php";
            include_once "inc/controllers/todo-controller.php";
            include_once "inc/controllers/auth-controller.php";
            include_once 'router.php';
            $errors = new Errors;
            $auth_model = new Auth_Model($this->pdo);
            $todo_model = new Todo_Model($this->pdo);
            $todo_controller = new Todo_Controller($todo_model, $auth_model);
            $auth_controller = new Auth_Controller($auth_model);
            $router = new Router($todo_controller, $auth_controller);
            $router->route();
        }


        
    }

    $app = new App();
    $app->run();






?>