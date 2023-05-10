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
        static function get_parametrize_value(string $value){
            // function for array map
            return ":" . $value;
        }
        protected function connect() {
            // "Lazy" connect to db, connect only when need
            if (!$this->pdo) {
                $this->pdo = new PDO($this->dsn, $this->username, $this->password, $this->options);
            }

        }
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

        public function clearTable(string $table){
            $sql = "TRUNCATE `$table`;";
            $this->execQuery($sql);
        }


        public function addEntry(array $info, string $table){
            // receive associative array, send data to db 
            $keys = implode(', ', array_keys($info));
            $prepared_syntax = implode( ', ', array_map(array($this, 'get_parametrize_value'), array_keys($info)));
            $sql = "INSERT INTO `$table` ({$keys}) VALUES ({$prepared_syntax});";
            $this->execQuery($sql, $info);
        }

        public function deleteEntry(int $entries_id, string $table, string $fk_column){
            $sql = "DELETE FROM `$table` WHERE `$fk_column` = '$entries_id';";
            $this->execQuery($sql);
        }


    }