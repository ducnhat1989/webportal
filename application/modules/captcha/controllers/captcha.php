<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Captcha extends MX_Controller {
    
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function showCaptcha($config = ''){
    $this->load->helper('captcha');
    if(is_array($config) && count($config) > 0){
      $vals = $config;
    }
    $path = FCPATH.'captcha/';

    if(!is_dir($path)) //create the folder if it's not already exists
    {
      if (!mkdir($path, 0777, true)) {//0777
        die('Failed to create folders...');
      }
    } 
    $vals['img_path'] = './public/captcha/';
    $vals['img_url'] = base_url().'public/captcha/';
            
    $cap = create_captcha($vals);
    if($cap){
      $data = array(
          'captcha_time'	=> $cap['time'],
          'ip_address'	=> $this->input->ip_address(),
          'word'	 => $cap['word']
      );
      
      $this->_insert($data);
      
      echo '<div class="captcha">';
      echo lang("admin_captcha_text","captcha_lb");
      echo $cap['image'];
      echo '<input type="text" name="captcha" value="" />';
      echo '</div>';
    }else{
      echo "Not captcha";
    }
  }

  public function checkCaptcha($input){
    // First, delete old captchas
    $expiration = time()-7200; // Two hour limit
    $this->_delete_captcha($expiration);	
    
    // Then see if a captcha exists:
    $sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
    $binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
    $query = $this->db->query($sql, $binds);
    $row = $query->row();
    
    if ($row->count == 0)
    {
      return false;
    }
    else{
      return true;
    }
  }

  public function _insert($data){
    $this->load->model('mdl_captcha');
    $this->mdl_captcha->_insert($data);
  }

  public function _delete_captcha($expiration = ''){
    if('' === $expiration){
      $expiration = time()-7200; // Two hour limit
    }
    $this->load->model('mdl_captcha');
    $this->mdl_captcha->_delete_captcha($expiration);
  }
    
  public function install(){
    $this->load->model('mdl_captcha');
    if ($this->mdl_captcha->up())
    {
      echo "Captcha table is installed.";
    }
    else
    {
      show_error("Captcha table is not installed");
    }
  }

  public function uninstall(){
    $this->load->model('mdl_captcha');
    if ($this->mdl_captcha->down())
    {
      echo "Captcha table is uninstalled.";
    }
    else
    {
      show_error("Captcha table is not uninstalled");
    }
  }
}