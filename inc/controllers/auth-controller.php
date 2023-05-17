<?php
class Auth_Controller{
    public $errors;
    public $todo_auth;
    public function __construct($todo_auth, $errors){
        $this->todo_auth = $todo_auth;
        $this->errors = $errors;
    }

    public function render_auth_action(){
        if(!$_SESSION['user_id']){
            $tamplate_data = [
                'errors' => $this->errors, 
            ];
            render('auth', $tamplate_data); 
        }
    }
    public function login_action(){
        $user_name = strip_tags($_POST['user_login']);
        $password = $_POST['user_password'];
        if ($this->todo_auth->check_password($password, $user_name)){
            if(!$this->errors->has_errors()){
                $user_id = $this->todo_auth->get_user_id($user_name);
                $this->todo_auth->log_in($user_id);
                $this->errors->set_message("You successfully logined!");
                redirect();
            }
            
        } else {
            $this->errors->set_error('Invalid password!');
            redirect('?action=auth');
        }      
    }

    public function add_user_action(){
        if (!$this->todo_auth->is_logged_in()){
            $user_name = htmlspecialchars($_POST['user_name']);
            $password = htmlspecialchars($_POST['user_password']);
            $password_repeat = htmlspecialchars($_POST['user_password_repeat']);
            $user_existense = $this->todo_auth->is_user_exist($user_name);
            if($user_existense == 1){
                $this->errors->set_error("Username is used.");
                redirect('?action=auth');
            }
            else if ((strlen($user_name) < 5) or (strlen($user_name) > 20)){
                $this->errors->set_error('The required login is more than 5 characters or less then 20 chars.');
                redirect('?action=auth');
            }
            else if((strlen($password ) < 5) or (strlen($password ) > 25)){
                $this->errors->set_error('Bad password. The required password is more than 5 characters and lesser then 25 chars. ');
                redirect('?action=auth');
            } 
            else if($password != $password_repeat){
                $this->errors->set_error("Passwords don't match");
                redirect('?action=auth');
            }
            else if(!$this->errors::has_errors()){
                $user_id = $this->todo_auth->add_user($user_name, $password);
                $this->todo_auth->log_in($user_id);
                $this->errors->set_message("Register complete! You auto logined and redirected to main page.");
                redirect();
            } else{
                redirect('?action=auth');
            }
        } else {
            $this->errors->set_error("User is logged in.");
            redirect();
        }
    }

    public function log_out(){
        if($this->todo_auth->is_logged_in()){
            $this->todo_auth->log_out();
        }
        redirect();
    }


}




?>