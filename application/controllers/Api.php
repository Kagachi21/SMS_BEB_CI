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

    public function absensi_harian_masuk(){
      $absen = $_POST;
      $nis = $absen['nis'];
      $cekabsen = $this->db->get_where("tb_absen_harian", ['nis' => $nis, 'type'=> 1])->num_rows();
      if ($cekabsen!=0) {
        $dataabsen = $cekabsen = $this->db->get_where("tb_absen_harian", ['nis' => $nis, 'type'=> 1])->result_array();
        $type1 = $this->db->query("SELECT * FROM tb_absen_harian WHERE type = '1'")->row_array();
        $absenrespon = array(
          'dataabsen' => $dataabsen,
          'type' => $type1['status_absen']
        );
        echo json_encode($absenrespon);
      }else {
  			$absenrespon = array(
  				'message' => "Data tidak ditemukan"
  			);
  			echo json_encode($absenrespon);
      }
    }

    public function absensi_harian_pulang(){
      $absen = $_POST;
      $nis = $absen['nis'];
      $cekabsen = $this->db->get_where("tb_absen_harian", ['nis' => $nis, 'type'=> 2])->num_rows();
      if ($cekabsen!=0) {
        $dataabsen = $cekabsen = $this->db->get_where("tb_absen_harian", ['nis' => $nis, 'type'=> 2])->result_array();
        $type1 = $this->db->query("SELECT * FROM tb_absen_harian WHERE type = '2'")->row_array();
        $absenrespon = array(
          'dataabsen' => $dataabsen,
          'type' => $type1['status_absen']
        );
        echo json_encode($absenrespon);
      }else {
  			$absenrespon = array(
  				'message' => "Data tidak ditemukan"
  			);
  			echo json_encode($absenrespon);
      }
    }

    public function jadwal_guru(){
      $jadwalguru = $_POST;
      $nip = $jadwalguru['nip'];
      $cekjadwalguru = $this->db->query("SELECT * from tb_jadwal ts JOIN tb_kelas tk ON ts.id_kelas=tk.id JOIN tb_mapel tm ON ts.id_mapel=tm.id JOIN tb_guru tw ON ts.nip=tw.nip WHERE ts.nip ='$nip'")->num_rows();
      if ($cekjadwalguru!=0) {
         $datajadwalguru = $this->db->query("SELECT ts.*, tw.nama as guru, tk.nama as kelas, tm.nama as mapel from tb_jadwal ts JOIN tb_guru tw ON ts.nip=tw.nip JOIN tb_kelas tk ON ts.id_kelas=tk.id JOIN tb_mapel tm ON ts.id_mapel=tm.id WHERE ts.nip ='$nip'")->result_array();
         $jadwalgururespon = array(
            'datajadwalguru' => $datajadwalguru
          );
          echo json_encode($jadwalgururespon);
       }else {
          $jadwalgururespon = array(
            'message' => "Akun tidak ditemukan"
          );
          echo json_encode($jadwalgururespon);
        }
    }

    public function suket_guru(){
      $d = $_POST;
      $cekdatasuket = $this->db->get_where("tb_keterangan")->num_rows();
      if ($cekdatasuket!=0) {
        $datasuket['list'] = $this->db->query("SELECT tk.*, ts.nama, ts.nis, tkls.nama as kelas FROM tb_keterangan tk JOIn tb_siswa ts ON tk.nis=ts.nis JOIn tb_kelas tkls ON ts.id_kelas=tkls.id")->result_array();
        $suketrespon = array(
          'datasuket' => $datasuket
        );
        echo json_encode($suketrespon);
      }else {
  			$suketrespon = array(
  				'message' => "Data tidak ditemukan"
  			);
  			echo json_encode($suketrespon);
      }
    }

    public function absensi_mapel(){
      $absenmapel = $_POST;
      $nis = $absenmapel['nis'];

      $cekabsenmapel = $this->db->query("SELECT * from tb_guru ts JOIN tb_absen_pelajaran tm ON ts.nip=tm.nip JOIN tb_mapel tk ON tm.id_mapel=tk.id WHERE tm.nis ='$nis'")->num_rows();
      // JOIN tb_guru tk ON ts.nip=tk.nip

      if ($cekabsenmapel!=0) {

        $dataabsenmapel = $this->db->query("SELECT tm.*, ts.nama as guru, tk.nama as mapel from tb_absen_pelajaran tm JOIN tb_guru ts ON tm.nip=ts.nip JOIN tb_mapel tk ON tm.id_mapel=tk.id WHERE tm.nis ='$nis'")->result_array();
        // tk.nama as guru from tb_absen_pelajaran tm JOIN tb_guru tk ON tm.nip=tk.nip WHERE tm.nis
        // tk.nama as guru from tb_absen_pelajaran ts JOIN tb_guru tk ON ts.nip=tk.nip AND
        $absenresponmapel = array(
          'datamapel' => $dataabsenmapel
        );
        echo json_encode($absenresponmapel);
      }else {
  			$absenresponmapel = array(
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
        $point = $this->db->query("SELECT SUM(point) point FROM tb_bk WHERE nis ='$nis'")->row_array();
        $bkrespon = array(
          'databk' => $databk,
          'point' => $point['point']
        );
        echo json_encode($bkrespon);
      }else {
  			$bkrespon = array(
  				'message' => "Bk tidak ditemukan"
  			);
  			echo json_encode($bkrespon);
      }
    }

    public function pembayaran(){
      $bayar = $_POST;
      $nis = $bayar['nis'];
      $cekbayar = $this->db->get_where("tb_pembayaran", ['nis' => $nis])->num_rows();
      if ($cekbayar!=0) {
         $databayar = $this->db->get_where("tb_pembayaran", ['nis' => $nis])->result_array();
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

    public function keterangan(){
      $ket = $_POST;
      $nis = $ket['nis'];
      $cekket = $this->db->get_where("tb_keterangan", ['nis' => $nis])->num_rows();
      if ($cekket!=0) {
        $dataket = $this->db->get_where("tb_keterangan", ['nis' => $nis])->result_array();
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

    public function input_suket() {
      $d = $_POST;
      $f = $_FILES;
      $type = str_replace("image/", "", $_FILES['foto']['type']);
			$nametodb = $_FILES['foto']['name'];
			// move_uploaded_file($_FILES['foto']['tmp_name'], "../../foto/siswa/".$nametodb);
			Input_Helper::uploadImage($f['foto'], 'surat', $nametodb);
			$d['foto'] = $nametodb;
			$this->db->insert("tb_keterangan",$d);

      $response = array(
        'status' => 'true'
      );
      echo json_encode($response);
    }

}



// $foto = str_replace("image/", "", $_FILES['foto']['type']);
// $nametodb = $d['nis'].".".$foto;
//
// Input_Helper::uploadImage($f['foto'], 'siswa', $nametodb);
// $d['foto'] = $nametodb;

// $nis = $this->input->post('nis');
// $jenis = $this->input->post('jenis');
// // $foto = $this->input->post('foto');
// //$gambar = $this->input->post('gambar');
// $data = array(
//   'nis' => $nis,
//   'jenis' => $jenis,
//   'foto' => $foto
// );
// $this->db->insert('tb_keterangan',$data);
// $getsuket = $this->db->get_where($data)->result();

// $imgData = base64_decode($foto);
// // set the image paths
// // $path = './foto/surat/';
// $file = uniqid().'.jpeg';
// $file_path = $path.$file;

// public function input_suket(){
// 	$foto_suket = $this->input->post('foto');
//   $keterangan = $this->input->post('jenis');
//
//   $data = array(
//     'foto' => $foto_suket,
//     'jenis' => $keterangan
//   );
//   $this->db->input_data($data,'tb_keterangan');
//   echo json_encode($array);
//   }

// public function kelas(){
//   $kelas = $_POST;
//   $id = $kelas['id'];
//   $cekkelas = $this->db->get_where("tb_kelas.id = tb_siswa.id_kelas", ['id' => $id])->num_rows();
//   if ($cekkelas!=0) {
//     $datakelas = $cekkelas = $this->db->get_where("tb_kelas", ['id' => $id])->row_array();
//     $kelasrespon = array(
//       'datakelas' => $datakelas
//     );
//     echo json_encode($kelasrespon);
//   }else {
//     $kelasrespon = array(
//       'message' => "Akun tidak ditemukan"
//     );
//     echo json_encode($kelasrespon);
//   }
// }

// public function qrcode(){
//   $p = $_POST;
//   $qrcode = $p['nis'];
//   $cekqr = $this->db->get_where("tb_siswa", ['id' => $qrcode])->num_rows();
//   if ($cekqr!=0) {
//     $cekqr = $this->db->get_where("tb_siswa", ['id' => $qrcode])->row_array();
//     $qrresponse = $qrcode;
//     redirect(base_url('dashboard/siswa/generate/'.$qrcode));
//   }else {
// 		$qrresponse = array(
// 			'message' => "Tidak ditemukan"
// 		);
// 		echo json_encode($qrresponse);
// 	}
// }
