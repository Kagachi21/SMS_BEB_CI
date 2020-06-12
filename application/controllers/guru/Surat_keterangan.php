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
        $this->load->view('guru/index',$data);
    }
    public function index(){
		$data['title'] = "Data $this->low";
        $data['content'] = "$this->low/index";
        $d = $_POST;
        $where = "";
        $d = $_POST;
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
        $data['kelas'] = $this->db->query("SELECT distinct(tk.nama),tk.id,tk.tipe_kelas FROM tb_kelas tk JOIN tb_jadwal tj ON tk.id=tj.id_kelas WHERE tj.nip='$_SESSION[nip]'")->result_array();
		$data['list'] = $this->db->query("SELECT tk.*, ts.nama, ts.nis, tkls.nama as kelas FROM tb_keterangan tk JOIn tb_siswa ts ON tk.nis=ts.nis JOIn tb_kelas tkls ON ts.id_kelas=tkls.id $where")->result_array();
        $this->load->view('guru/index',$data);
    }
	
	public function add()
	{
		$data['title'] = "Tambah $this->cap";
		$data['content'] = "$this->low/_form";
		$data['data'] = null;
		$data['kelas'] = $this->db->get("tb_kelas")->result_array();
		$data['siswa'] = $this->db->get("tb_siswa")->result_array();
		$data['type'] = 'Tambah';
		$this->load->view('guru/index',$data);
		// Response_Helper::render('guru/index', $data);
	}
	public function store(){
		$d = $_POST;
		$f = $_FILES;
		try{
			$type = str_replace("image/", "", $_FILES['foto']['type']);
			$nametodb = $d['nis'].".".$type;
			// move_uploaded_file($_FILES['foto']['tmp_name'], "../../foto/siswa/".$nametodb);
			Input_Helper::uploadImage($f['foto'], 'siswa', $nametodb);
			$_POST['foto'] = $nametodb;
			$this->db->insert("$this->low",$d);
			$this->session->set_flashdata("message", ['success', "Berhasil Tambah $this->cap", ' Berhasil']);
			redirect(base_url("admin/$this->low/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Tambah Data $this->cap", ' Gagal']);
			redirect(base_url("admin/$this->low/add"));
			// $this->add();
		}
	}
		
	public function edit($id){
		$data['title'] = "Ubah $this->cap";
		$data['content'] = "$this->low/_form";
		$data['type'] = 'Ubah';
		$data['kelas'] = $this->db->get("tb_kelas")->result_array();
		$data['data'] = $this->db->get_where("$this->low", ['nis' => $id])->row_array();		
		$this->load->view('guru/index',$data);
	}
	
	public function delete($id){
		try{
			$this->db->delete("$this->low", ['id' => $id]);
			$this->session->set_flashdata("message", ['success', "Berhasil Hapus Data $this->cap", 'Berhasil']);
			redirect(base_url("admin/$this->low/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Hapus Data $this->cap", 'Gagal']);
			redirect(base_url("admin/$this->low/"));
		}
	}
}
