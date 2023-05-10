<?php
include "models/todo-model.php";

class TodoController{
    public $modelobj;
    public function __construct($modelobj){
        $this->modelobj = $modelobj;
        // ТУТ БУДУТЬ КУКИ ДЛЯ ОБРОБКИ ПОМИЛОК
    }
    public function addTodoAction(string $todo_item){
        $params = [
            'user' => 'admin',
            'todo_status' => 'complete',
            'todo_item' => $todo_item
        ];
        
        $this->modelobj->addTodo($params);
        
    }
    
    public function getTodosAction(){
        return $this->modelobj->getAllTodos();
    }
    
    
    public function changeStatusAction(int $entries_id, string $todo_status){
        return $this->modelobj->changeStatus($entries_id, $todo_status);
    }
    
    public function delTodosAction(int $todo_id){
        return $this->modelobj->deleteTodo($todo_id);
    }
    

}

$todo_model = new ToDoActions();
$controller = new TodoController($todo_model);

?>

