<?php

class Todo_Controller{
    public $todo_model;
    public $errors;
    public $todo_id;
    public function __construct($todo_model, $errors){
        $this->todo_model = $todo_model;
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
            'todoes' => $this->todo_model->get_paginated_todos($page_options),
            'pages' => $this->todo_model->get_count_of_buttons($page_options), 
            'errors' => $this->errors, 
        ];
        if($_SESSION['user_id']){
            render('todos', $tamplate_data);
        } else{
            render('about', $tamplate_data);
        }

         
    }


    public function add_todo_action(){
        $todo_item = strip_tags($_POST['todo_item']);
        $params = [
            'user_name' => $_SESSION['login'],
            'todo_status' => 'complete',
            'todo_item' => $todo_item
        ]; 
        
        if(strlen($todo_item) > 100)
            $this->errors::set_error('Your todo greater then 100 chars!');  
        elseif(strlen($todo_item) < 4)
            $this->errors::set_error('Your todo lesser then 4 chars! Type more!');
        else
            $this->errors::set_message('Todo added successfully!'); 
            if (!$this->errors::has_errors())
                $this->todo_model->add_todo($params);
        redirect();
    }


    
    public function change_status_action(string $todo_status){
        if(!$this->todo_model->is_entry_exist($this->todo_id))
            $this->errors::set_error($this->todo_id.'- entry does not exist!');
        if(!$this->errors::has_errors())
            $this->todo_model->change_status($this->todo_id, $todo_status);
        redirect();
    }
    
    public function del_todos_action(){
        if(!$this->todo_model->is_entry_exist($this->todo_id))
            $this->errors::set_error($this->todo_id.'- entry does not exist!');
        if(!$this->errors::has_errors())
            $this->todo_model->delete_todo($this->todo_id);
        redirect();
            
    }



}