
<?php 
    include_once 'db-model.php';
    class ToDoActions extends Connection{
        private $table;
        private $fk_column;

        function __construct(){
            parent::__construct();
            $this->table = 'to-does';
            $this->fk_column = 'todo_id';
        }
        
        public function addTodo(array $todo_info){
            $this->addEntry($todo_info, $this->table);
        }

        public function deleteTodo(int $entries_id){
            $this->deleteEntry($entries_id, $this->table, $this->fk_column);
        }
        public function getAllTodos(){
            $sql = "SELECT * FROM `{$this->table}`;";
            return $this->execQuery($sql)->fetchAll();
        }
        public function getPaginatedTodos(array $options){
            $offset = ($options['page_num'] - 1)*$options['entries_limit'] ;
            $sql = "SELECT * FROM `{$this->table}` ORDER BY `{$this->table}`.`todo_id` ASC LIMIT {$options['entries_limit']} OFFSET {$offset};";
            return $this->execQuery($sql)->fetchAll();
        }

        public function changeStatus(int $entries_id, string $todo_status){
            $sql = "UPDATE `{$this->table}` SET `todo_status` = '{$todo_status}' 
                    WHERE `{$this->table}`.`{$this->fk_column}` = {$entries_id};";
            $this->execQuery($sql);

        }






    }
    ?>

