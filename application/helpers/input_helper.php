<?php
/**
*
*/
class Input_helper
{
	
	public static function postOrOr($index, $a = '', $b = '')
	{
		if(isset($_POST[$index]) && $_POST[$index]!='')
			return $_POST[$index];
		else if(isset($a))
			return $a;
		return $b;
	}
	public static function randomString($length){
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$char = '';
		for ($i=0; $i < $length; $i++) {
			$char.=$chars[rand(0, strlen($chars)-1)];
		}
		return $char;
	}
	public static function uploadImage($file, $dir, $name){

		move_uploaded_file($file['tmp_name'], str_replace("system", "foto/", BASEPATH)."/$dir/$name");
	}
	public static function validateTypeUpload($array, $file){
            
        if(in_array($file['type'], $array)){
            return true;
        }else{
            return false;
        }
    }
    public static function validateSizeUpload($limit, $file){
        // 39092  = 39 kb
        if($file['size'] > $limit){
            return false;
        }else{
            return true;
        }
    }
	public static function bersihkanangka($kalimat){
		$re = array();
		$re[0] = ".";
		$re[1] = ",";
		$re[2] = "-";
		$dat = array();
		$dat[0] = "";
		$dat[1] = "";
		$dat[2] = "";
		return str_replace($re, $dat, $kalimat);
	}
	
	public static function kata($kalimat){
		$re = array();
		$re[0] = "<";
		$re[1] = ">";
		$re[2] = "</";
		$re[3] = "/>";
		$re[4] = "http";
		$re[5] = "https";
		$dat = array();
		$dat[0] = "";
		$dat[1] = "";
		$dat[2] = "";
		$dat[3] = "";
		$dat[4] = "";
		$dat[5] = "";
		return str_replace($re, $dat, $kalimat);
	}
	
	public static function getbulansebelumnya($d){

		$bln = '';

		$th = explode("-", $d);
		if((int)$th[1] > 10){
			$bln = $th[0].'-'.($th[1] - 1);
		}else if((int)$th[1] == 1){
			$bln = ($th[0]-1).'-0'.($th[1] - 1);
		}else if((int)$th[1] < 10){
			$bln = $th[0].'-0'.($th[1] - 1);
		}
		return $bln;
	}
}
