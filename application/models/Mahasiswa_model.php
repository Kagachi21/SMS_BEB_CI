<?php
class Mahasiswa_model extends CI_Model{
    // public function get_data(){
    //     $data_mahasiswa = [["nama"=>"Kim Jefry","prodi"=>"MIF"],
    //             ["nama"=>"Ahmad Kurniawan","prodi"=>"TKK"],
    //             ["nama"=>"Budi Sudarsono","prodi"=>"TIF"]];

    //         return $data_mahasiswa;
    // }

    function getAll(){
        $this->db->select('*');
        $this->db->from('tm_user');
        $this->db->join('tm_grup', 'tm_user.grup = tm_grup.id_grup');
        $query = $this->db->get();
        return $query;
    }

    function getGrup(){
      $this->db->order_by('id_grup', 'ASC');
      return $this->db->from('tm_grup')
      ->get()
      ->result();
    }

    function input_data($data,$table){
        $this->db->insert($table,$data);
    }

    function edit_data($where,$table){
      return $this->db->get_where($table,$where);
    }

    function update_data($where,$data,$table){
      $this->db->where($where);
      $this->db->update($table,$data);
    }

    function hapus_data($where,$table){
      $this->db->where($where);
      $this->db->delete($table);
    }

    function login($username,$password,$table){
        $this->db->select('*');
        $this->db->from('tm_user');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get();
        return $query;
    }
}

?>
