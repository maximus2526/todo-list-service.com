<?php 
    switch($_GET['action']){
        case 'about':
            $controller->renderAbout();
            break;
        case 'auth':
            $controller->renderAuth();
            break;
        case 'add':
            $controller->addTodoAction();
            break;
        case 'complete':
            $controller->changeStatusAction('incomplete'); 
            break;
        case 'incomplete':
            $controller->changeStatusAction('complete'); 
            break;
        case 'delete':
            $controller->delTodosAction();
            break; 
        default:
            $controller->renderMainPage();
    }





