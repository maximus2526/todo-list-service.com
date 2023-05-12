<?php

class Todo_Controller{
    public $model;
    public $todo_id;
    public function __construct($model){
        $this->model = $model;
        $this->todo_id = $_GET['todo_id'];
    }

    public function set_error(string $error){
        $_SESSION['errors'][] = $error;
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
        ];
        render('todos', $tamplate_data); 
    }

    public function render_about_action(){
        render('about'); 
    }

    public function render_auth_action(){
        render('auth'); 
    }

    public function add_todo_action(){
        $todo_item = strip_tags($_POST['todo_item']);
        $params = [
            'user' => 'admin',
            'todo_status' => 'complete',
            'todo_item' => $todo_item
        ]; 
        
        if(strlen($todo_item) > 100)
            $this->set_error('Your todo greater then 100 chars!');  
        elseif(strlen($todo_item) < 4)
            $this->set_error('Your todo lesser then 4 chars! Type more!');
        else
            $this->model->add_todo($params);
        redirect();
    }
    
    public function change_status_action(string $todo_status){
        if(!$this->model->is_entry_exist($this->todo_id))
            $this->set_error($this->todo_id.'- entry does not exist!');
        if(empty($_SESSION['errors']))
            $this->model->change_status($this->todo_id, $todo_status);
        redirect();
    }
    
    public function del_todos_action(){
        if(!$this->model->is_entry_exist($this->todo_id))
            $this->set_error($this->todo_id.'- entry does not exist!');
        if(empty($_SESSION['errors']))
            $this->model->delete_todo($this->todo_id);
        redirect();
            
    }



}

class AuthController{

}




?>

