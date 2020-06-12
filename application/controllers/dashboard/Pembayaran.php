<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pembayaran extends CI_Controller {
	function __construct()
  	{
		parent::__construct();
		// Auth_helper::secure();
		$this->low = "tb_pembayaran";
		$this->cap = "Pembayaran";
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
    public function bk(){
        $data['title'] = "Data Bk";
        $data['content'] = "$this->low/bk";
        $d = $_POST;
        $where = "";
        if (isset($_POST['cari'])) {
            $where = " WHERE ";
            $kelas = $d['kelas'];
            if ($kelas !='') {
              $where .=" ts.id_kelas='$kelas' ";
            }
		}
		if (isset($_POST['cari'])) {
			$where = " WHERE ";
			$kelas = $d['kelas'];
			if ($kelas !='') {
			  $where .=" ts.id_kelas='$kelas' ";
			}

		  }
        $data['kelas'] = $this->db->get("tb_kelas")->result_array();
		$data['list'] = $this->db->query("SELECT ta.*, ts.nama, ts.nis FROM tb_pembayaran ta JOIN tb_siswa ts on ta.nis=ts.nis $where GROUP BY ts.nis")->result_array();
        $this->load->view('backend/index',$data);
    }
    public function index(){
		$data['title'] = "Data $this->low";
        $data['content'] = "$this->low/index";
        $d = $_POST;
        $where = "";
		if (isset($_POST['cari'])) {
			$where = " WHERE ";
			$kelas = $d['kelas'];
			if ($kelas !='') {
			  $where .=" ts.id_kelas='$kelas' ";
			}
		}
        $data['kelas'] = $this->db->get("tb_kelas")->result_array();
		$data['list'] = $this->db->query("SELECT tk.*, ts.nama,ts.nis FROM tb_keterangan tk RIGHT JOIN tb_siswa ts ON tk.nis=ts.nis $where")->result_array();
        $this->load->view('backend/index',$data);
    }
	
	public function add()
	{
		$data['title'] = "Tambah $this->cap";
		$data['content'] = "$this->low/_form";
		$data['data'] = null;
		$data['kelas'] = $this->db->get("tb_kelas")->result_array();
		$data['siswa'] = $this->db->get("tb_siswa")->result_array();
		$data['type'] = 'Tambah';
		$this->load->view('backend/index',$data);
		// Response_Helper::render('backend/index', $data);
	}
	public function store(){
		$d = $_POST;
		$f = $_FILES;
		try{
			// $type = str_replace("image/", "", $_FILES['foto']['type']);
			// $nametodb = $d['nis'].".".$type;
			// // move_uploaded_file($_FILES['foto']['tmp_name'], "../../foto/siswa/".$nametodb);
			// Input_Helper::uploadImage($f['foto'], 'siswa', $nametodb);
			// $_POST['foto'] = $nametodb;
			$this->db->insert("$this->low",$d);
			$this->session->set_flashdata("message", ['success', "Berhasil Tambah $this->cap", ' Berhasil']);
			redirect(base_url("dashboard/pembayaran/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Tambah Data $this->cap", ' Gagal']);
			redirect(base_url("dashboard/pembayaran/add"));
			// $this->add();
		}
	}
		
	public function edit($id){
		$data['title'] = "Ubah $this->cap";
		$data['content'] = "$this->low/_form";
		$data['type'] = 'Ubah';
		$data['kelas'] = $this->db->get("tb_kelas")->result_array();
		$data['data'] = $this->db->get_where("$this->low", ['id' => $id])->row_array();		
		$this->load->view('backend/index',$data);
	}
	public function detail($id){
		$data['title'] = "Detail BK";
		$data['content'] = "$this->low/_detail";
		$data['type'] = 'Ubah';
		$data['ql'] = $this->db->query("SELECT ta.*, ts.nama, ts.nis FROM tb_pembayaran ta JOIN tb_siswa ts on ta.nis=ts.nis where ts.nis='$id'")->result_array();
		$data['data'] = $this->db->get_where("tb_siswa", ['nis' => $id])->row_array();		
		$this->load->view('backend/index',$data);
	}
	
	public function update($id){
		$d = $_POST;
		try{
			$arr = [
				'jml_tagihan' => $d['jml_tagihan'],
				'status' => $d['status'],
				'jenis_pembayaran' => $d['jenis_pembayaran'],
				'deskripsi' => $d['deskripsi'],
			];
			
			$this->session->set_flashdata("message", ['success', "Ubah $this->cap Berhasil", ' Berhasil']);
			$this->db->update("$this->low",$arr, ['id' => $id]);
			redirect(base_url("dashboard/pembayaran/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Edit Data $this->cap", ' Gagal']);
			redirect(base_url("dashboard/pembayaran/edit/".$id));
			// $this->add();
		}
	}
		
	public function delete($id){
		try{
			$this->db->delete("$this->low", ['nis' => $id]);
			$this->session->set_flashdata("message", ['success', "Berhasil Hapus Data $this->cap", 'Berhasil']);
			redirect(base_url("dashboard/pembayaran/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Hapus Data $this->cap", 'Gagal']);
			redirect(base_url("dashboard/pembayaran/"));
		}
	}
}
