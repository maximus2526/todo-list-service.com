<?php
return [
    'dsn' => 'mysql:host=localhost;dbname=todo-service;charset=utf8', // DB info
    'username' => 'root', 
    'password' => '',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ],
];

?>