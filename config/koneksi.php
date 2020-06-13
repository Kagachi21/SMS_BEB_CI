<?php
  // fungsi mysqli_connect() untuk koneksi ke host
  // disimpan dalam variabel $host
  $koneksi = mysqli_connect("localhost","root","051299");
  date_default_timezone_set("Asia/Jakarta");
  // untuk mengkoneksikan dengan database db_sekolah\
  // disimpan dalam variabel $db
  $db = mysqli_select_db($koneksi, "db_sms");
  $jk = ['Perempuan', 'Laki Laki'];
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  function postOrOr($index, $a = '', $b ='') {
      if(isset($_POST[$index]) && $_POST[$index] != '')
          return $_POST[$index];
      else if(isset($a))
          return $a;
      return $b;
  }
  function Update($data, $where, $table = '') {
        global $koneksi;
        $q = "UPDATE ". $table ." SET ";
        $i = 0;

        foreach($data as $v => $d) {
            $q .= " $v = '$d' ";
            // echo $d;
            if(++$i < count($data))
                $q .= ", ";
        }

        $q .= " $where";
        $qu = mysqli_query($koneksi, $q);
        if ($qu) {
          return true;
        }else{
          return false;
        }
  }
  function insert($data, $table){
    global $koneksi;
    $q = "INSERT INTO ". $table ." (".implode(',', array_keys($data)).") VALUES ('".implode("', '", array_values($data))."')";
    $qu = mysqli_query($koneksi, $q);
    if ($qu) {
      return true;
    }else{
      return false;
    }
  }
  function Delete($where, $table = '') {
    global $koneksi;
    $q = "DELETE FROM " . $table . " $where";
    $qu = mysqli_query($koneksi, $q);
    if ($qu) {
      return true;
    }else{
      return false;
    }
  }

?>
