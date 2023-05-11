<?php 
    switch($_GET['action']){
        case 'about':
            $controller->renderAbout();
            break;
        case 'auth':
            $controller->renderAuth();
            break;
        case 'add':
            $controller->addTodo();
            break;
        case 'complete':
            $controller->changeStatus('incomplete'); 
            break;
        case 'incomplete':
            $controller->changeStatus('complete'); 
            break;
        case 'delete':
            $controller->delTodos();
            break; 
        default:
            $controller->renderMainPage();
    }





