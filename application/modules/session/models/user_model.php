<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends MY_Model { 
  
  protected $_table = "users";
  protected $primary_key = "id";
  protected $fields = array("id", "username", 
    "password", "email", "fullname", "created_at");

  public $before_create = array('timestamps');

  public $validate = array(
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
         'rules'   => 'trim|valid_email'
      )
    );

  public function __construct(){
    parent::__construct(); 
  } 

  protected function timestamps($user){
    // $user['created_at'] = date('Y-m-d H:i:s');
    $user['created_at'] = time();
    return $user;
  }
} 