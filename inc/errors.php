<?php 
class Errors{
    static function has_errors(){
        return !empty($_SESSION['errors']);
    }

    static public function set_error(string $error_text){
        $_SESSION['errors'][] = $error_text;
    }

    static public function set_message(string $message_text){
        $_SESSION['success'] = $message_text;
    }

    static public function tamplate_massage(){
        if (!empty($_SESSION['success'])){
            echo "<div class='massage'>";
            $message = $_SESSION['success'];
            echo "<p class='massage-text'>{$message}</p>"; 
            echo "</div>";
            Errors::clean();
        }   
    }

    static public function tamplate_error(){
        if (!empty($_SESSION['errors'])){
            echo "<div class='errors'>";
            foreach ($_SESSION['errors'] as $error){
                echo "<p class='errors-text'>$error</p>";
            }     
            echo "</div>";
            Errors::clean();
        }   
    }


    static public function display(){
        if (!Errors::has_errors()){
            Errors::tamplate_massage();
        } else{
            Errors::tamplate_error(); 
        }  
    }

    
    static public function clean(){
        unset($_SESSION['errors']); 
        unset($_SESSION['success']); 
    }



}

