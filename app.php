<?php 

    include_once 'inc/router.php';
    function render(string $name, array $tamplate_data){
        include_once 'views/header.php';
        include_once 'views/' . $name . '.php';
        include_once 'views/footer.php';
    }

    $tamplate_data['todoes'] = $controller->getTodosAction();
    switch($page){
        case 'about':
            render('about', $tamplate_data);
            break;
        case 'auth':
            render('auth', $tamplate_data);
            break;
        default:
            render('todos', $tamplate_data);
    }
?>