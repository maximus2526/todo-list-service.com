<?php 
class Errors{
    static function has_errors(){
        return !empty($_SESSION['errors']);
    }

    public function add_error(string $error_text){
        $_SESSION['errors'][] = $error_text;
    }

    public function get_message(string $message_text){
        $_SESSION['success'] = $message_text;
    }

    public function show_massage(){
        if (!empty($_SESSION['success'])){
            echo "<div class='massage'>";
            $message = $_SESSION['success'];
            echo "<p class='massage-text'>{$message}</p>"; 
            echo "</div>";
            $this->clean();
        }   
    }

    public function show_error(){
        if (!empty($_SESSION['errors'])){
            echo "<div class='errors'>";
            foreach ($_SESSION['errors'] as $error){
                echo "<p class='errors-text'>$error</p>";
            }     
            echo "</div>";
            $this->clean();
        }  
        
    }
    public function clean(){
        unset($_SESSION['errors']); 
        unset($_SESSION['success']); 
    }



}

