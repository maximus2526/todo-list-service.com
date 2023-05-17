<?php

class Todo_Controller{
    public $todo_model;
    public $auth_model;
    public $errors;
    public $todo_id;
    public function __construct($todo_model, $auth_model){
        $this->todo_model = $todo_model;
        $this->auth_model = $auth_model;
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
            'is_logged_in' => $this->auth_model->is_logged_in(),
            'user_name' => $this->auth_model->get_authorizated_user_name(),
        ];
        if($this->auth_model->is_logged_in()){
            render('todos', $tamplate_data);
        } else{
            render('about', $tamplate_data);
        }   
    }


    public function add_todo_action(){
        if ($this->auth_model->is_logged_in()){
            $todo_item = strip_tags($_POST['todo_item']);
            $todo_category = strip_tags($_POST['choiced-category']);
            if(!$todo_category){
                $todo_category = 'No category';
            }
            $params = [
                'user_name' => $_SESSION['login'],
                'todo_status' => 'complete',
                'todo_item' => $todo_item,
                'todo_category' => $todo_category
            ]; 
            
            if(strlen($todo_item) > 100){
                Errors::set_error('Your todo greater then 100 chars!');  
            }
            elseif(strlen($todo_item) < 4){
                Errors::set_error('Your todo lesser then 4 chars! Type more!');
            }
            else{
                Errors::set_message('Todo added successfully!'); 
            }
                
            if (!Errors::has_errors()){
                $this->todo_model->add_todo($params);
            }  
            redirect();
        } else {
            redirect('?action=auth');
        }
    }


    
    public function change_status_action(string $todo_status){
        if ($this->auth_model->is_logged_in()){
            if(!$this->todo_model->is_entry_exist($this->todo_id)){
                Errors::set_error($this->todo_id.'- entry does not exist!');
            }
            if(!Errors::has_errors()){
                $this->todo_model->change_status($this->todo_id, $todo_status);
            }  
            redirect();
        } else {
            redirect('?action=auth');
        }
    }
    
    public function del_todos_action(){
        if ($this->auth_model->is_logged_in()){
            if(!$this->todo_model->is_entry_exist($this->todo_id)){
                Errors::set_error($this->todo_id.'- entry does not exist!');
            }
            if(!Errors::has_errors()){
                $this->todo_model->delete_todo($this->todo_id);
            }
                
            redirect();
        } else {
            redirect('?action=auth');
        }    
    }



}