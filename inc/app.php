<?php 


    class App{
        public $pdo;
        public $PDO_OPTIONS = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        );
        public function __construct(){
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
            include_once "models/todo-model.php";
            include_once "errors.php";
            $errors = new Errors;
            include_once "controller.php";
            $todo_model = new Todo_Model($this->pdo);
            include_once 'helper.php';
            $controller = new Todo_Controller($todo_model, $errors);
            include_once 'router.php';
            $router = new Router($controller);
            $router->route();
        }


        
    }

    $app = new App();
    






?>