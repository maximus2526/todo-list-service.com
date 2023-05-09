<?php 
include_once 'controller.php';
include_once 'helper.php';



$page = $_GET['page'];
$tamplate_data['todoes'] = $controller->getTodosAction();

switch($page){
    case 'about':

        render('about', $tamplate_data);
        break;
    case 'auth':
        render('auth', $tamplate_data);
        break;
    default:
        render('todos', $tamplate_data);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $action = $_GET['action'];
    $todo_id = $_GET['todo_id'];
    $todo_status = $_GET['todo_status'];
    $todo_item = $_POST['todo_item'];
    switch($action){
        case 'add':
            if (isset($todo_item))
                $controller->addTodoAction($todo_item);
            break;
        case 'complete':
            if ($todo_status == 'complete'){
                $controller->changeStatusAction($todo_id, 'complete'); 
            }
            
            break;
        case 'incomplete':
            if ($todo_status == 'complete'){
                $controller->changeStatusAction($todo_id, 'incomplete'); 
            }
            break;
        case 'delete':
            if (isset($todo_id)){
                $controller->delTodosAction($todo_id);
                break;
            }

    }
}




