<?php
  class User{
    private $db;

    public function __construct(){
      $this->db = new Database();
    }

    //Register userr
    public function register($data){
      $this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
      //Bind Values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);

      //Execute
      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
    }

    //Login user
    public function login($email, $password){
      $this->db->query('SELECT * FROM users WHERE email = :email');
      //Bind Values 
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      $hashed_password = $row->password;

      if(password_verify($password, $hashed_password)){
        return $row;
      }else{
        return false;
      }
      
    }

    //find user by email
    public function findUserByEmail($email){
      $this->db->query('SELECT * FROM users WHERE email = :email '); 
      //Bind Values 
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      //Check row
      if($this->db->rowCount() > 0){
        return true;
      }else{
        return false;
      }
    }

    public function findUserById($id){
      $this->db->query('SELECT * FROM users WHERE id = :id');
      //Bind values
      $this->db->bind(':id', $id);
      //Get Row
      $row = $this->db->single();
      //Return Row
      return $row;
    }

    public function numberOfPosts($id){
      $this->db->query('SELECT * FROM posts WHERE user_id = :id '); 
      //Bind Values 
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $this->db->rowCount();
    }
  }