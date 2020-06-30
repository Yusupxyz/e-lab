<?php
class M_pu extends CI_Model{

	function get_all(){
		$hsl=$this->db->query("SELECT * FROM tbl_parameter_uji LEFT JOIN tbl_satuan ON tbl_satuan.satuan_id=
		tbl_parameter_uji.pu_satuan_id LEFT JOIN tbl_sifat_pengujian  ON sp_id=pu_sp_id ORDER BY pu_id DESC");
		return $hsl;
	}
	function simpan($nama,$sp,$tarif,$mutu,$satuan,$status){
		$hsl=$this->db->query("insert into tbl_parameter_uji(pu_nama,pu_sp_id,pu_tarif,pu_mutu,pu_satuan_id,pu_status_alat_bahan) values 
		('$nama','$sp','$tarif','$mutu','$satuan','$status')");
		return $hsl;
	}
	function get_by_kode($kode){
		$hsl=$this->db->query("SELECT * FROM tbl_parameter_uji where pu_id='$kode'");
		return $hsl;
	}
	function get_by_fk($fk){
		$hsl=$this->db->query("SELECT * FROM tbl_parameter_uji where pu_sp_id='$fk'");
		return $hsl;
	}
	function update($id,$nama,$sp,$tarif,$mutu,$satuan,$status){
		$hsl=$this->db->query("update tbl_parameter_uji set pu_nama='$nama',pu_sp_id='$sp',pu_tarif='$tarif',pu_mutu='$mutu',pu_satuan_id='$satuan',pu_status_alat_bahan='$status'
			where pu_id='$id'");
		return $hsl;
	}
	function hapus($kode){
		$hsl=$this->db->query("delete from tbl_parameter_uji where pu_id='$kode'");
		return $hsl;
	}

	//Frontend
	function get_tentang(){
		$hsl=$this->db->query("SELECT * FROM tbl_parameter_uji ORDER BY pu_id DESC");
		return $hsl;
	}

	function get_tentang_by_id($id){
		$hsl=$this->db->query("SELECT * FROM tbl_parameter_uji where pu_id='$id'");
		return $hsl;
	}
	

}