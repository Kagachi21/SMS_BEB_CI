<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Surat_Keterangan extends CI_Controller {
	function __construct()
  	{
		parent::__construct();
		// Auth_helper::secure();
		$this->low = "tb_keterangan";
		$this->cap = "Surat Keterangan";
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
        $data['kelas'] = $this->db->get("tb_kelas")->result_array();
		$data['list'] = $this->db->query("SELECT SUM(tk.point) as point, ts.* FROM tb_bk tk JOIn tb_siswa ts ON tk.nis=ts.nis $where GROUP BY tk.nis")->result_array();
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
            $jenis = $d['jenis'];
            if ($jenis !='') {
              if ($kelas !='') {
                $where .=" AND tk.jenis='$jenis' ";
              }else{
                $where .=" tk.jenis='$jenis' ";
              }
            }
            $start_date = $d['start_date'];
            $end_date = $d['end_date'];
            if ($jenis !='' || $kelas !='') {
              $where .= " AND tk.tanggal BETWEEN '$start_date' AND '$end_date' ";
            }else{
              $where .= " tk.tanggal BETWEEN '$start_date' AND '$end_date' ";
            }
          }
        $data['kelas'] = $this->db->get("tb_kelas")->result_array();
		$data['list'] = $this->db->query("SELECT tk.*, ts.nama,ts.nis FROM tb_keterangan tk JOIn tb_siswa ts ON tk.nis=ts.nis $where")->result_array();
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
			$this->db->insert("tb_bk",$d);
			$this->session->set_flashdata("message", ['success', "Berhasil Tambah Keterangan Bk", ' Berhasil']);
			redirect(base_url("dashboard/surat_keterangan/bk"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Tambah Data Keterangan Bk", ' Gagal']);
			redirect(base_url("dashboard/surat_keterangan/bk"));
			// $this->add();
		}
	}
		
	public function edit($id){
		$data['title'] = "Ubah $this->cap";
		$data['content'] = "$this->low/_form";
		$data['type'] = 'Ubah';
		$data['kelas'] = $this->db->get("tb_kelas")->result_array();
		$data['data'] = $this->db->get_where("$this->low", ['nis' => $id])->row_array();		
		$this->load->view('backend/index',$data);
	}
	public function detail($id){
		$data['title'] = "Detail BK";
		$data['content'] = "$this->low/_detail";
		$data['type'] = 'Ubah';
		$data['ql'] = $this->db->query("SELECT ta.*, ts.nama, ts.nis FROM tb_bk ta JOIN tb_siswa ts on ta.nis=ts.nis where ts.nis='$id'")->result_array();
		$data['data'] = $this->db->get_where("tb_siswa", ['nis' => $id])->row_array();		
		$this->load->view('backend/index',$data);
	}
	
	public function update($id){
		$d = $_POST;
		try{
			$arr = [
				'nis' => $d['nis'],
				'nama' => $d['nama'],
				'email' => $d['email'],
				'jenis_kelamin' => $d['jenis_kelamin'],
				'id_kelas' => $d['id_kelas'],
				'alamat' => $d['alamat'],
				'tempat_lahir' => $d['tempat_lahir'],
				'tanggal_lahir' => $d['tanggal_lahir'],
				'no_hp' => $d['no_hp']
			];
			if ($f['foto']['name'] != '') {
				$type = str_replace("image/", "", $_FILES['foto']['type']);
				$arr['foto'] = $d['nis'].".".$type;
				Input_Helper::uploadImage($f['foto'], 'siswa', $arr['foto']);
			  }
			  if ($d['password'] != '') {
				$arr['password'] = $d['password'];
			  }
			
			$this->session->set_flashdata("message", ['success', "Ubah $this->cap Berhasil", ' Berhasil']);
			$this->db->update("$this->low",$arr, ['nis' => $id]);
			redirect(base_url("dashboard/surat_keterangan/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Edit Data $this->cap", ' Gagal']);
			redirect(base_url("dashboard/surat_keterangan/edit/".$id));
			// $this->add();
		}
	}
		
	public function delete($id){
		try{
			$this->db->delete("$this->low", ['id' => $id]);
			$this->session->set_flashdata("message", ['success', "Berhasil Hapus Data $this->cap", 'Berhasil']);
			redirect(base_url("dashboard/surat_keterangan/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Hapus Data $this->cap", 'Gagal']);
			redirect(base_url("dashboard/surat_keterangan/"));
		}
	}
}
