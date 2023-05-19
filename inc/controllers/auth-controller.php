<?php
class Auth_Controller{

    public $todo_auth;
    public function __construct($todo_auth){
        $this->todo_auth = $todo_auth;
    }

    public function render_login_action(){
        if(!$this->todo_auth->is_logged_in()){
            render('auth'); 
        }
    }
    public function login_action(){
        if (!$this->todo_auth->is_logged_in()){
            $user_name = strip_tags($_POST['user_login']);
            $password = $_POST['user_password'];
            if ($this->todo_auth->check_password($password, $user_name)){
                if(!Errors::has_errors()){
                    $user_id = $this->todo_auth->get_user_id($user_name);
                    $this->todo_auth->log_in($user_id);
                    Errors::set_message("You successfully logined!");
                    redirect();
                }
                
            } else {
                Errors::add_error('Invalid password!');
                redirect('?action=auth');
            }      
        } else {
            Errors::add_error("User is logged in.");
            redirect();
        }
    }

    public function add_user_action(){
        if (!$this->todo_auth->is_logged_in()){
            $user_name = htmlspecialchars($_POST['user_name']);
            $password = htmlspecialchars($_POST['user_password']);
            $password_repeat = htmlspecialchars($_POST['user_password_repeat']);
            $user_existense = $this->todo_auth->is_user_exist($user_name);
            if($user_existense == 1){
                Errors::add_error("Username is used.");
                redirect('?action=auth');
            }
            else if ((strlen($user_name) < 5) or (strlen($user_name) > 20)){
                Errors::add_error('The required login is more than 5 characters or less then 20 chars.');
                redirect('?action=auth');
            }
            else if((strlen($password ) < 5) or (strlen($password ) > 25)){
                Errors::add_error('Bad password. The required password is more than 5 characters and lesser then 25 chars. ');
                redirect('?action=auth');
            } 
            else if($password != $password_repeat){
                Errors::add_error("Passwords don't match");
                redirect('?action=auth');
            }
            else if(!Errors::has_errors()){
                $user_id = $this->todo_auth->add_user($user_name, $password);
                $this->todo_auth->log_in($user_id);
                Errors::set_message("Register complete! You auto logined and redirected to main page.");
                redirect();
            } else{
                redirect('?action=auth');
            }
        } else {
            Errors::add_error("User is logged in.");
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