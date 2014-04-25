<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
 public function __construct(){
   parent::__construct();
   $this->template->add_css("css/bootstrap.min.css");
   $this->template->add_css("font-awesome/css/font-awesome.css");
   $this->template->add_css("css/plugins/morris/morris-0.4.3.min.css");
   $this->template->add_css("css/plugins/timeline/timeline.css");
   $this->template->add_css("css/sb-admin.css");

   $this->template->add_js("js/jquery-1.10.2.js");
   $this->template->add_js("js/bootstrap.min.js");
   $this->template->add_js("js/plugins/metisMenu/jquery.metisMenu.js");
   $this->template->add_js("js/plugins/morris/raphael-2.1.0.min.js");
   $this->template->add_js("js/plugins/morris/morris.js");
   $this->template->add_js("js/sb-admin.js");
   $this->template->add_js("js/demo/dashboard-demo.js");

   $this->template->write_layout("navbar_header","navbar_header");
   $this->template->write_layout("navbar_top_links","navbar_top_links");
   $this->template->write_layout("navbar_static_side","navbar_static_side");
 }

 public function index()
 {
   $this->template->write("title","Welcome",TRUE);
   $this->template->render(); 
 }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */