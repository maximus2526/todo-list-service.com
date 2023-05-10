<?php 

    include_once 'inc/router.php';
    
    $action = $_GET['action'];
    $todo_id = $_GET['todo_id'];
    $todo_status = $_GET['todo_status'];
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
?>