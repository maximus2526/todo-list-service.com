<?php

class Todo_Controller{
    public $model;
    public $errors;
    public $todo_id;
    public function __construct($model, $errors){
        $this->model = $model;
        $this->errors = $errors;
        $this->todo_id = $_GET['todo_id'];
    }


    public function render_main_page_action(){
        $page_num = !$_GET['page_num'] ? 1 : $_GET['page_num'];
        $page_options = [
            'page_num' => $page_num,
            'entries_limit' => PAGE_LIMIT,
        ];
        $tamplate_data = [
            'todoes' => $this->model->get_paginated_todos($page_options),
            'pages' => $this->model->get_count_of_buttons($page_options), 
            'errors' => $this->errors, 
        ];
        if($_SESSION['user_id']){
            render('todos', $tamplate_data);
        } else{
            render('about', $tamplate_data);
        }

         
    }

    public function render_about_action(){
        $tamplate_data = [
            'errors' => $this->errors, 
        ];
        render('about', $tamplate_data); 
    }

    public function render_auth_action(){
        $tamplate_data = [
            'errors' => $this->errors, 
        ];
        render('auth', $tamplate_data); 
    }

    public function add_todo_action(){
        $todo_item = strip_tags($_POST['todo_item']);
        $params = [
            'user_name' => $_SESSION['login'],
            'todo_status' => 'complete',
            'todo_item' => $todo_item
        ]; 
        
        if(strlen($todo_item) > 100)
            $this->errors->get_error('Your todo greater then 100 chars!');  
        elseif(strlen($todo_item) < 4)
            $this->errors->get_error('Your todo lesser then 4 chars! Type more!');
        else
            $this->errors->get_message('Todo added successfully!'); 
            if (!$this->errors->has_errors())
                $this->model->add_todo($params);
        redirect();
    }


    
    public function change_status_action(string $todo_status){
        if(!$this->model->is_entry_exist($this->todo_id))
            $this->errors->get_error($this->todo_id.'- entry does not exist!');
        if(!$this->errors->has_errors())
            $this->model->change_status($this->todo_id, $todo_status);
        redirect();
    }
    
    public function del_todos_action(){
        if(!$this->model->is_entry_exist($this->todo_id))
            $this->errors->get_error($this->todo_id.'- entry does not exist!');
        if(!$this->errors->has_errors())
            $this->model->delete_todo($this->todo_id);
        redirect();
            
    }



}

class Auth_Controller{
    public $errors;
    public $todo_auth;
    public function __construct($todo_auth, $errors){
        $this->todo_auth = $todo_auth;
        $this->errors = $errors;
    }
    public function login_action(){
        $login = $_POST['user_login'];
        $user_id = $this->todo_auth->get_user_id($login);
        $password = $_POST['user_password'];
        if ($this->todo_auth->check_password($password, $user_id)){
            $this->todo_auth->log_in($login);
            $_SESSION['login'] = $login;
            redirect();
        } else {
            echo $user_id;
            var_dump($this->todo_auth->check_password($password, $user_id));
            echo 'Invalid password!';
        }

        
    }
    public function add_user_action(){
        $login = $_POST['user_login'];
        $password = $_POST['user_password'];
        $password_repeat = $_POST['user_password2'];
        if ($password == $password_repeat){
            $this->todo_auth->add_user($login, $password);
            $this->login_action();
        } else {
            echo 'Невірний пароль';
            // Ошибка
        }

    }
    public function log_out(){
        if(isset($_SESSION["user_id"])){
            $this->todo_auth->log_out();
        }
        redirect();
    }


}




?>

