<?php
class ArtikelModel extends CI_model {
    public function get (){
        $this->load->database();
        return $this->db->get("artikel")->result();
    }
}
?>