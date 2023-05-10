<?php 
$action = $_GET['action'];
$todo_id = $_GET['todo_id'];
$todo_status = $_GET['todo_status'];
$page = $_GET['page'];
$tamplate_data = array();
$tamplate_data['todoes'] = $controller->getTodosAction();
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $todo_item = $_POST['todo_item'];
}
    switch($action){
        case 'about':
            $controller->render_about();
            break;
        case 'auth':
            $controller->render_auth();
            break;
        case 'add':
            if (isset($todo_item))
                $controller->addTodoAction($todo_item);
                header("Location: /");
            break;
        case 'complete':
            $controller->changeStatusAction($todo_id, 'incomplete'); 
            header("Location: /");
            break;
        case 'incomplete':
            $controller->changeStatusAction($todo_id, 'complete'); 
            header("Location: /");
            break;
        case 'delete':
            if (isset($todo_id)){
                $controller->delTodosAction($todo_id);
                header("Location: /");
                break;
            }
            
        default:
            $controller->render_main_page($tamplate_data);

    }





