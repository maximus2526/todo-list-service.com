
<?php 
    class Connection{
        protected $pdo;
        protected $dsn;
        protected $username;
        protected $password;
        protected $options;


        public function __construct() {
            $config = include 'inc/config.php';
            $this->dsn = $config['dsn'];
            $this->username = $config['username'];
            $this->password = $config['password'];
            $this->options = $config['options'];
            
        }
    
        protected function connect() {
            // "Lazy" connect to db, connect only when need
            if (!$this->pdo) {
                $this->pdo = new PDO($this->dsn, $this->username, $this->password, $this->options);
            }

        }
    }



    class ToDoActions extends Connection{
        protected function execQuery(string $query, array $params = []) {
            // Query handler for other methods
            $this->connect();
            $statement = $this->pdo->prepare($query);
            $statement->execute($params);
            if($statement->errorInfo()[0] !== '00000'){
                throw new Exception($statement->errorInfo()[2]);
            }
            return $statement;
        }
        protected function get_parametrize_value(string $value){
            // function for array map
            return ":" . $value;
        }
        public function addTodo(array $data){
            // receive associative array, send data to db 
            $keys = implode(', ', array_keys($data));
            $prepared_syntax = implode( ', ', array_map(array($this, 'get_parametrize_value'), array_keys($data)));
            $sql = "INSERT INTO `to-does` ({$keys}) VALUES ({$prepared_syntax});";
            $this->execQuery($sql, $data);
        }

        public function deleteTodo(int $entries_id){
            $sql = "DELETE FROM `to-does` WHERE `todo_id` = $entries_id;";
            $this->execQuery($sql);
        }
        public function getAllTodos(){
            $sql = "SELECT * FROM `to-does`;";
            return $this->execQuery($sql)->fetchAll();
        }

        public function changeStatus(int $entries_id, string $todo_status){
            $sql = "UPDATE `to-does` SET `todo_status` = '{$todo_status}' WHERE `to-does`.`todo_id` = {$entries_id};";
            $this->execQuery($sql);

        }

        public function clearTable(){
            $sql = "TRUNCATE `to-does`;";
            $this->execQuery($sql);
        }




    }
    ?>

