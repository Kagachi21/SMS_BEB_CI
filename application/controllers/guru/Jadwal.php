<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Jadwal extends CI_Controller {
	function __construct()
  	{
		parent::__construct();
		// Auth_helper::secure();
		$this->low = "tb_jadwal";
		$this->cap = "Jadwal";
		date_default_timezone_set('Asia/Jakarta');
		// if(!isset($_SESSION['kode_user'])){
		// 	redirect(base_url());
		// }
		if($this->uri->segment(3) == "add" && $_SERVER['REQUEST_METHOD'] == "POST"){
		  $this->store($this->uri->segment(4));
		}else if($this->uri->segment(3) == "edit" && $_SERVER['REQUEST_METHOD'] == "POST"){
		  $this->update($this->uri->segment(4), $this->uri->segment(5));
		}
    }
    
    public function index(){
		$data['title'] = "Data $this->low";
        $data['content'] = "$this->low/index";
        $d = $_POST;
        $where = "";
        $d = $_POST;
        $data['kelas'] = $this->db->get("tb_kelas")->result_array();
		$data['list'] = $this->db->query("SELECT tj.id, tb.nama as nama_guru, tj.hari, tj.jam, tm.nama as mapel, tk.nama as kelas FROM tb_jadwal tj JOIN tb_guru tb ON tj.nip=tb.nip JOIN tb_mapel tm ON tj.id_mapel=tm.id JOIN tb_kelas tk ON tk.id=tj.id_kelas WHERE tj.nip='$_SESSION[nip]'")->result_array();
        $this->load->view('guru/index',$data);
    }
	
}
