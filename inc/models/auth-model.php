
<?php 
    class Auth_Model {
        private $pdo;

        function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function get_user_id($user_name){
            $params = ['user_name' => $user_name ];
            $sql = "SELECT `user_id` FROM `users` WHERE  `user_name` = :user_name;";
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            return $statement->fetchColumn();
        }

        public function check_password($password, $user_id){
            $params = ['user_id' => $user_id ];
            echo $user_id;
            $sql = "SELECT `user_password` FROM `users` WHERE `user_id` = :user_id;";
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            $hash = $statement->fetchColumn();
            return password_verify($password, $hash);
        }
        public function log_in($user_name){
            $_SESSION["user_id"] = $this->get_user_id($user_name);
        }

        public function log_out(){
            unset($_SESSION["user_id"]);
        }

        public function add_user($login, $password){
            $crypted_password = password_hash($password, PASSWORD_DEFAULT);
            $params = [
                'user_name' => $login, 
                'user_password' => $crypted_password, 
            ];
            $sql = "INSERT INTO `users` (user_name, user_password) VALUES (:user_name, :user_password);";
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
        }

    }

