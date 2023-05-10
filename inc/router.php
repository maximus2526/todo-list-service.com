<?php 
include_once 'controller.php';
include_once 'helper.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $todo_item = $_POST['todo_item'];
    switch($action){
        case 'add':
            if (isset($todo_item))
                $controller->addTodoAction($todo_item);
            break;
        case 'complete':
            $controller->changeStatusAction($todo_id, 'incomplete'); 
            break;
        case 'incomplete':
            $controller->changeStatusAction($todo_id, 'complete'); 
            break;
        case 'delete':
            if (isset($todo_id)){
                $controller->delTodosAction($todo_id);
                break;
            }

    }
}




