<?php 
    class Router{
        public $todo_controller;
        public $auth_controller;
        public function __construct($todo_controller, $auth_controller){
            $this->todo_controller = $todo_controller;
            $this->auth_controller = $auth_controller;

        }
        public function route(){
            switch($_GET['action']){
                case 'about':
                    $this->todo_controller->render_about_action();
                    break;
                case 'auth':
                    $this->todo_controller->render_auth_action();
                    break;
                case 'register':
                    $this->auth_controller->add_user_action();
                    break;
                case 'login':
                    $this->auth_controller->login_action();
                    break;
                case 'logout':
                    $this->auth_controller->log_out();
                    break;
                case 'add':
                    $this->todo_controller->add_todo_action();
                    break;
                case 'complete':
                    $this->todo_controller->change_status_action('incomplete'); 
                    break;
                case 'incomplete':
                    $this->todo_controller->change_status_action('complete'); 
                    break;
                case 'delete':
                    $this->todo_controller->del_todos_action();
                    break; 
                default:
                    $this->todo_controller->render_main_page_action();
            }
        }

    }





