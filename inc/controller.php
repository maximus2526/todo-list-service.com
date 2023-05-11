<?php

class TodoController{
    public $modelobj;
    public $todo_id;
    public $todo_item;
    public $limit_per_page;
    public $tamplate_data;

    public function __construct($modelobj){
        session_start();
        $this->limit_per_page = 10;
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
            'todoes' => $this->modelobj->getPaginatedTodosAction($page_options),
            'pages' => $this->modelobj->getCountOfButtonsAction($page_options), 
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

    public function addTodo(){
        $params = [
            'user' => 'admin',
            'todo_status' => 'complete',
            'todo_item' => strip_tags($this->todo_item)
        ]; 
        
        if(strlen($this->todo_item) > 100){
            $this->setError('Your todo greater then 100 chars!');
            header("Location: /");      
        } elseif(strlen($this->todo_item) < 4) {
            $this->setError('Your todo lesser then 4 chars! Type more!');
            header("Location: /"); 
        }
        else {
            $this->modelobj->addTodoAction($params);
            header("Location: /");
        }
    }
    
    public function changeStatus(string $todo_status){
        $this->fkeyCheck();
        if(empty($_SESSION['errors']))
            $this->modelobj->changeStatus($this->todo_id, $todo_status);
        header("Location: /");
    }
    
    public function delTodos(){
        $this->fkeyCheck();

        if(empty($_SESSION['errors']))
            $this->modelobj->deleteTodoAction($this->todo_id);
        header("Location: /");
            
    }



}

class AuthController{

}

$todo_model = new ToDoActions();
$controller = new TodoController($todo_model);

?>

