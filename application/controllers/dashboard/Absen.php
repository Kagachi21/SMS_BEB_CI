<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Absen extends CI_Controller {
	function __construct()
  	{
		parent::__construct();
		// Auth_helper::secure();
		$this->low = "absensi";
		$this->cap = "Absen";
		date_default_timezone_set('Asia/Jakarta');
		// if(!isset($_SESSION['kode_user'])){
		// 	redirect(base_url());
		// }
		// if($this->uri->segment(3) == "absensi_harian" && $_SERVER['REQUEST_METHOD'] == "POST"){
		//   $this->store_harian();
		// }else if($this->uri->segment(3) == "absensi_mapel" && $_SERVER['REQUEST_METHOD'] == "POST"){
		//   $this->store_mapel();
		// }
    }
    public function absensi_harian(){
        $data['title'] = "Data $this->low";
        $data['kelas'] = $this->db->query("SELECT * FROM tb_kelas ")->result_array();
        $d = $_POST;
        $where = "";
        if (isset($_POST['cari'])) {
			// $d = $_POST;
			$kelas = $d['kelas'];
			if ($kelas !='') {
			  $where = " WHERE ";
			}
			if ("" != trim($kelas)) {
			  $where .=" ta.id_kelas='$kelas' ";
			}
			
			$start_date = $d['start_date'];
			if ("" != trim($start_date)) {
				$where .= " AND ta.tanggal like  '%$start_date%'";
			}
			
		  }
        $data['ql'] = $this->db->query("SELECT * FROM tb_siswa ts JOIN tb_absen_harian ta ON ts.nis=ta.nis $where")->result_array();
		$data['content'] = "$this->low/harian";
		$data['query_mysql'] = $this->db->get("tb_absen_harian")->result_array();
        $this->load->view('backend/index',$data);
	}
	public function isi_absen_harian(){
		$nis = $this->input->post("nis");
		$time = intval(gmdate(date("h"), 60));
		$value = 90;
		$now = date("Y-m-d");
		$datetime = date('Y-m-d H:i:s');
		$data = $this->db->get_where("tb_siswa", ['nis' => $nis]);
		if($data->num_rows() > 0){
			$data = $data->row_array();
			if($time >= 6 && $time <= 9 ){
				$cek = $this->db->query("SELECT * FROM tb_absen_harian where nis='$nis' and tanggal like '%$now%' and type='1'");
				if($cek->num_rows() < 1){
					$status = 'Hadir';
					if($time >=7){
						$status = "Hadir(Telat)";
					}
					$this->db->insert("tb_absen_harian", ['nis' => $nis, 'status_absen' => $status,'tanggal' => $datetime, 'id_kelas' => $data['id_kelas'], 'type' => '1']);
				}
			}else{
				$cek = $this->db->query("SELECT * FROM tb_absen_harian where nis='$nis' and tanggal like '%$now%' and type='2'");
				if($cek->num_rows() < 1){
					$status = 'Pulang';
					$this->db->insert("tb_absen_harian", ['nis' => $nis, 'status_absen' => $status,'tanggal' => $datetime, 'id_kelas' => $data['id_kelas'], 'type' => '2']);
				}
			}
		}else{
			echo "tidak ada data";
		}
	}
	public function absensi_mapel(){
        $data['title'] = "Data $this->low";
        $data['kelas'] = $this->db->get("tb_kelas")->result_array();
        $data['mapel'] = $this->db->get("tb_mapel")->result_array();
        $d = $_POST;
        $where = "";
        if (isset($_POST['cari'])) {
			// $d = $_POST;
			$kelas = $d['kelas'];
			if ($kelas !='') {
			  $where = " WHERE ";
			}
			if ("" != trim($kelas)) {
			  $where .=" ta.id_kelas='$kelas' ";
			}
			$mapel = $d['mapel'];
			if ("" != trim($mapel)) {
			  // echo "mapel tidak kosong";
			  if ("" != trim($kelas)) {
				$where .=" AND ta.id_mapel='$mapel' ";
			  }else{
				$where .=" ta.id_mapel='$mapel' ";
			  }
			}
			
			$start_date = $d['start_date'];
			$end_date = $d['end_date'];
			if ("" != trim($start_date) || "" != trim($end_date)) {
			  if ("" != trim($kelas) || "" != trim($mapel)) {
				$where .= " OR ta.tanggal BETWEEN '$start_date' AND '$end_date' ";
			  }else{
				$where .= " ta.tanggal BETWEEN '$start_date' AND '$end_date' ";
			  }
			}
			
		  }
        $data['ql'] = $this->db->query("SELECT ts.nama, ts.nis, ta.tanggal,ta.status_absen, tm.nama as mapel, ta.id_mapel FROM tb_absen_pelajaran ta JOIN tb_siswa ts on ta.nis=ts.nis JOIN tb_mapel tm ON ta.id_mapel=tm.id $where GROUP BY ts.nis")->result_array();
		$data['content'] = "$this->low/mapel";
		$data['query_mysql'] = $this->db->get("tb_absen_harian")->result_array();
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
	public function store_harian(){
		$d = $_POST;
		$f = $_FILES;
		try{
			for ($i=0; $i < count($d['status_absen']) ; $i++) {
				if ($d['status_absen'][$i] != '') {
			
					$nis = $d['nis'][$i];
					$kelas = $d['kelas'];
					$type = $d['type'];
					$tanggal = date('Y-m-d H:i:s');
					$status = $d['status_absen'][$i];
					$now = date('Y-m-d');
					// echo "SELECT * FROM tb_absen_harian WHERE nis='$nis' and tanggal like '%$tanggal%' and type='$type'";
					$cek = $this->db->query("SELECT * FROM tb_absen_harian WHERE nis='$nis' and tanggal like '%$now%' and type='$type'");
					$jumlah = $cek->num_rows();
					if($jumlah < 1){
						$q = "INSERT INTO tb_absen_harian(nis, tanggal, status_absen, id_kelas, type) VALUES('$nis', '$tanggal', '$status','$kelas', '$type')";;
						$qu = $this->db->query($q);
			
					}else{
						$q = "UPDATE tb_absen_harian SET status_absen='$status' WHERE nis='$nis' and tanggal like '%$now%'";
						$qu = $this->db->query($q);
					}
				}
			}
			$this->session->set_flashdata("message", ['success', "Berhasil Ngisi $this->cap", ' Berhasil']);
			redirect(base_url("dashboard/absen/absensi_harian"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Tambah Data $this->cap", ' Gagal']);
			redirect(base_url("dashboard/absen/absensi_harian"));
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
		$data['title'] = "Detail $this->cap";
		$data['content'] = "$this->low/_detail";
		$data['type'] = 'Ubah';
		$data['kelas'] = $this->db->get("tb_kelas")->result_array();
		$data['data'] = $this->db->get_where("$this->low", ['nis' => $id])->row_array();		
		$this->load->view('backend/index',$data);
	}
}
