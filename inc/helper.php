<?php
function get_url(){
    return 'http://' . $_SERVER['SERVER_NAME'];
}

function render(string $name, array $tamplate_data = NULL){
    if(isset($tamplate_data)){
        extract($tamplate_data);
    }
    include_once 'views/header.php';
    include_once 'views/' . $name . '.php';
    include_once 'views/footer.php';
}
function get_tamplate_data($todo_model){
    $tamplate_data['todoes'] = $todo_model->getAllTodos();
    return $tamplate_data;
}