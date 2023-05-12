
<?php 
    include_once 'db-model.php';
    class AuthActions extends Connection{
        public function logIn(array $user_info){
        }
        public function addUser(array $user_info){
            // receive associative array, send data to db 
            $user_info["password"] = password_hash($user_info["password"], PASSWORD_DEFAULT);
            $keys = implode(', ', array_keys($user_info));
            $prepared_syntax = implode( ', ', array_map(array($this, 'get_parametrize_value'), array_keys($user_info)));
            $sql = "INSERT INTO `users` ({$keys}) VALUES ({$prepared_syntax});";
            $this->execQuery($sql, $user_info);
        }

        public function deleteUser(int $entries_id){
            $sql = "DELETE FROM `users` WHERE `user_id` = $entries_id;";
            $this->execQuery($sql);
        }
        

    }


    class UserActions extends AuthActions{
       

    }   
    ?>

