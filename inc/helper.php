<?php

function get_url(){
    return 'http://' . $_SERVER['SERVER_NAME'];
}


function render(string $name, array $tamplate_data){
    include_once 'views/header.php';
    include_once 'views/' . $name . '.php';
    include_once 'views/footer.php';
    
}