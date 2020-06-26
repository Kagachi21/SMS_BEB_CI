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
		// if($this->uri->segment(3) == "add" && $_SERVER['REQUEST_METHOD'] == "POST"){
		//   $this->store($this->uri->segment(4));
		// }else if($this->uri->segment(3) == "edit" && $_SERVER['REQUEST_METHOD'] == "POST"){
		//   $this->update($this->uri->segment(4), $this->uri->segment(5));
		// }
    }
    public function absensi_harian(){
		$day = date('l');
        $data['title'] = "Data $this->low";
        $data['kelas'] = $this->db->query("SELECT tk.* FROM tb_kelas tk JOIN tb_jadwal tj ON tk.id=tj.id_kelas GROUP BY tk.nama")->result_array();
        $d = $_POST;
		$where = "";
		$pulang = "";
		$datang = "";
        if (isset($_POST['cari'])) {

			// $q = mysqli_query($koneksi, "SELECT * FROM tb_jadwal tj WHERE hari='$day' AND tj.id_kelas='$d[kelas]' ORDER BY jam desc");
			$q = $this->db->query("SELECT * FROM tb_jadwal tj WHERE hari='$day' AND tj.id_kelas='$d[kelas]' ORDER BY jam desc")->row_array();
			$pulang = false;
			$res = $q;
			// echo "<pre>";
			// print_r($res);
			// echo $res['nip']."<br>";
			if($res['nip'] == $_SESSION['nip']){
			  $pulang = true;
			}else{
			  $pulang = false;
			}
			$qd = $this->db->query("SELECT * FROM tb_jadwal tj WHERE hari='$day'AND tj.id_kelas='$d[kelas]'  ORDER BY jam asc")->row_array();
			// $qd = mysqli_query($koneksi, "SELECT * FROM tb_jadwal tj WHERE hari='$day'AND tj.id_kelas='$d[kelas]'  ORDER BY jam asc");
			$datang = false;
			$resd = $qd;
			// echo "<pre>";
			// print_r($resd);
			// echo "SELECT * FROM tb_jadwal tj WHERE hari='$day'AND tj.id_kelas='$d[kelas]'  ORDER BY jam asc";
			// echo $resd['nip']."<br>";
			// echo "session ".$_SESSION['nip'];
			if($resd['nip'] == $_SESSION['nip']){
			  $datang = true;
			}else{
			  $datang = false;
			}
		}
		$data['pulang'] = $pulang;
		$data['datang'] = $datang;
        $data['ql'] = $this->db->query("SELECT * FROM tb_siswa ts $where")->result_array();
		$data['content'] = "$this->low/harian";
		$data['query_mysql'] = $this->db->get("tb_absen_harian")->result_array();
        $this->load->view('guru/index',$data);
	}
    public function absensi_mapel(){
        $data['title'] = "Data $this->low";
		$data['kelas'] = $this->db->query("SELECT tk.* FROM tb_kelas tk JOIN tb_jadwal tj ON tk.id=tj.id_kelas GROUP BY tk.nama")->result_array();
		$data['mapel'] = $this->db->query("SELECT tm.* FROM tb_mapel tm JOIN tb_jadwal tj ON tm.id=tj.id_mapel WHERE tj.nip='$_SESSION[nip]' GROUP BY tm.nama")->result_array();
        $d = $_POST;
        $where = "";
        if (isset($_POST['cari'])) {
			$where = " WHERE ";
			$kelas = $d['kelas'];
			if ($kelas !='') {
			  $where .=" ta.id_kelas='$kelas' ";
			}
			$mapel = $d['mapel'];
			if ($mapel !='') {
			  if ($kelas !='') {
				$where .=" AND ta.id_mapel='$mapel' ";
			  }else{
				$where .=" ta.id_mapel='$mapel' ";
			  }
			}

			$start_date = $d['start_date'];
			$end_date = $d['end_date'];
			if ($kelas !='' || $mapel !='') {
			  if($start_date !="" || $end_date!= ""){
				$where .= " AND ta.tanggal BETWEEN '$start_date' AND '$end_date' ";
			  }
			}else{
			  $where .= " ta.tanggal BETWEEN '$start_date' AND '$end_date' ";
			}
        }
        // echo "SELECT ts.nama, ts.nis, ta.tanggal,ta.status_absen, tm.nama as mapel, ta.id_mapel FROM tb_absen_pelajaran ta JOIN tb_siswa ts on ta.nis=ts.nis JOIN tb_mapel tm ON ta.id_mapel=tm.id $where GROUP BY ta.id_mapel";
        $data['ql'] = $this->db->query("SELECT ts.nama, ts.nis, ta.tanggal,ta.status_absen, tm.nama as mapel, ta.id_mapel FROM tb_absen_pelajaran ta JOIN tb_siswa ts on ta.nis=ts.nis JOIN tb_mapel tm ON ta.id_mapel=tm.id $where")->result_array();
		$data['content'] = "$this->low/mapel";
		$data['query_mysql'] = $this->db->get("tb_absen_harian")->result_array();
        $this->load->view('guru/index',$data);
    }
    public function index(){
		$data['title'] = "Data $this->low";
		$data['content'] = "$this->low/index";
		$data['query_mysql'] = $this->db->get("$this->low")->result_array();
        $this->load->view('guru/index',$data);
    }
	public function add()
	{
		$data['title'] = "Tambah $this->cap";
		$data['content'] = "$this->low/_form";
		$data['data'] = null;
		$data['kelas'] = $this->db->query("SELECT distinct(tk.nama),tk.id,tk.tipe_kelas FROM tb_kelas tk JOIN tb_jadwal tj ON tk.id=tj.id_kelas WHERE tj.nip='$_SESSION[nip]'")->result_array();
		$data['mapel'] = $this->db->query("SELECT tm.* FROM tb_mapel tm JOIN tb_jadwal tj ON tm.id=tj.id_mapel WHERE tj.nip='$_SESSION[nip]'")->result_array();

		$data['type'] = 'add';
		$this->load->view('guru/index',$data);
	}
	public function simpan(){
		$d = $_POST;
		for ($i=0; $i < count($d['status_absen']) ; $i++) {
			if ($d['status_absen'][$i] != '') {
				$nis = $d['nis'][$i];
				$kelas = $d['id_kelas'][$i];
				$mapel = $d['mapel'];
				$jam = $d['jam'][$i];
				$status = $d['status_absen'][$i];
				$q = "INSERT INTO tb_absen_pelajaran(nis, id_kelas, id_mapel, nip, jam, status_absen) VALUES('$nis', '$kelas', '$mapel', '$_SESSION[nip]', '$jam', '$status')";
				// echo $q."<br>";
				$qu = $this->db->query($q);
				if ($qu) {
					echo "<script>alert('berhasil tambah data');window.location='".base_url('guru/absen/absensi_mapel')."'</script>";
				}else{
					echo "<script>alert('gagal tambah data');window.location='".base_url('guru/absen/add')."'</script>";
				}
			}
		}
	}

	public function edit(){
		$data['title'] = "Tambah $this->cap";
		$data['content'] = "$this->low/_form";
		$data['data'] = null;
		$data['kelas'] = $this->db->query("SELECT distinct(tk.nama),tk.id,tk.tipe_kelas FROM tb_kelas tk JOIN tb_jadwal tj ON tk.id=tj.id_kelas WHERE tj.nip='$_SESSION[nip]'")->result_array();
		$data['mapel'] = $this->db->query("SELECT tm.* FROM tb_mapel tm JOIN tb_jadwal tj ON tm.id=tj.id_mapel WHERE tj.nip='$_SESSION[nip]'")->result_array();
		$data['type'] = 'edit';
		$this->load->view('guru/index',$data);
		// $data['data'] = $this->db->get_where("$this->low", ['nis' => $id])->row_array();
	}
	public function detail($id){
		$data['title'] = "Detail $this->cap";
		$data['content'] = "$this->low/_detail";
		$data['type'] = 'Ubah';
		$data['kelas'] = $this->db->get("tb_kelas")->result_array();
		$data['data'] = $this->db->get_where("$this->low", ['nis' => $id])->row_array();
		$this->load->view('guru/index',$data);
	}

	public function ubah(){
		$d = $_POST;
		$qu = "";
		for ($i=0; $i < count($d['status_absen']) ; $i++) {
			if ($d['status_absen'][$i] != '') {
				$id = $d['id'][$i];
				$kelas = $d['id_kelas'][$i];
				$mapel = $d['mapel'];
				$jam = $d['jam'][$i];
				$status = $d['status_absen'][$i];
				$q = "UPDATE tb_absen_pelajaran SET status_absen='$status' WHERE id='$id'";
				// echo $q."<br>";
				$qu = $this->db->query($q);
			}
		}
		if ($qu) {
			echo "<script>alert('berhasil ubah data');window.location='".base_url('guru/absen/absensi_mapel')."'</script>";
		}else{
			echo "<script>alert('gagal ubah data');window.location='".base_url('guru/absen/edit')."'</script>";
		}
	}

	public function delete($id){
		try{
			$this->db->delete("$this->low", ['nis' => $id]);
			$this->session->set_flashdata("message", ['success', "Berhasil Hapus Data $this->cap", 'Berhasil']);
			redirect(base_url("admin/$this->low/"));

		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Hapus Data $this->cap", 'Gagal']);
			redirect(base_url("admin/$this->low/"));
		}
	}
}
