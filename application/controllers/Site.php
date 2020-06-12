<?php
class Site extends CI_Controller { //mengextends CI_Controller 
    public function __construct(){
        parent::__construct();
    }
    public function index () {
        $data['title'] = "Home Page";
        $data['content'] = "home/index";
		$this->load->view('frontend/index',$data);
    }
    public function getSiswa($id){
        $q = $this->db->get_where("tb_siswa", ['id_kelas' => $id])->result_array();
        echo json_encode($q);
    }
    public function getMapel($id){
        $q = $this->db->query("SELECT * FROM tb_kelas where id='$id'")->row_array();
        $qq = $this->db->query("SELECT * FROM tb_mapel where jurusan='$q[tipe_kelas]'")->result_array();
        echo json_encode($qq);
    }
    public function cekJadwal($kelas, $hari, $jam){
        $d = $this->db->get_where("tb_jadwal", ['id_kelas' => $kelas, 'hari' => $hari, 'jam'=> $jam])->num_rows();
        if($d > 0){
            echo "Jam sudah dipakai jadwal lain";
        }
    }
    public function getJam($hari, $mapel, $kelas){
        $qq = $this->db->query("SELECT * FROM tb_jadwal where id_kelas='$kelas' and id_mapel='$mapel' and hari='$hari'")->result_array();
        $data = $qq;
        $loop = [];
        for ($i=1; $i <= 10; $i++) { 
            if (!in_array($i, $data)) {
                $loop[] = $i;
            }
        }
        echo json_encode($loop);
    }
    public function cekNis($nis){
        $d = $this->db->get_where("tb_siswa", ['nis' => $nis])->num_rows();
        if($d > 0){
            echo "Nis Sudah Dipakai";
        }
    }
    public function cekNik($nik){
        $d = $this->db->get_where("tb_ortu", ['nik' => $nik])->num_rows();
        if($d > 0){
            echo "Nik Sudah Dipakai Orang Tua";
        }
    }
    public function cekNisOrtu($nis){
        $d = $this->db->get_where("tb_ortu", ['nis' => $nis])->num_rows();
        if($d > 0){
            echo "Nis yang anda masukan telah memiliki wali";
        }
    }
    public function cekNip($val){
        $d = $this->db->get_where("tb_guru", ['nip' => $val])->num_rows();
        if($d > 0){
            echo "Nip Sudah Dipakai";
        }
    }
    public function absen(){
        $p = $_POST;
        $now = date("Y-m-d");
        $nis = $p['nis'];
        $datetime = date('Y-m-d H:i:s');
        $time = intval(gmdate(date("h"), 60));
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
                    $this->session->set_flashdata("message", ['success', "Berhasil Absen", ' Berhasil']);
                    redirect(base_url()."dashboard/siswa/scan");
				}else{
                    $this->session->set_flashdata("message", ['warning', "Anda Sudah Absen", ' Berhasil']);
                    redirect(base_url()."dashboard/siswa/scan");
                }
			}else{
				$cek = $this->db->query("SELECT * FROM tb_absen_harian where nis='$nis' and tanggal like '%$now%' and type='2'");
				if($cek->num_rows() < 1){
					$status = 'Pulang';
                    $this->db->insert("tb_absen_harian", ['nis' => $nis, 'status_absen' => $status,'tanggal' => $datetime, 'id_kelas' => $data['id_kelas'], 'type' => '2']);
                    $this->session->set_flashdata("message", ['success', "Berhasil Absen", ' Berhasil']);
                    redirect(base_url()."dashboard/siswa/scan");
				}else{
                    $this->session->set_flashdata("message", ['warning', "Anda Sudah Absen", ' Berhasil']);
                    redirect(base_url()."dashboard/siswa/scan");
                }
			}
        }else{
            // echo "Qrcode tidak valid";
            $this->session->set_flashdata("message", ['danger', "Qrcode tidak valid", ' Berhasil']);
            redirect(base_url()."dashboard/siswa/scan");
        }
    }
    public function daftar(){
        $this->load->view("frontend/register");
    }
    public function doLogin(){
        $d = $_POST;
        if(!$d){
            redirect(base_url(""));
        }
        try {
            if($d){
                $username = $d['username'];
                $password = $d['password'];
                $a = $this->db->get_where("tb_siswa", ['nis' => $username, 'password' => $password]);

                if($a->num_rows() > 0) {
                    $data = $a->row_array();
                    $_SESSION['nis'] = $data['nis'];
                    $_SESSION['level'] = "siswa";
                    $_SESSION['username'] = $data['nama'];
                    redirect(base_url('user/dashboard'));
                }else{
                    $a = $this->db->get_where("tb_ortu", ['username' => $username, 'password' => $password]);
                    if($a->num_rows() > 0) {
                        $data = $a->row_array();
                        $_SESSION['nik'] = $data['nik'];
                        $_SESSION['nis'] = $data['nis'];
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['level'] = "ortu";
                        redirect(base_url('user/dashboard'));
                    }else{
                        $a = $this->db->get_where("tb_guru", ['nip' => $username, 'password' => $password]);
                        if($a->num_rows() > 0) {
                            $data = $a->row_array();
                            $_SESSION['nip'] = $data['nip'];
                            $_SESSION['username'] = $data['nama'];
                            $_SESSION['level'] = "guru";
                            redirect(base_url('guru/absen/absensi_mapel'));
                        }else{
                            $a = $this->db->get_where("tb_admin", ['username' => $username, 'password' => $password]);
                            if($a->num_rows() > 0) {
                                $data = $a->row_array();
                                $_SESSION['id_admin'] = $data['id_admin'];
                                $_SESSION['level'] = "admin";
                                $_SESSION['username'] = $data['username'];
                                redirect(base_url('dashboard/siswa'));
                            }else{
                                // echo "gagal";
                                $this->session->set_flashdata("message", ['danger', "Username Atau Password Salah", ' Berhasil']);
                                redirect(base_url());
                            }
                        }
                    }
    
                }

                // $_SESSION['userid'] = $a['id'];
                // $_SESSION['userlevel'] = $a['level'];
                // redirect(base_url("admin/dashboard"));
            }
        }
        catch(Exception $e) {
            // $this->login();
            echo "gagal";
        }
    }
    public function doRegister(){
        $d = $_POST;
        if(!$d){
            redirect(base_url(""));
        }
        try {
            if($d){
                $nik = $d['nik'];
                $username = $d['username'];
                $nis = $d['nis'];
                $password = $d['password'];
                $a = $this->db->get_where("tb_ortu", ['nik' => $nik]);

                if($a->num_rows() > 0) {
                    $this->session->set_flashdata("message", ['danger', "Nik Sudah Digunakan", ' Berhasil']);
                    return $this->daftar();
                }else{
                    $z = $this->db->get_where("tb_siswa", ['nis' => $nis]);
                    if($z->num_rows() < 1){
                        $this->session->set_flashdata("message", ['danger', "Nis Tidak Terdaftar", ' Berhasil']);
                        return $this->daftar();
                    }else{
                        $b = $this->db->get_where("tb_ortu", ['nis' => $nis]);
                        if($b->num_rows() > 0) {
                            $this->session->set_flashdata("message", ['danger', "Nis Sudah Memiliki Orang Tua", ' Berhasil']);
                            return $this->daftar();
                        }else{
                            $arr = [
                                'nik' => $nik,
                                'nis' => $nis,
                                'username' => $username,
                                'password' => $password,
                                'foto_ktp' => '1',
                                'kode' => 'user'
                            ];
                            $this->db->insert("tb_ortu", $arr);
                            $this->session->set_flashdata("message", ['success', "Berhasil Daftar", ' Berhasil']);
                            redirect(base_url('site/daftar'));
                        }
                    }
    
                }

                // $_SESSION['userid'] = $a['id'];
                // $_SESSION['userlevel'] = $a['level'];
                // redirect(base_url("admin/dashboard"));
            }
        }
        catch(Exception $e) {
            // $this->login();
            echo "gagal";
        }
    }
    public function logout(){
        // session_unset("userid");
        // session_unset("userlevel");
        session_destroy();
        redirect(base_url());
    }
}
?>