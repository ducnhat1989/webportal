<?php 

/** 
 * Description of My_Exceptions 
 * 
 * @author Truong Chuong Duong 
 * @email truong@chuongduong.net 
 * @website http://www.chuongduong.net 
 */ 
class MY_Exceptions extends CI_Exceptions 
{ 

    /** 
     * Controller 
     * 
     * @access public 
     */ 
    var $folder_error;

    function MY_Exceptions() 
    { 
      parent::__construct(); 
      $this->folder_error = "error_logs/";
    } 

    /** 
     * General Error Page 
     * 
     * @access    private 
     * @param    string    disabled - there to keep ci happy 
     * @param    string    ditto for this one 
     * @param    string    the error function name 
     * @return    string 
     */ 
    function show_error($heading, $message, $template = 'error_general', $status_code = 404) 
    { 
      //Ghi lại nhật ký lỗi 
      if (!is_dir($this->folder_error)) {
        mkdir($this->folder_error,0777,true);         
      }
      $log = FCPATH . $this->folder_error . date("Y-m-d") . "-" . $template . ".log"; 
      $date = new DateTime(); 
      $date = $date->format('Y-m-d H:i:s'); 
      $text = ""; 
      $text .= "\n>>> FOUND ERROR at $date <<<"; 
      $text .= "\n\t\tHeading: $heading"; 
      $text .= "\n\t\tMessage: " . $message; 
      $text .= "\n\t\tError code: $template"; 
      $text .= "\n\t\tError number: $status_code"; 
      $text .= "\n\t\tServer info: " . var_export($_SERVER, true); 
      if (!empty($_REQUEST)) 
        $text .= "\n\t\tRequest info: " . var_export($_REQUEST, true); 
      if (!empty($_POST)) 
        $text .= "\n\t\tPost value: " . var_export($_POST, true); 
      if (!empty($_GET)) 
        $text .= "\n\t\tGet value: " . var_export($_GET, true); 
      $text .= "\n>>> END ERROR at $date <<<\n"; 
      $f = fopen($log, "a"); 
      fwrite($f, $text); 
      fclose($f); 
      //kết thúc việc ghi nhật ký lỗi 
      if (ENVIRONMENT !== 'development')//Nếu website của bạn không phải đang hoạt động ở chế độ debug thì thay đổi báo lỗi để người dùng không biết thực sự lỗi là gì, điều này rất hữu ích cho việc bảo mật website của bạn 
      { 
        $heading = "Server Errors"; 
        $message = "Not found"; 
      }
      return parent::show_error($heading, $message, $template, $status_code);//Trả về nội dung để hiển thị cho lỗi tương ứng 
    } 

}