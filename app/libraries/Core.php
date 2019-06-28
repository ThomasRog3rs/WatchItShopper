<?php
  /*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   * This is like the route.config file in ASP.NET (I think)? probably not actually
   */
  class Core {
    //set the defaults for the properties
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
      //Store the url from the method into a variable
      $url = $this->getUrl();

      // Look in controllers for index 0 of the url.
      // In file_exists the path is from index.php because everything is routed through index.php from the .htaccess file
      if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
        // If controller exsist then make it the current controller
        $this->currentController = ucwords($url[0]);
        // Unset the 0 index so only params are left over after the controler and method
        unset($url[0]);
      }

      //Require the current controller
      require_once '../app/controllers/'. $this->currentController . '.php';

      //Instanciate controller class
      $this->currentController = new $this->currentController;

      //Check for second part of url (the method)
      if(isset($url[1])){
        // cheak if method exsists in controller
        if(method_exists($this->currentController, $url[1])){
          //then set the current method
          $this->currentMethod = $url[1];
          unset($url[1]);
        }
      }

      // Get params
      $this->params = $url ? array_values($url) : [];

      // Call a callback with an array of params
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);


    }

    public function getUrl(){
      //see if url is set
      if(isset($_GET['url'])){
        //get rid of trailing slash
        $url = rtrim($_GET['url'], '/');
        //Make sure it is a valid url
        $url = filter_var($url, FILTER_SANITIZE_URL);
        //split it all into an array
        $url = explode('/',$url);
        return $url;
      }   
    }
  } 
  
  