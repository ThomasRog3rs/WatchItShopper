<?php 
  class Posts extends Controller{
    public function __construct(){
      if(!isset($_SESSION['user_id'])){
        redirect('/users/login');
      }

      $this->postModel = $this->model('Post');
    }

    public function index(){
      //get posts
      $posts = $this->postModel->getPosts();
      $data = [
        'posts' => $posts
      ];

      $this->view("posts/index", $data);
    }

    public function add(){
      if($_SERVER["REQUEST_METHOD"] == 'POST'){
        //clean post
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'title' => trim($_POST['title']),
          'body' => trim($_POST['body']),
          'price' => trim($_POST['price']),
          'user_id' => $_SESSION['user_id'],
          'title_err' => '',
          'body_err' => '',
          'price_err' => ''
        ];

        if(empty($data['title'])){
          $data['title_err'] = "Please enter tilte";
        };

        if(empty($data['body'])){
          $data['body_err'] = "Please enter body text";
        };

        //Make sure no errors
        if(empty($data['tilte_err']) && empty($data['body_err'])){
          //no error :)
          if($this->postModel->addPost($data)){
            flash('post_message', 'Post added');
            redirect('/pages');
          }else{
            die('something went wrong :/');
          }
        }else{
          $this->view("posts/add", $data);
        }
      }else{
        $data = [
          'title' => '',
          'body' => ''
        ];
      }
      $this->view("posts/add", $data);
    }
    
    public function edit($id){
      if($_SERVER["REQUEST_METHOD"] == 'POST'){
        //clean post
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $post = $this->postModel->getPostById($id);
        $data = [
          'title' => trim($_POST['title']),
          'body' => trim($_POST['body']),
          'price' => trim($_POST['price']),
          'user_id' => $_SESSION['user_id'],
          'post_id' => $post->id,
          'title_err' => '',
          'body_err' => '',
          'price_err' => ''
        ];

        if(empty($data['title'])){
          $data['title_err'] = "Please enter tilte";
        };

        if(empty($data['body'])){
          $data['body_err'] = "Please enter body text";
        };

        //Make sure no errors
        if(empty($data['tilte_err']) && empty($data['body_err'])){
          //no error :)
          if($this->postModel->editPost($data)){
            flash('post_message', 'Post updated!');
            redirect('/pages');
          }else{
            die('something went wrong :/');
          }
        }else{
          $this->view("posts/edit", $data);
        }
      }else{
        $post = $this->postModel->getPostById($id);

        if($post->user_id != $_SESSION["user_id"]){
          redirect('/posts/show/'.$post->id.'/');
        }

        $data = [
          'title' => $post->title,
          'body' => $post->body,
          'price' => $post->price,
          'post_id' => $post->id
        ];
      }
      $this->view("posts/edit", $data);
    }

    public function delete($id){
      if($_SERVER["REQUEST_METHOD"] == 'POST'){
        if($this->postModel->deletePost($id)){
          flash('post_message', 'Post Removed!');
          redirect('/posts');
        }else{
          die('Something went wrong!');
        }
      }else{
        redirect('/posts/show/'.$id);
      }
    }

    public function show($id){
      $post = $this->postModel->getPostById($id);
      $user = $this->postModel->getUserById($post->user_id);
      $data = [
        "post" => $post,
        "user" => $user
      ];

      $this->view("posts/show", $data);
    }
  }