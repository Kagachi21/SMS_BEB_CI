<?php
class datamodel extends CI_Model { //mengextands CI_Model
public function getData(){
  $Data =array (
      'nama'=>'rubi',
       'status'=>'mahasiswa',
       'website'=>'http://RUBI.II',);
  RETURN $Data; 
}
}
?>