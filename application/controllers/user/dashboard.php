<?php
class Dashboard extends CI_Controller { //mengextends CI_Controller 
    public function __construct(){
        parent::__construct();
    }
    public function index () {
        $data['title'] = "Dashboard";
        $nis = $_SESSION['nis'];
        $data = $this->db->query("SELECT ts.*, tk.nama as nama_kelas FROM tb_siswa ts INNER JOIN tb_kelas tk ON tk.id = ts.id_kelas WHERE ts.nis = '$nis'")->row_array();
        // $data['foto'] = $data["foto"];
        $data['nama'] = $data["nama"];
        $data['jenis'] = $data["jenis_kelamin"];
        $data['tempat'] = $data["tempat_lahir"];
        $data['lahir'] = $data["tanggal_lahir"];
        $data['kelas'] = $data["nama_kelas"];
        $data['kelasID'] = $data["id_kelas"];
        $data['alamat'] = $data["alamat"];
        $data['email'] = $data["email"];
        $data['content'] = "dashboard/index";
		$this->load->view('user/index',$data);

    }
}
?>