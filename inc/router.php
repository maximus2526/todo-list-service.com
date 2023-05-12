<?php 
    class Router{
        public $controller;
        public function __construct($controller){
            $this->controller = $controller;
        }
        public function route(){
            switch($_GET['action']){
                case 'about':
                    $this->controller->render_about_action();
                    break;
                case 'auth':
                    $this->controller->render_auth_action();
                    break;
                case 'add':
                    $this->controller->add_todo_action();
                    break;
                case 'complete':
                    $this->controller->change_status_action('incomplete'); 
                    break;
                case 'incomplete':
                    $this->controller->change_status_action('complete'); 
                    break;
                case 'delete':
                    $this->controller->del_todos_action();
                    break; 
                default:
                    $this->controller->render_main_page_action();
            }
        }

    }





