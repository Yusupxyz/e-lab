<?php
class M_tentang extends CI_Model{

	function get_all_tentang(){
		$hsl=$this->db->query("SELECT * FROM tbl_tentang ORDER BY tentang_id DESC");
		return $hsl;
	}
	function simpan_tentang($isi,$judul){
		$hsl=$this->db->query("insert into tbl_tentang(tentang_judul,tentang_isi) values 
		('$judul','$isi')");
		return $hsl;
	}
	function get_tentang_by_kode($kode){
		$hsl=$this->db->query("SELECT * FROM tbl_tentang where tentang_id='$kode'");
		return $hsl;
	}
	function update_tentang($id,$judul,$isi){
		$hsl=$this->db->query("update tbl_tentang set tentang_judul='$judul',tentang_isi='$isi'
			where tentang_id='$id'");
		return $hsl;
	}
	function hapus_tentang($kode){
		$hsl=$this->db->query("delete from tbl_tentang where tentang_id='$kode'");
		return $hsl;
	}

	//Frontend
	function get_tentang(){
		$hsl=$this->db->query("SELECT * FROM tbl_tentang ORDER BY tentang_id DESC");
		return $hsl;
	}

	function get_tentang_by_id($id){
		$hsl=$this->db->query("SELECT * FROM tbl_tentang where tentang_id='$id'");
		return $hsl;
	}
	

}