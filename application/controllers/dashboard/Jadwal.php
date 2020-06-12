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
		$data['query_mysql'] = $this->db->query("SELECT tj.id, tb.nama as nama_guru, tj.hari, tj.jam, tm.nama as mapel, tk.nama as kelas FROM tb_jadwal tj JOIN tb_guru tb ON tj.nip=tb.nip JOIN tb_mapel tm ON tj.id_mapel=tm.id JOIN tb_kelas tk ON tk.id=tj.id_kelas")->result_array();
        $this->load->view('backend/index',$data);
    }
	
	public function add()
	{
		$data['title'] = "Tambah $this->cap";
		$data['content'] = "$this->low/_form";
		$data['data'] = null;
		$data['q'] = $this->db->query("SELECT * FROM tb_guru")->result_array();
		$data['query_mysql'] = $this->db->query("SELECT * FROM tb_kelas")->result_array();
		$data['qq'] = $this->db->query("SELECT * FROM tb_mapel")->result_array();
		$data['type'] = 'Tambah';
		$this->load->view('backend/index',$data);
		// Response_Helper::render('backend/index', $data);
	}
	public function store(){
		$d = $_POST;
		$f = $_FILES;
		try{
			
			$this->db->insert("$this->low",$d);
			$this->session->set_flashdata("message", ['success', "Berhasil Tambah $this->cap", ' Berhasil']);
			redirect(base_url("dashboard/jadwal/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Tambah Data $this->cap", ' Gagal']);
			redirect(base_url("dashboard/jadwal/add"));
			// $this->add();
		}
	}
		
	public function edit($id){
		$data['title'] = "Ubah $this->cap";
		$data['content'] = "$this->low/_form";
		$data['type'] = 'Ubah';
		$data['q'] = $this->db->query("SELECT * FROM tb_guru")->result_array();
		$data['query_mysql'] = $this->db->query("SELECT * FROM tb_kelas")->result_array();
		$data['qq'] = $this->db->query("SELECT * FROM tb_mapel")->result_array();
		$data['data'] = $this->db->get_where("$this->low", ['id' => $id])->row_array();		
		$this->load->view('backend/index',$data);
	}
	public function detail($id){
		$data['title'] = "Detail $this->cap";
		$data['content'] = "$this->low/_detail";
		$data['type'] = 'Ubah';
		$data['kelas'] = $this->db->get("tb_kelas")->result_array();
		$data['data'] = $this->db->get_where("$this->low", ['id' => $id])->row_array();		
		$this->load->view('backend/index',$data);
	}
	
	public function update($id){
		$d = $_POST;
		try{
			
			$arr = [
				'nip' => $d['nip'],
				'id_kelas' => $d['id_kelas'],
				'id_mapel' => $d['id_mapel'],
				'hari' => $d['hari'],
				'jam' => $d['jam']
			  ];
			//   echo "<pre>";
			//   print_r($arr);
			$this->session->set_flashdata("message", ['success', "Ubah $this->cap Berhasil", ' Berhasil']);
			$this->db->update("$this->low",$arr, ['id' => $id]);
			redirect(base_url("dashboard/jadwal/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Edit Data $this->cap", ' Gagal']);
			redirect(base_url("dashboard/jadwal/edit/".$id));
			// $this->add();
		}
	}
		
	public function delete($id){
		try{
			$this->db->delete("$this->low", ['id' => $id]);
			$this->session->set_flashdata("message", ['success', "Berhasil Hapus Data $this->cap", 'Berhasil']);
			redirect(base_url("dashboard/jadwal/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Hapus Data $this->cap", 'Gagal']);
			redirect(base_url("dashboard/jadwal/"));
		}
	}
}
