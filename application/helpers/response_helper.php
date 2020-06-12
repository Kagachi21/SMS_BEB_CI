<?php
/**
*
*/
class Response_helper
{

	public static function part($file)
	{
		$ci = get_instance();
		// echo $ci->uri->segment(2);
		include str_replace("system", "application/views/", BASEPATH) . "part/$file.php";
	}
	public static function date($date){
		return date('d M Y', strtotime($date));
	}
	public static function time($time, $full = false)
	{
		$now = new DateTime;
		$ago = new DateTime($time);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
	public static function price($n, $precision = 2)
	{
		$re = "Rp ".number_format($n, 0,',','.');
		// $ci = get_instance();
		// $cek = $ci->db->get_where("pengaturan_app", ['kode' => 1])->row_array();
		// if($cek['format_view_price'] == '2'){

		// 	if ($n < 900) {
		// 		// 0 - 900
		// 		$n_format = number_format($n, $precision,',','.');
		// 		$suffix = '';
		// 	} else if ($n < 900000) {
		// 		// 0.9k-850k
		// 		$n_format = number_format($n / 1000, $precision,',','.');
		// 		$suffix = 'K';
		// 	} else if ($n < 900000000) {
		// 		// 0.9m-850m
		// 		$n_format = number_format($n / 1000000, $precision,',','.');
		// 		$suffix = 'JT';
		// 	} else if ($n < 900000000000) {
		// 		// 0.9b-850b
		// 		$n_format = number_format($n / 1000000000, $precision,',','.');
		// 		$suffix = 'M';
		// 	} else {
		// 		// 0.9t+
		// 		$n_format = number_format($n / 1000000000000, $precision,',','.');
		// 		$suffix = 'T';
		// 	}
		 
		// 	if ( $precision > 0 ) {
		// 		$dotzero = '.' . str_repeat( '0', $precision );
		// 		$n_format = str_replace( $dotzero, '', $n_format );
		// 	}
		 
		// 	$re = $re.' ('.$n_format . $suffix.')';
		// }
		return $re;
	}
	
	public static function duit($n)
	{
		$re = number_format($n, 0,',','.');
		return $re;
	}

	public static function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return trim($temp);
	}
 
	// function terbilang($nilai) {
	// 	if($nilai<0) {
	// 		$hasil = "minus ". trim(penyebut($nilai));
	// 	} else {
	// 		$hasil = trim(penyebut($nilai));
	// 	}     		
	// 	return $hasil;
	// }

	public static function tanggal($tgl)
	{
		$qq='';
		$k = explode("-",$tgl);
		$bln = array('', 'Januari', 'Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember' );
		$qq = $k[2].' '.$bln[(int)$k[1]].' '.$k[0];
		return $qq;
	}
	public static function tanggalbulan($tgl)
	{
		$qq='';
		$k = explode("-",$tgl);
		$bln = array('', 'Januari', 'Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember' );
		$qq = $bln[(int)$k[0]].' '.$k[1];
		return $qq;
	}
	public static function bulantahun($tgl)
	{
		$qq='';
		$k = explode("-",$tgl);
		$bln = array('', 'Januari', 'Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember' );
		$qq = $bln[(int)$k[1]].' '.$k[0];
		return $qq;
	}
	public static function tanggalrange($tgl)
	{
		$qq='';
		$k = explode("/",$tgl);
		$bln = array('', 'Januari', 'Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember' );
		$qq = $k[1].' '.$bln[(int)$k[0]].' '.$k[2];
		return $qq;
	}
	public static function waktu($tgl)
	{
		$qq='';
		$k = explode(" ",$tgl);
		$kk = explode("-",$k[0]);
		$bln = array('', 'Januari', 'Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember' );
		
		$qq = $kk[2].' '.$bln[(int)$kk[1]].' '.$kk[0].' '.$k[1];
		return $qq;
	}
	public static function waktupersen($tgl)
	{
		$qq='';
		$k = explode("%",$tgl);
		$kk = explode("-",$k[0]);
		$bln = array('', 'Januari', 'Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember' );
		
		$qq = $kk[2].' '.$bln[(int)$kk[1]].' '.$kk[0].' '.$k[1];
		return $qq;
	}
	public static function render($file, $var = []){
		extract($var);
		include str_replace("system", "application/views", BASEPATH)."/".$file.".php";
	}
	public static function get_nama_karyawan($kode_rab)
	{
		$ci = get_instance();
		$cekData = $ci->db->get_where("karyawan", ['kode_karyawan' => $kode_rab])->row_array();
		return $cekData['nama_karyawan'];
	}

	public static function hari_ini(){
		$hari = date ("D");
	
		switch($hari){
			case 'Sun':
				$hari_ini = "Minggu";
			break;
	
			case 'Mon':			
				$hari_ini = "Senin";
			break;
	
			case 'Tue':
				$hari_ini = "Selasa";
			break;
	
			case 'Wed':
				$hari_ini = "Rabu";
			break;
	
			case 'Thu':
				$hari_ini = "Kamis";
			break;
	
			case 'Fri':
				$hari_ini = "Jumat";
			break;
	
			case 'Sat':
				$hari_ini = "Sabtu";
			break;
			
			default:
				$hari_ini = "Tidak di ketahui";		
			break;
		}
	
		return $hari_ini;
	
	}
	public static function cetak($kata){
		return htmlentities($kata, ENT_QUOTES, 'UTF-8');

	}

	public static function rentangwaktu($mulai, $akhir, $tipe = 1){
		$lama = '';
		$date1 = new DateTime($mulai);
		$date2 = new DateTime($akhir);
		$interval = $date2->diff($date1);
		if($tipe == 1){	
			$lama = $interval->format('%Y Tahun, %m Bulan, %d Hari');
		}else if($tipe == 2){	
			$lama = $interval->format('%m Bulan, %d Hari');
		}else if($tipe == 3){	
			$lama = $interval->format('%d Hari');
		}else if($tipe == 4){	
			$lama = $interval->format('%d Hari %h Jam');
		}

		return $lama;
	}

	
	public static function getformatfile($file){
		$lama = '';
		
		$fr = explode(".", $file);
		$lama = $fr[1];

		return $lama;
	}
}
