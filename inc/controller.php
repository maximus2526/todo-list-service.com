<?php

class TodoController{
    public $modelobj;
    public $todo_id;
    public $todo_item;
    public function __construct($modelobj){
        $this->modelobj = $modelobj;
        $this->todo_id = $_GET['todo_id'];
        $this->todo_item = $_POST['todo_item'];
        // ТУТ БУДУТЬ КУКИ ДЛЯ ОБРОБКИ ПОМИЛОК
    }

    public function __destruct(){
        // ТУТ ВИДАЛЕННЯ КУКІВ
    }

    protected function get_tamplate_data(){
        $tamplate_data['todoes'] = $this->getTodosAction();
        return $tamplate_data;
    }

    public function render_main_page(){
        render('todos', $this->get_tamplate_data()); 
    }

    public function render_about(){
        render('about'); 
    }

    public function render_auth(){
        render('auth'); 
    }

    public function addTodoAction(){
        
        $params = [
            'user' => 'admin',
            'todo_status' => 'complete',
            'todo_item' => $this->todo_item
        ]; 
        $this->modelobj->addTodo($params);
        
    }
    
    public function getTodosAction(){
        return $this->modelobj->getAllTodos();
    }
    
    
    public function changeStatusAction(string $todo_status){
        return $this->modelobj->changeStatus($this->todo_id, $todo_status);
    }
    
    public function delTodosAction(){
        return $this->modelobj->deleteTodo($this->todo_id);
    }




    

}

$todo_model = new ToDoActions();
$controller = new TodoController($todo_model);

?>

