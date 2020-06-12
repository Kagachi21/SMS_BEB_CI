<?php
/**
*
*/
class Auth_helper{
    
    public static function secure(){
        if(!isset($_SESSION['userid'])){
            redirect(base_url());
        }
    }
    public static function Get($index) {
        $ci = get_instance();
        // $d = $a->Select($index, "WHERE id = $_SESSION[userid]");
        $d = $ci->db->get_where("pengguna", ['id' => "$_SESSION[userid]"])->row_array();
        // $ci->db->get_where("akunbank", ['kode_akunbank' => $kode_sumber])->row_array();
        return $d[$index];
    }
}