
<?php 
    class Auth_Model {
        private $pdo;

        function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function is_user_exist($user_name){
            // Returns 1 / 0
            $params = ['user_name' => $user_name ];
            $sql = "SELECT(EXISTS(SELECT `user_id` FROM `users` WHERE  `user_name` = :user_name));";
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            return $statement->fetchColumn(); 
        }



        public function is_logged_in(){
            return isset($_SESSION["user_id"]);
        }
        public function get_authorizated_user_name(){
            return $_SESSION['login'];
        }
        
        public function check_password($password, $user_name){
            $params = ['user_name' => $user_name ];
            $sql = "SELECT `user_password` FROM `users` WHERE `user_name` = :user_name;";
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            $hash = $statement->fetchColumn();
            return password_verify($password, $hash);
        }
        public function get_user_id($user_name){
            $params = ['user_name' => $user_name ];
            $sql = "SELECT `user_id` FROM `users` WHERE `user_name` = :user_name;";
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            $user_id = $statement->fetchColumn();
            return $user_id;
        }
        
        public function log_in($user_id){
            $_SESSION["user_id"] = $user_id;
        }

        public function log_out(){
            unset($_SESSION["user_id"]);
        }

        public function add_user($user_name, $password){
            $crypted_password = password_hash($password, PASSWORD_DEFAULT);
            $params = [
                'user_name' => $user_name, 
                'user_password' => $crypted_password, 
            ];
            $sql = "INSERT INTO `users` (user_name, user_password) VALUES (:user_name, :user_password);";
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            $user_id = $this->pdo->lastInsertId();
            return $user_id;
        }


    }

