<?php
class Users extends Controller{

  public function __construct(){
    //This where you can load a model
    $this->userModel = $this->model('User');
  }

  public function profile($id){
    $user = $this->userModel->findUserById($id);
    $postNum = $this->userModel->numberOfPosts($id);

    $data = [
      'id' => $id,
      'user_name' => $user->name,
      'user_email' => $user->email,
      'user_post_num' => $postNum
    ];

    $this->view('users/profile', $data);
  }
  public function register(){
    //Check for POST request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      //Process the form
      // ====================== //

      //Sanatize _POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [
        'name' => trim($_POST['name']),
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'comfirm_password' => trim($_POST['comfirm-password']),
        'name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'comfirm_password_err' => ''
      ];

      //Validate email
      if(empty($data['email'])){
        $data['email_err'] = 'Please enter email';
      }else{
        //check email
        if($this->userModel->findUserByEmail($data['email'])){
          $data['email_err'] = 'This email already has an account';
        }
      }

      //Validate name
      if(empty($data['name'])){
        $data['name_err'] = 'Please enter your name';
      }

      //Validate password
      if(empty($data['password'])){
        $data['password_err'] = 'Please enter a password';
      }elseif(strlen($data['password']) < 6){
        $data['password_err'] = 'Your password must be above 5 characters';
      }

      //Validate comfirm password
      if(empty($data['comfirm_password'])){
        $data['comfirm_password_err'] = "Please comfirm your password";
      }elseif($data['comfirm_password'] != $data['password']){
        $data['comfirm_password_err'] = "Your passwords don't match";
      }

      //make sure errs are empty
      if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['comfirm_password_err'])){
        //validated!
        
        //Hash the password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        //Register user
        if($this->userModel->register($data)){
          flash('register_sucess', 'You are registerd and can login!');
          redirect('/users/login');
        }else{
          die('something went wrong');
        }
        

      }else{
        //load view with errors
        return $this->view('users/register', $data);
      }
      
    }else{
      //Render the form
      // ====================== //

      //Init data
      $data = [
        'name' => '',
        'email' => '',
        'password' => '',
        'comfirm_password' => '',
        'name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'comfirm_password_err' => ''
      ];

      //Load View
      return $this->view('users/register', $data);
    }
  }

  public function login(){

     //Check for POST request
     if($_SERVER['REQUEST_METHOD'] == 'POST'){
      //Process the form
      //Sanatize _POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'email_err' => '',
        'password_err' => '',
      ];

      //Validate email
      if(empty($data['email'])){
        $data['email_err'] = 'Please enter email';
      }

      //Validate password
      if(empty($data['password'])){
        $data['password_err'] = 'Please enter a password';
      }elseif(strlen($data['password']) < 6){
        $data['password_err'] = 'Your password must be above 5 characters';
      }

      //Make sure the user exsits
      if($this->userModel->findUserByEmail($data['email'])){
        //user found
        
      }else{
        //user not found
        $data['email_err'] = 'This email does not have an account, please register';
      }

      //make sure errs are empty
      if(empty($data['email_err']) && empty($data['password_err'])){
        //validated!
        //check and set logged user
        $loggedInUser = $this->userModel->login($data['email'], $data['password']);

        if($loggedInUser){
          //create session
          $this->createUserSession($loggedInUser);
        }else{
          $data['password_err'] = "Your password was not correct";
          return $this->view('users/login', $data);
        }
      }else{
        //load view with errors
        return $this->view('users/login', $data);
      }

    }else{
      //Render the form
      // ====================== //

      //Init data
      $data = [
        'email' => '',
        'password' => '',
        'email_err' => '',
        'password_err' => '',
      ];

      return $this->view('users/login', $data);
    }
  }

  public function logout(){
    //get rid of all user session vars
    unset($_SESSION['user_id']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    //Get rid of all other session vars
    session_destroy();
    redirect("/users/login");
  }

  public function createUserSession($user){
    $_SESSION['user_id'] = $user->id;
    $_SESSION['user_email'] = $user->email;
    $_SESSION['user_name'] = $user->name;
    redirect("/posts");
  }

  public function isLoggedIn(){
    if(isset($_SESSION['user_id'])){
      return true;
    }else{
      return false;
    }
  }
}