
<?php 
    class Todo_Model{
        private $pdo;

        function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function is_entry_exist(int $entries_id){
            $sql = "SELECT COUNT(*) FROM `to-does` 
            WHERE `todo_id` = '{$entries_id}';";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $count_of_values = $statement->fetchColumn();
            return $count_of_values > 0; 
        }

        public function add_todo($params){
            $params = [
                'user_name' => $params['user_name'], 
                'todo_status' => $params['todo_status'], 
                'todo_item' => $params['todo_item'],
                'todo_category' => $params['todo_category']

            ];
            $sql = "INSERT INTO `to-does` (user_name, todo_status, todo_item, todo_category) VALUES (:user_name, :todo_status, :todo_item, :todo_category);";
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
        }

        public function delete_todo(int $entries_id){
            $sql = "DELETE FROM `to-does` WHERE `todo_id` = '{$entries_id}';";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        }
        public function get_count_of_buttons(array $options){
            $sql = "SELECT COUNT(*) FROM `to-does`;";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $todoes_count = $statement->fetchColumn();
            if(empty($todoes_count)){
                return array();
            }
            return range(1, count(array_chunk(range(1, $todoes_count), $options['entries_limit'])));
        }
        
        public function get_paginated_todos(array $options){
            $offset = ($options['page_num'] - 1) * $options['entries_limit'];
            $param = ['user_name' => $_SESSION['login']];
            $sql = "SELECT * FROM `to-does` WHERE `user_name` = :user_name ORDER BY `to-does`.`todo_id` DESC LIMIT {$options['entries_limit']} OFFSET {$offset};";
            $statement = $this->pdo->prepare($sql);
            $statement->execute( $param );
            $paginated_todos = $statement->fetchAll();
            return $paginated_todos;
        }

        public function change_status(int $entries_id, string $todo_status){
            $params = [
                'todo_status' => $todo_status,
                'entries_id' => $entries_id
            ];
            $sql = "UPDATE `to-does` SET `todo_status` = :todo_status 
                WHERE `to-does`.`todo_id` = :entries_id;";

            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
        }

    }
    ?>

