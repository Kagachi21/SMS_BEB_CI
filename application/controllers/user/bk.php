<?php
class Bk extends CI_Controller { //mengextends CI_Controller 
    public function __construct(){
        parent::__construct();
    }
    public function bk () {
        $data['title'] = "Absen";
        $nis = $_SESSION['nis'];
        $data['content'] = "bk/bk";
        $data['querykasus'] = $this->db->query("SELECT * FROM tb_bk WHERE nis='$nis'")->result_array();
		$this->load->view('user/index',$data);

    }
}
?>