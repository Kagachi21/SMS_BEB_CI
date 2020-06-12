<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Siswa extends CI_Controller {
	function __construct()
  	{
		parent::__construct();
		// Auth_helper::secure();
		$this->low = "tb_siswa";
		$this->cap = "Siswa";
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
		$d = $_POST;
		$data['title'] = "Data $this->low";
		$data['kelas'] = $this->db->query("SELECT tk.* FROM tb_kelas tk JOIN tb_siswa tj ON tk.id=tj.id_kelas GROUP BY tk.nama")->result_array();
		$data['content'] = "$this->low/index";
		$where = "";
        if (isset($_POST['cari'])) {
                $where = " WHERE id_kelas='$d[kelas]'";
        }
		$data['query_mysql'] = $this->db->query("SELECT * FROM $this->low $where")->result_array();
        $this->load->view('backend/index',$data);
	}
	public function scan(){
		$data['title'] = "Tambah $this->cap";
		$data['content'] = "$this->low/scan";
		$data['data'] = null;
		$data['kelas'] = $this->db->get("tb_kelas")->result_array();
		$data['type'] = 'Tambah';
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
			$type = str_replace("image/", "", $_FILES['foto']['type']);
			$nametodb = $d['nis'].".".$type;
			// move_uploaded_file($_FILES['foto']['tmp_name'], "../../foto/siswa/".$nametodb);
			Input_Helper::uploadImage($f['foto'], 'siswa', $nametodb);
			$d['foto'] = $nametodb;
			$this->db->insert("$this->low",$d);
			$this->session->set_flashdata("message", ['success', "Berhasil Tambah $this->cap", ' Berhasil']);
			redirect(base_url("dashboard/siswa/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Tambah Data $this->cap", ' Gagal']);
			redirect(base_url("dashboard/siswa/add"));
			// $this->add();
		}
	}
	public function qrcode(){
		$data['title'] = "Tambah $this->cap";
		$data['content'] = "$this->low/qrcode";
		$data['data'] = null;
		$data['kelas'] = $this->db->get("tb_kelas")->result_array();
		$data['type'] = 'Tambah';
		$this->load->view('backend/index',$data);
	}
	public function showQr($id = null){

		// echo BASEPATH;
		if($id != null){
			$car = $this->db->get_where("$this->low", ['nis' => $id]);
			if($car->num_rows()>0){
				$row = $car->row();
					$shows = array('nis'=>$row->nis,
									'nama'=>$row->nama,
												);
				$this->load->view('backend/content/tb_siswa/result_qrcode',$shows);
			}else{
				echo "<div class='alert alert-danger text-center'>Kosong </div>";
			}
		}else{
			echo "<div class='alert alert-danger text-center'>Kosong </div>";
		}
	}
	public function generate($id){
		$this->load->library('ciqrcode');
		header("Content-Type: image/png");
		$params['data'] = $id;
		return $this->ciqrcode->generate($params);
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
			redirect(base_url("dashboard/siswa/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Edit Data $this->cap", ' Gagal']);
			redirect(base_url("dashboard/siswa/edit/".$id));
			// $this->add();
		}
	}
		
	public function delete($id){
		try{
			$this->db->delete("$this->low", ['nis' => $id]);
			$this->session->set_flashdata("message", ['success', "Berhasil Hapus Data $this->cap", 'Berhasil']);
			redirect(base_url("dashboard/siswa/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Hapus Data $this->cap", 'Gagal']);
			redirect(base_url("dashboard/siswa/"));
		}
	}
}
