<?php 
$action = $_GET['action'];
$todo_id = $_GET['todo_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    switch($action){
        case 'add':
            $todo_item = $_POST['todo_item'];
            if (isset($todo_item)){
                addTodoAction($todo_item);
            } else {
                die('ERROR');
            }
            
            break;
        case 'change-todo-state':
            echo 'redirect to action in controller';
            break;
        case 'delete':

            if (isset($todo_id)){
                delTodosAction($todo_id);
            } else {
                die('ERROR');
            }
            break;
    }

}
