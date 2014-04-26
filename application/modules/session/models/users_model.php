<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends MY_Model { 
  
  protected $table = "users";
  protected $primary_key = "id";
  protected $fields = array("id", "username", 
    "password", "email", "fullname", "created_at");

  public $before_create = array('timestamps');

  $this->validate = array(
      array(
         'field'   => 'username',
         'label'   => 'Username',
         'rules'   => 'trim|required'
      ),
      array(
         'field'   => 'password',
         'label'   => 'Password',
         'rules'   => 'trim|required'
      ),
      array(
         'field'   => 'email',
         'label'   => 'Email',
         'rules'   => 'trim|email'
      )
    );

  public function __construct(){
    parent::__construct(); 
  } 

  function timestamps($user){
    // $user['created_at'] = date('Y-m-d H:i:s');
  	 $user['created_at'] = time();
    return $user;
  }
} 