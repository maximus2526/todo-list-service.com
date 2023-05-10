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
            header("Location: /");
            break;
        case 'complete':
            $controller->changeStatusAction('incomplete'); 
            header("Location: /");
            break;
        case 'incomplete':
            $controller->changeStatusAction('complete'); 
            header("Location: /");
            break;
        case 'delete':
            $controller->delTodosAction();
            header("Location: /");
            break; 
        default:
            $controller->render_main_page();
    }





