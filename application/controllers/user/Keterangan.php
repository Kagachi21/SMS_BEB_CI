<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Keterangan extends CI_Controller {
	function __construct()
  	{
		parent::__construct();
		// Auth_helper::secure();
		$this->low = "tb_keterangan";
		$this->cap = "Keterangan";
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
    public function keterangan(){

        $nis = $_SESSION['nis'];
		$data['title'] = "Data $this->low";
		$data['content'] = "$this->low/index";
		$data['queryKelas'] = $this->db->query("SELECT * FROM tb_keterangan tk where tk.nis='$nis'")->result_array();
        $this->load->view('user/index',$data);
    }
	
	public function add()
	{
		$data['title'] = "Tambah $this->cap";
		$data['content'] = "$this->low/_form";
		$data['data'] = null;
		$data['kelas'] = $this->db->get("tb_kelas")->result_array();
		$data['type'] = 'Tambah';
		$this->load->view('user/index',$data);
		// Response_Helper::render('user/index', $data);
	}
	public function store(){
		$d = $_POST;
		$f = $_FILES;
		try{
			$now = date("Y-m-d");
			$day = date('l');
			$status = $d['jenis'];
			if($d['jenis'] == 'Ijin'){
				$status = 'Izin';
			}
			$siswa = $this->db->get_where("tb_siswa", ['nis' => $d['nis']])->row_array();
			$jadwal = $this->db->query("SELECT * from tb_jadwal where hari='$day' and id_kelas='$siswa[id_kelas]'")->result_array();
			foreach ($jadwal as $j) {
				$this->db->insert('tb_absen_pelajaran', ['nis' => $d['nis'], 'id_kelas' => $j['id_kelas'], 'id_mapel' => $j['id_mapel'], 'nip'=> $j['nip'], 'jam' => $j['jam'], 'status_absen' => $status]);
			}
            $type = str_replace("image/", "", $_FILES['foto']['type']);
            $nametodb = $d['nis'].".".$type;
            Input_Helper::uploadImage($f['foto'], 'surat', $nametodb);
            $_POST['foto'] = $nametodb;
			$this->db->insert("$this->low",$_POST);
			$this->session->set_flashdata("message", ['success', "Berhasil Tambah $this->cap", ' Berhasil']);
			redirect(base_url("user/keterangan/keterangan"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Tambah Data $this->cap", ' Gagal']);
			redirect(base_url("user/keterangan/add"));
			// $this->add();
		}
	}
		
	public function edit($id){
		$data['title'] = "Ubah $this->cap";
		$data['content'] = "$this->low/_form";
		$data['type'] = 'Ubah';
		$data['data'] = $this->db->get_where("$this->low", ['id' => $id])->row_array();		
		$this->load->view('user/index',$data);
	}
	public function detail($id){
		$data['title'] = "Detail $this->cap";
		$data['content'] = "$this->low/_detail";
		$data['type'] = 'Ubah';
		$data['kelas'] = $this->db->get("tb_kelas")->result_array();
		$data['data'] = $this->db->get_where("$this->low", ['nis' => $id])->row_array();		
		$this->load->view('user/index',$data);
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
			
			$this->session->set_flashdata("message", ['success', "Ubah $this->cap Berhasil", ' Berhasil']);
			$this->db->update("$this->low",$arr, ['id' => $id]);
			redirect(base_url("admin/$this->low/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Edit Data $this->cap", ' Gagal']);
			redirect(base_url("admin/$this->low/edit/".$id));
			// $this->add();
		}
	}
		
	public function delete($id){
		try{
			$this->db->delete("$this->low", ['id' => $id]);
			$this->session->set_flashdata("message", ['success', "Berhasil Hapus Data $this->cap", 'Berhasil']);
			redirect(base_url("user/keterangan/keterangan/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Hapus Data $this->cap", 'Gagal']);
			redirect(base_url("user/keterangan/keterangan/"));
		}
	}
}
