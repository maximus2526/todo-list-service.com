<?php

class TodoController{
    public $modelobj;
    public $todo_id;
    public $todo_item;
    public $limit_per_page;
    public $tamplate_data;

    public function __construct($modelobj){
        session_start();
        $this->limit_per_page = 5;
        $this->modelobj = $modelobj;
        $this->todo_id = $_GET['todo_id'];
        $this->todo_item = $_POST['todo_item'];
        $this->setTamplateData();
        
    }

    private function fkeyCheck(){
        if(!$this->modelobj->isEntryExist($this->todo_id))
            $this->setError($this->todo_id.'- entry does not exist!');
    }
    private function setTamplateData(){
        $page_num = !$_GET['page_num'] ? 1 : $_GET['page_num'];
        $page_options = [
            'page_num' => $page_num,
            'entries_limit' => $this->limit_per_page,
        ];
        $this->tamplate_data = [
            'todoes' => $this->modelobj->getPaginatedTodos($page_options),
            'pages' => $this->modelobj->getCountOfButtons(), 
        ];
    }

    public function setError(string $error){
        $_SESSION['errors'][] = $error;
    }

    public function renderMainPage(){
        render('todos', $this->tamplate_data); 
    }

    public function renderAbout(){
        render('about'); 
    }

    public function renderAuth(){
        render('auth'); 
    }

    public function addTodoAction(){
        $params = [
            'user' => 'admin',
            'todo_status' => 'complete',
            'todo_item' => strip_tags($this->todo_item)
        ]; 
       

        if(empty($this->todo_item)){
            $this->setError('Do not typed any text!');
            header("Location: /");      
        }
        else {
            $this->modelobj->addTodo($params);
            header("Location: /");
        }
    }
    
    public function changeStatusAction(string $todo_status){
        $this->fkeyCheck();
        if(empty($_SESSION['errors']))
            $this->modelobj->changeStatus($this->todo_id, $todo_status);
        header("Location: /");
    }
    
    public function delTodosAction(){
        $this->fkeyCheck();
        if(empty($_SESSION['errors']))
            $this->modelobj->deleteTodo($this->todo_id);
        header("Location: /");
            
    }



}

$todo_model = new ToDoActions();
$controller = new TodoController($todo_model);

?>

