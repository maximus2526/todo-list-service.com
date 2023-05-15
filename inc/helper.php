<?php
function get_url(){
    return 'http://' . $_SERVER['SERVER_NAME'];
}
function get_actions_url(){
    // URL for action
}

function redirect(string $path = ''){
    header("Location: /".$path);
}


function render(string $name, array $tamplate_data = NULL){
    if(isset($tamplate_data))
        extract($tamplate_data);
    include_once 'views/header.php';
    include_once 'views/' . $name . '.php';
    include_once 'views/footer.php';
}
