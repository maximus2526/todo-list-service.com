
<?php 
    include_once 'db-model.php';
    class Auth_actions {
        public function log_in(array $user_info){
        }
        public function add_user(array $user_info){
            // receive associative array, send data to db 
            $user_info["password"] = password_hash($user_info["password"], PASSWORD_DEFAULT);
            $keys = implode(', ', array_keys($user_info));
            $prepared_syntax = implode( ', ', array_map(array($this, 'get_parametrize_value'), array_keys($user_info)));
            $sql = "INSERT INTO `users` ({$keys}) VALUES ({$prepared_syntax});";
            // $this->execQuery($sql, $user_info);
        }

        public function delete_user(int $entries_id){
            $sql = "DELETE FROM `users` WHERE `user_id` = $entries_id;";
            // $this->execQuery($sql);
        }
        

    }


    class UserActions extends Auth_actions{
       

    }   
    ?>

