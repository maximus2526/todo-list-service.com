
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
        
        public function isEntryExist(int $entries_id){
            $sql = "SELECT COUNT(*) FROM `{$this->table}` 
            WHERE `{$this->fk_column}` = '{$entries_id}';";
            $count_of_values = $this->execQuery($sql)->fetchColumn();
            return $count_of_values > 0; 
        }

        public function addTodoAction(array $todo_info){
            $this->addEntry($todo_info, $this->table);
        }

        public function deleteTodoAction(int $entries_id){
            $this->deleteEntry($entries_id, $this->table, $this->fk_column);
        }
        public function getCountOfButtonsAction(array $options){
            $sql = "SELECT * FROM `{$this->table}`;";
            $all_todoes = $this->execQuery($sql)->fetchAll();
            if(empty($all_todoes)){
                return array();
            }
            return range(1, count(array_chunk($all_todoes, $options['entries_limit'])));
        }
        public function getPaginatedTodosAction(array $options){
            $offset = ($options['page_num'] - 1)*$options['entries_limit'] ;
            $sql = "SELECT * FROM `{$this->table}` ORDER BY `{$this->table}`.`todo_id`
            ASC LIMIT {$options['entries_limit']} OFFSET {$offset};";
            return $this->execQuery($sql)->fetchAll();
        }

        public function changeStatus(int $entries_id, string $todo_status){
            $sql = "UPDATE `{$this->table}` SET `todo_status` = '{$todo_status}' 
                    WHERE `{$this->table}`.`{$this->fk_column}` = {$entries_id};";
            $this->execQuery($sql);

        }






    }
    ?>

