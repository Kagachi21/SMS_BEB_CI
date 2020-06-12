<?php
class Pembayaran extends CI_Controller { //mengextends CI_Controller 
    public function __construct(){
        parent::__construct();
    }
    public function pembayaran() {
        $data['title'] = "Absen";
        $nis = $_SESSION['nis'];
        $data['content'] = "pembayaran/pembayaran";
        $data['querykasus'] = $this->db->query("SELECT * FROM tb_pembayaran WHERE nis='$nis'")->result_array();
		$this->load->view('user/index',$data);

    }
}
?>