<?php
class Api extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function login(){
      // $this->db->select('*');
      // $this->db->from('tb_siswa');
      // $this->db->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id');
      $d = $_POST;
      $username = $d['username'];
      $password = $d['password'];
  		$cek = $this->db->query("SELECT * from tb_siswa ts JOIN tb_kelas tk ON ts.id_kelas=tk.id WHERE ts.nis ='$username' AND password = '$password'")->num_rows();
      $cek1 = $this->db->get_where("tb_guru", ['nip' => $username, 'password' => $password])->num_rows();
  		if ($cek!=0) {
  			$akun =  $this->db->query("SELECT ts.*, tk.nama as kelas from tb_siswa ts JOIN tb_kelas tk ON ts.id_kelas=tk.id WHERE ts.nis ='$username' AND password = '$password'")->row_array();
  			$response = array(
          'level' => "siswa",
  				'status' => "true",
  				'message' => "Login Sukses",
  				'data' => $akun
  			);
  			echo json_encode($response);
  		}elseif ($cek1!=0) {
        $akun1 =  $this->db->get_where("tb_guru",['nip'=>$_POST['username'],'password'=>$_POST['password']])->row_array();
        $response = array(
          'level' => "guru",
          'status' => "true",
          'message' => "Login Sukses",
          'data' => $akun1
        );
        echo json_encode($response);
      }
      else {
  			$response = array(
  				'status' => "false",
  				'message' => "Akun tidak ditemukan"
  			);
  			echo json_encode($response);
  		}
  	}

    public function absensi_harian(){
      $absen = $_POST;
      $nis = $absen['nis'];
      $cekabsen = $this->db->get_where("tb_absen_harian", ['nis' => $nis])->num_rows();
      if ($cekabsen!=0) {
        $dataabsen = $cekabsen = $this->db->get_where("tb_absen_harian", ['nis' => $nis])->row_array();
        $absenrespon = array(
          'dataabsen' => $dataabsen
        );
        echo json_encode($absenrespon);
      }else {
  			$absenrespon = array(
  				'message' => "Data tidak ditemukan"
  			);
  			echo json_encode($absenrespon);
      }
    }

    public function absensi_mapel(){
      $absen1 = $_POST;
      $nis = $absen1['nis'];
      $cekabsen1 = $this->db->get_where("tb_absen_pelajaran", ['nis' => $nis])->num_rows();
      if ($cekabsen1!=0) {
        $dataabsen1 = $cekabsen1 = $this->db->get_where("tb_absen_pelajaran", ['nis' => $nis])->row_array();
        $absenrespon1 = array(
          'dataabsen1' => $dataabsen1
        );
        echo json_encode($absenrespon1);
      }else {
  			$absenrespon1 = array(
  				'message' => "Data tidak ditemukan"
  			);
  			echo json_encode($absenrespon1);
      }
    }

    public function bk(){
      $bk = $_POST;
      $nis = $bk['nis'];
      $cekbk = $this->db->get_where("tb_bk", ['nis' => $nis])->num_rows();
      if ($cekbk!=0) {
        $databk = $this->db->get_where("tb_bk", ['nis' => $nis])->result_array();
        $bkrespon = array(
          'databk' => $databk
        );
        echo json_encode($bkrespon);
      }else {
  			$bkrespon = array(
  				'message' => "Bk tidak ditemukan"
  			);
  			echo json_encode($bkrespon);
      }
    }

    public function keterangan(){
      $ket = $_POST;
      $nis = $ket['nis'];
      $cekket = $this->db->get_where("tb_keterangan", ['nis' => $nis])->num_rows();
      if ($cekket!=0) {
        $dataket = $cekket = $this->db->get_where("tb_keterangan", ['nis' => $nis])->result_array();
        $ketrespon = array(
          'dataketerangan' => $dataket
        );
        echo json_encode($ketrespon);
      }else {
        $ketrespon = array(
          'message' => "Akun tidak ditemukan"
        );
        echo json_encode($ketrespon);
      }
    }

    public function pembayaran(){
      $bayar = $_POST;
      $nis = $bayar['nis'];
      $cekbayar = $this->db->get_where("tb_pembayaran", ['nis' => $nis])->num_rows();
      if ($cekbayar!=0) {
        $databayar = $cekbayar = $this->db->get_where("tb_pembayaran", ['nis' => $nis])->row_array();
        $bayarrespon = array(
          'databayar' => $databayar
        );
        echo json_encode($bayarrespon);
      }else {
        $bayarrespon = array(
          'message' => "Akun tidak ditemukan"
        );
        echo json_encode($bayarrespon);
      }
    }

    public function kelas(){
      $kelas = $_POST;
      $id = $kelas['id'];
      $cekkelas = $this->db->get_where("tb_kelas.id = tb_siswa.id_kelas", ['id' => $id])->num_rows();
      if ($cekkelas!=0) {
        $datakelas = $cekkelas = $this->db->get_where("tb_kelas", ['id' => $id])->row_array();
        $kelasrespon = array(
          'datakelas' => $datakelas
        );
        echo json_encode($kelasrespon);
      }else {
        $kelasrespon = array(
          'message' => "Akun tidak ditemukan"
        );
        echo json_encode($kelasrespon);
      }
    }

    public function qrcode(){
      $p = $_POST;
      $qrcode = $p['nis'];
      $cekqr = $this->db->get_where("tb_siswa", ['id' => $qrcode])->num_rows();
      if ($cekqr!=0) {
        $cekqr = $this->db->get_where("tb_siswa", ['id' => $qrcode])->row_array();
        $qrresponse = $qrcode;
        redirect(base_url('dashboard/siswa/generate/'.$qrcode));
      }else {
  			$qrresponse = array(
  				'message' => "Tidak ditemukan"
  			);
  			echo json_encode($qrresponse);
  		}
    }
}
