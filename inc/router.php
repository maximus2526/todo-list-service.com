<?php 
    switch($_GET['action']){
        case 'about':
            $controller->render_about();
            break;
        case 'auth':
            $controller->render_auth();
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
            $controller->render_main_page();
    }





