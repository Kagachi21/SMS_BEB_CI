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
        $nip = $this->input->post('nip');
        $kelas = $this->input->post('kelas');

        $cek = $this->db->query("SELECT *from tb_absen_pelajaran, tb_siswa, tb_keterangan, tb_kelas WHERE nip ='$nip' AND tb_absen_pelajaran.id_kelas = '$kelas' AND tb_siswa.nis = tb_absen_pelajaran.nis AND tb_siswa.nis = tb_keterangan.nis AND tb_kelas.id = tb_siswa.id_kelas ")->num_rows();

        if($cek){
        $cekdatasuket = $this->db->query("SELECT tb_keterangan.*, tb_siswa.nama as nama_siswa, tb_absen_pelajaran.nip as nip_guru, tb_kelas.nama as kelas from tb_absen_pelajaran, tb_keterangan, tb_siswa, tb_kelas WHERE nip ='$nip' and tb_absen_pelajaran.id_kelas = '$kelas'
          AND tb_siswa.nis = tb_absen_pelajaran.nis AND tb_siswa.nis = tb_keterangan.nis  AND tb_kelas.id = tb_siswa.id_kelas GROUP BY id, kelas")->result_array();
        // JOIN tb_guru tk ON ts.nip=tk.nip
          $datasuketrespon = array(
            'datasuketguru' => $cekdatasuket
          );
          echo json_encode($datasuketrespon);
        }else {
          $datasuketrespon = array(
            'message' => "Data tidak ditemukan"
          );
          echo json_encode($datasuketrespon);
        }
    }

    public function data_absenmapel(){
      $nip = $this->input->post("nip");
      $cek = $this->db->query("SELECT *from tb_absen_pelajaran,tb_siswa,tb_kelas WHERE nip ='$nip' AND tb_siswa.nis = tb_absen_pelajaran.nis AND tb_kelas.id = tb_absen_pelajaran.id_kelas")->num_rows();
      if($cek){
        $cekabsenmapel = $this->db->query("SELECT tb_absen_pelajaran.*, tb_siswa.nama as siswa, tb_kelas.nama as kelas from tb_absen_pelajaran,tb_siswa,tb_kelas WHERE nip = '$nip' AND tb_siswa.nis = tb_absen_pelajaran.nis AND tb_kelas.id = tb_absen_pelajaran.id_kelas GROUP BY id_kelas, kelas")->result_array();
        $dataabsen = array(
          'absenmapel' => $cekabsenmapel
        );
        echo json_encode($dataabsen);
      } else {
        $dataabsen = array(
          'message' => "Data Tidak Ditemukan"
        );
        echo json_encode($dataabsen);
      }
    }

    public function list_absen(){
      $nip = $this->input->post("nip");
      $cek = $this->db->query("SELECT *from tb_jadwal,tb_kelas,tb_mapel WHERE nip ='$nip' AND tb_kelas.id = tb_jadwal.id_kelas AND tb_mapel.id = tb_jadwal.id_mapel")->num_rows();
      if($cek){
        $cekinputabsen = $this->db->query("SELECT tb_jadwal.*, tb_kelas.nama as kelas, tb_mapel.nama as mapel from tb_jadwal,tb_kelas,tb_mapel WHERE nip = '$nip' AND tb_kelas.id = tb_jadwal.id_kelas AND tb_mapel.id = tb_jadwal.id_mapel GROUP by id_kelas,id_mapel")->result_array();
        $datainputabsen = array(
          'datainputabsen' => $cekinputabsen
        );
        echo json_encode($datainputabsen);
      } else {
        $datainputabsen = array(
          'message' => "Data tidak ditemukan"
        );
        echo json_encode($datainputabsen);
      }
    }

    public function absen_mapel(){
      $nis = $this->input->post('nis');
      $tanggal1 = $this->input->post('tanggal');

      $cek = $this->db->query("SELECT *from tb_absen_pelajaran,tb_guru,tb_mapel WHERE nis ='$nis' AND date_format(tanggal, '%Y-%m-%d') = '$tanggal1' AND tb_guru.nip = tb_absen_pelajaran.nip AND tb_mapel.id = tb_absen_pelajaran.id_mapel ")->num_rows();
      if($cek){
      $cekabsenmapel = $this->db->query("SELECT tb_absen_pelajaran.*, tb_guru.nama as guru, tb_mapel.nama as mapel from tb_absen_pelajaran,tb_guru,tb_mapel WHERE nis ='$nis' AND date_format(tanggal, '%Y-%m-%d') = '$tanggal1' AND tb_guru.nip = tb_absen_pelajaran.nip AND tb_mapel.id = tb_absen_pelajaran.id_mapel ")->result_array();
      // JOIN tb_guru tk ON ts.nip=tk.nip
        $absenresponmapel = array(
          'datamapel' => $cekabsenmapel
        );
        echo json_encode($absenresponmapel);
      }else {
  			$absenresponmapel = array(
  				'message' => "Data tidak ditemukan"
  			);
  			echo json_encode($absenresponmapel);
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

    public function input_absen(){
      $abseninput = $this->input->post('status_absen');
      $nip = $this->input->post('nip');
      $nis = $this->input->post('nis');
      $kelas = $this->input->post('id_kelas');
      $mapel = $this->input->post('id_mapel');
      $jam = $this->input->post('jam');

      $data = array(
        'nip' => $nip,
        'status_absen' => $abseninput,
        'nis' => $nis,
        'id_kelas' => $kelas,
        'id_mapel' => $mapel,
        'jam' => $jam
      );

      $this->db->insert("tb_absen_pelajaran",$data);

      $response = array(
        'stat' => 'true'
      );
      echo json_encode($response);
    }

    function tes(){
      $ket = $this->input->post('input_suket');
      $tgl = date('Y-m-d H:i:s');
      $foto = $this->input->post('foto');
      $nis = $this->input->post('nis');

    			// convert the image data from base64
    			$imgData = base64_decode($foto);
    			// set the image paths
    			$path = './foto/surat/';
    			$file = uniqid().'.png';
    			$file_path = $path.$file;

    			file_put_contents($file_path, $imgData);

                  $data = array(
                    'nis' => $nis,
                    'jenis' => $ket,
                    'tanggal' => $tgl,
                    'foto' => $file
                  );

         $this->db->insert("tb_keterangan",$data);

    		$response = array(
    			'stat' => 'true'
        );
        echo json_encode($response);
    	}

}
