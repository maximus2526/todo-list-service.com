<?php
function get_url(){
    return 'http://' . $_SERVER['SERVER_NAME'];
}
function get_todoes_url($action) {
    $order_by = isset($_GET['order_by']) ? '&order_by='.$_GET['order_by'] : '';
    $order = isset($_GET['order']) ? '&order='.$_GET['order'] : '';
    $choiced_category_sort = isset($_GET['choiced-category-sort']) ? '&choiced-category-sort='.$_GET['choiced-category-sort'] : '';
    $request_url =  $action . $order_by . $order . $choiced_category_sort;
    $url = "/?action=" . $request_url;
    return $url;
}


function redirect(string $path = ''){
    header("Location: /".$path);
}
function get_user_name(){
    return $_SESSION['login'];
}

function is_logged_in(){
    return isset($_SESSION["user_id"]);
}

function render(string $name, array $tamplate_data = NULL){
    if(isset($tamplate_data))
        extract($tamplate_data);
    include_once 'views/header.php';
    include_once 'views/' . $name . '.php';
    include_once 'views/footer.php';
}
