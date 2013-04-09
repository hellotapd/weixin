<?php
class DicManage{
  var $dic_with_name_as_key = Array();
  var $dic_with_id_as_key = Array();
  
  function _check_promession() {
  
  }
  
  function add_term_into_dic() {
  
  }
  
  function find_term_from_dic() {
  
  }
  
  function del_term_from_dic() {
  
  }
  
  function update_term_from_dic() {
  
  }
  
  function _get_dictionary_into_arr() {
  	$dicfile = dirname(__FILE__)."/ppldic.csv"; 
  	$fp = fopen($dicfile,'r');
  	while($line = fgets($fp,256)){
  	  $ws = explode(' ',$line);
  	  $this->dic_with_name_as_key[$ws[0]] = $ws;
  	  $this->dic_with_id_as_key[$ws[1]] = $ws;
  	}
  	fclose($fp); 
  }
}

?>
