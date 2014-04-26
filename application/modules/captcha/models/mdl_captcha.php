<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_captcha extends CI_Model {
  function __construct() {
    parent::__construct();
  }

  function get_table() {
    $table = "captcha";
    return $table;
  }
    
  /*
  *************************
  *** Install & Uninstall
  *************************
  */
  public function up()
  {	
    $fields = array(
      'id' => array(
        'type' => 'BIGINT',
        'constraint' => 13,
        'unsigned' => TRUE,
        'auto_increment' => TRUE,
      ),
      'captcha_time' => array(
        'type' => 'INT',
        'constraint' => '10',
      ),
      'ip_address' => array(
        'type' => 'VARCHAR',
        'constraint' => '16',
      ),
      'word' => array(
       'type' => 'VARCHAR',
       'constraint' => '20',
      )
    );
    $this->load->dbforge();
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->add_field($fields);

    return $this->dbforge->create_table($this->get_table(), TRUE);
  }

  public function down()
  {
    $this->load->dbforge();
    return $this->dbforge->drop_table($this->get_table());
  }

  public function _insert($data){
    $table = $this->get_table();
    $this->db->insert($table, $data);
  }

  public function _delete_captcha($expiration){
    $table = $this->get_table();
    $this->db->where('captcha_time <', $expiration);
    $this->db->delete($table);
  }
}