<?php
class Absen extends CI_Controller { //mengextends CI_Controller 
    public function __construct(){
        parent::__construct();
    }
    public function absen_mapel () {
        $data['title'] = "Absen";
        $nis = $_SESSION['nis'];
        $now = date('Y-m-d');
        $where = "and tp.tanggal like '%$now%'";
        $d = $_POST;
          if (isset($_POST['cari'])) {
            $where = " AND ";
            $start_date = $d['start_date'];
            $end_date = $d['end_date'];
              $where .= " tp.tanggal BETWEEN '$start_date' AND '$end_date' ";
        }
        $data['content'] = "absen/absen_mapel";
        $data['queryKelas'] =$this->db->query("SELECT tm.nama as mapel, tp.nis, tp.id_mapel FROM tb_absen_pelajaran tp JOIN tb_mapel tm ON tp.id_mapel=tm.id where tp.nis='$nis'  $where GROUP BY tp.id_mapel")->result_array();
		$this->load->view('user/index',$data);
    }
    public function absen_sekolah () {
        $data['title'] = "Absen";
        $nis = $_SESSION['nis'];
        $now = date('Y-m-d');
        $where = "and tp.tanggal like '%$now%'";
        $d = $_POST;
          if (isset($_POST['cari'])) {
            $where = " AND ";
            $start_date = $d['start_date'];
            $end_date = $d['end_date'];
            // if ( $kelas !='') {
            //   $where .= " AND tp.tanggal BETWEEN '$start_date' AND '$end_date' ";
            // }else{
              $where .= " tp.tanggal BETWEEN '$start_date' AND '$end_date' ";
            // }
        }
        $data['content'] = "absen/absen_sekolah";
        // echo "SELECT  tp.status_absen, tp.tanggal FROM tb_absen_harian tp  where tp.nis='$nis'  $where";
        $data['queryKelas'] =$this->db->query("SELECT  tp.status_absen, tp.tanggal FROM tb_absen_harian tp  where tp.nis='$nis'  $where")->result_array();
		    $this->load->view('user/index',$data);

    }
}
?>