<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Session extends MX_Controller {
    
  public function __construct() {
    parent::__construct();
    $this->template->add_css("css/bootstrap.min.css");
    $this->template->add_css("font-awesome/css/font-awesome.css");
    $this->template->add_css("css/sb-admin.css");

    $this->template->add_js("js/jquery-1.10.2.js");
    $this->template->add_js("js/bootstrap.min.js");
    $this->template->add_js("js/plugins/metisMenu/jquery.metisMenu.js");
    $this->template->add_js("js/sb-admin.js");
  }

  public function create(){
    switch ($this->input->server('REQUEST_METHOD')){
      case 'GET':
        $this->template->write("title","Login",TRUE);
        $this->template->write_view("login","login");
        $this->template->render();
        break;
      default:
        break;
    }
  }
}