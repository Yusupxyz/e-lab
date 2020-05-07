<?php
class M_setting extends CI_Model{

	function get_all(){
		$hsl=$this->db->query("SELECT * FROM tbl_setting");
		return $hsl;	
	}

	function get_by_kode($id){
		$hsl=$this->db->query("SELECT * FROM tbl_setting WHERE setting_id='$id'");
		return $hsl;	
	}

	//UPDATE PENGGUNA //
	function update($kode,$nama,$data){
		$hsl=$this->db->query("UPDATE tbl_setting set setting_nama='$nama',setting_data='$data' where setting_id='$kode'");
		return $hsl;
	}


}