<?php

class Users  extends Controller{
    public function __construct(){
        $this->userModel = $this->model('User');
    }
    public function index(){

    }
    
    public function register(){
        //check request type
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //sanitize post data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'name' => trim($_POST['name']),
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'confirm_password' => trim($_POST['confirm_password']),
            'name_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => ''
        ];

        if(empty($data['name'])){
            $data['name_err'] = 'Please enter name';
        }
        if(empty($data['email'])){
            $data['email_err'] = 'Please enter email';
        }else{
            //check email
            if($this->userModel->findUserByEmail($data['email'])){
                $data['email_err'] = 'Email is already taken';
            }
        }

         if(empty($data['password'])){
            $data['password_err'] = 'Please enter password';
        }else if (strlen($data['password']) < 6) {
            $data['password_err'] = 'Password must be at least 6 characters';
        }
        if(empty($data['confirm_password'])){
            $data['confirm_password_err'] = 'Please confirm password';
        }else if($data['password'] != $data['confirm_password']){
            $data['confirm_password_err'] = 'Passwords do not match';
        }   
      if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        //register user
        if($this->userModel->register($data)){
            flash('register_success', 'You are now registered and can log in');
            redirect('users/login');
        } else {
            die('Something went wrong');
        }
        }  else{
            //load view with errors
            $this->view('users/register', $data);
            }   
      } 
      else{
        //show register form
        $data = [
            'name' => '',
            'email' => '',
            'password' => '',
            'confirm_password' => '',
            'name_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => ''
        ];
        $this->view('users/register', $data);
    }
    }

    public function login(){
        //check request type
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
       $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'email_err' => '',
            'password_err' => '',

        ];

        if(empty($data['email'])){
            $data['email_err'] = 'Please enter email';
        }
         if(empty($data['password'])){
            $data['password_err'] = 'Please enter password';
        }else if (strlen($data['password']) < 6) {
            $data['password_err'] = 'Password must be at least 6 characters';
        } 
      if(empty($data['email_err']) && empty($data['password_err'])){
          die('validation passed');
        }  else{
            //load view with errors
            $this->view('users/login', $data);
            }   
      
      }  else{
        //show login form
        $data = [
            'email' => '',
            'password' => '',
            'email_err' => '',
            'password_err' => '',
        ];
        $this->view('users/login', $data);
    }
    }
}