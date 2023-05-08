<?php
function addTodoAction($todo_item){
    $test = new ToDoActions();
    $params = [
        'user' => 'admin',
        'todo_status' => 1,
        'todo_item' => $todo_item
    ];
    $test->addTodo($params);
}

function getTodosAction(){
    $test = new ToDoActions();
    return $test->getAllTodos();
}


function delTodosAction($todo_id){
 
    $test = new ToDoActions();
    return $test->deleteTodo($todo_id);
}




?>

