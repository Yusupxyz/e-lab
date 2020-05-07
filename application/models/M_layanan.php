<?php
class M_layanan extends CI_Model{

	function get_all_layanan(){
		$hsl=$this->db->query("SELECT * FROM tbl_layanan ORDER BY layanan_id DESC");
		return $hsl;
	}
	function simpan_layanan($penjelasan,$nama,$gambar){
		$hsl=$this->db->query("insert into tbl_layanan(layanan_nama,layanan_ikon,layanan_teks) values 
		('$nama','$gambar','$penjelasan')");
		return $hsl;
	}
	function get_layanan_by_kode($kode){
		$hsl=$this->db->query("SELECT * FROM tbl_layanan where layanan_id='$kode'");
		return $hsl;
	}
	function update_layanan($id,$nama,$penjelasan,$gambar){
		$hsl=$this->db->query("update tbl_layanan set layanan_nama='$nama',layanan_ikon='$gambar',layanan_teks='$penjelasan'
			where layanan_id='$id'");
		return $hsl;
	}
	function update_layanan_tanpa_img($id,$nama,$penjelasan){
		$hsl=$this->db->query("update tbl_layanan set layanan_nama='$nama',layanan_teks='$penjelasan'
		where layanan_id='$id'");
		return $hsl;
	}
	function hapus_layanan($kode){
		$hsl=$this->db->query("delete from tbl_layanan where layanan_id='$kode'");
		return $hsl;
	}

	//Frontend
	function get_layanan(){
		$hsl=$this->db->query("SELECT * FROM tbl_layanan ORDER BY layanan_id DESC");
		return $hsl;
	}

	function get_layanan_per_page($offset,$limit){
		$hsl=$this->db->query("SELECT * FROM tbl_layanan ORDER BY layanan_id DESC LIMIT $offset,$limit");
		return $hsl;
	}

	function get_layanan_by_id($id){
		$hsl=$this->db->query("SELECT * FROM tbl_layanan where layanan_id='$id'");
		return $hsl;
	}
	

}