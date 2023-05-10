<?php 
include_once 'controller.php';
include_once 'helper.php';

$action = $_GET['action'];
$todo_id = $_GET['todo_id'];
$todo_status = $_GET['todo_status'];
$page = $_GET['page'];
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




