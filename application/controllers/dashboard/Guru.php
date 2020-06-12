<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Guru extends CI_Controller {
	function __construct()
  	{
		parent::__construct();
		// Auth_helper::secure();
		$this->low = "tb_guru";
		$this->cap = "Guru";
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
		$data['query_mysql'] = $this->db->query("SELECT * FROM tb_guru")->result_array();
        $this->load->view('backend/index',$data);
    }
	
	public function add()
	{
		$data['title'] = "Tambah $this->cap";
		$data['content'] = "$this->low/_form";
		$data['data'] = null;
		$data['kelas'] = $this->db->get("tb_kelas")->result_array();
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
			redirect(base_url("dashboard/guru/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Tambah Data $this->cap", ' Gagal']);
			redirect(base_url("dashboard/guru/add"));
			// $this->add();
		}
	}
		
	public function edit($id){
		$data['title'] = "Ubah $this->cap";
		$data['content'] = "$this->low/_form";
		$data['type'] = 'Ubah';
		$data['data'] = $this->db->get_where("$this->low", ['id' => $id])->row_array();		
		$this->load->view('backend/index',$data);
	}
	public function detail($id){
		$data['title'] = "Detail $this->cap";
		$data['content'] = "$this->low/_detail";
		$data['type'] = 'Ubah';
		$data['kelas'] = $this->db->get("tb_kelas")->result_array();
		$data['data'] = $this->db->get_where("$this->low", ['nis' => $id])->row_array();		
		$this->load->view('backend/index',$data);
	}
	
	public function update($id){
		$d = $_POST;
		try{
			
            $arr = [
                'nip' => $d['nip'],
                'nama' => $d['nama'],
                'email' => $d['email'],
                'alamat' => $d['alamat'],
              ];
              if ($d['password'] != '') {
                $arr['password'] = $d['password'];
			}
			$nip = $this->db->get_where("$this->low", ['id' => $id])->row_array();
			$cek_jadwal = $this->db->update("tb_jadwal", ['nip' => $d['nip']], ['nip' => $nip['nip']]);
			$this->session->set_flashdata("message", ['success', "Ubah $this->cap Berhasil", ' Berhasil']);
			$this->db->update("$this->low",$arr, ['id' => $id]);
			redirect(base_url("dashboard/guru/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Edit Data $this->cap", ' Gagal']);
			redirect(base_url("dashboard/guru/edit/".$id));
			// $this->add();
		}
	}
		
	public function delete($id){
		try{
			$this->db->delete("$this->low", ['id' => $id]);
			$this->session->set_flashdata("message", ['success', "Berhasil Hapus Data $this->cap", 'Berhasil']);
			redirect(base_url("dashboard/guru/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Hapus Data $this->cap", 'Gagal']);
			redirect(base_url("dashboard/guru/"));
		}
	}
}
