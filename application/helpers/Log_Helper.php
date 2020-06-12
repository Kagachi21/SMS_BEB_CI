<?php
/**
*
*/
class Log_helper{
    public static function Insert($value) {
        $ci = get_instance();
        $arr = [
            'type' => $value['type'],
            'deskripsi' => $value['deskripsi'],
            'created_by' => $value['created_by'],
        ];
        $d = $ci->db->insert("log", $arr);
    }
}