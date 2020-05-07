<?php
class M_login extends CI_Model{
    function cekadmin($username,$password){
        $hasil=$this->db->query("SELECT * FROM tbl_pengguna WHERE pengguna_username='$username' AND pengguna_password=md5('$password')");
        echo $this->db->last_query();;
        return $hasil;
    }

    function cekanggota($username,$password){
        $hasil=$this->db->query("SELECT * FROM tbl_anggota WHERE anggota_username='$username' AND anggota_password=md5('$password')");
        return $hasil;
    }

    function get_login($id_admin){
        $hasil=$this->db->query("SELECT * FROM tbl_anggota WHERE anggota_id='$id_admin'");
        return $hasil;
    }
  
}
