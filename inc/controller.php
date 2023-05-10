<?php

class TodoController{
    public $modelobj;
    public $todo_id;
    public $todo_item;
    public $tamplate_data;
    public function __construct($modelobj, $tamplate_data){
        $this->modelobj = $modelobj;
        $this->todo_id = $_GET['todo_id'];
        $this->todo_item = $_POST['todo_item'];
        $this->tamplate_data = $tamplate_data;
        // ТУТ БУДУТЬ КУКИ ДЛЯ ОБРОБКИ ПОМИЛОК
    }

    public function __destruct(){
        // ТУТ ВИДАЛЕННЯ КУКІВ
    }


    public function render_main_page(){
        render('todos', $this->tamplate_data); 
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
        header("Location: /");
    }
    
    public function changeStatusAction(string $todo_status){
        $this->modelobj->changeStatus($this->todo_id, $todo_status);
        header("Location: /");
    }
    
    public function delTodosAction(){
        $this->modelobj->deleteTodo($this->todo_id);
        header("Location: /");
    }

}

$todo_model = new ToDoActions();
$tamplate_data = get_tamplate_data($todo_model);
$controller = new TodoController($todo_model, $tamplate_data);

?>

