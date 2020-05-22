<?php
class M_parameter_us extends CI_Model{

	function get_all(){
		$hsl=$this->db->query("SELECT * FROM tbl_parameter_us LEFT JOIN tbl_sifat_pengujian ON sp_id=pu_sp_id ORDER BY pu_id DESC");
		return $hsl;
	}
	function simpan($id,$pu,$metode){
		$hsl=$this->db->query("insert into tbl_parameter_us(parameter_us_id,parameter_us_uji_id,parameter_us_metode_id) values 
		('$id','$pu','$metode')");
		return $hsl;
	}
	function get_by_kode($kode){
		$hsl=$this->db->query("SELECT * FROM tbl_parameter_us
		LEFT JOIN tbl_acuan_metode ON tbl_parameter_us.parameter_us_metode_id=tbl_acuan_metode.acuan_metode_id LEFT JOIN tbl_satuan ON
		tbl_parameter_us.parameter_us_satuan_id=tbl_satuan.satuan_id  LEFT JOIN tbl_parameter_uji ON tbl_parameter_us.parameter_us_uji_id=tbl_parameter_uji.pu_id 
		LEFT JOIN tbl_sifat_pengujian ON tbl_parameter_uji.pu_sp_id=tbl_sifat_pengujian.sp_id where parameter_us_id='$kode'");
		return $hsl;
	}
	function get_by_fk($fk){
		$hsl=$this->db->query("SELECT * FROM tbl_parameter_us LEFT JOIN tbl_parameter_uji ON pu_id=parameter_us_uji_id 
		 LEFT JOIN tbl_sifat_pengujian ON sp_id=pu_sp_id where parameter_us_id='$fk'");
		return $hsl;
	}
	function update($id,$nama,$sp,$tarif){
		$hsl=$this->db->query("update tbl_parameter_us set pu_nama='$nama',pu_sp_id='$sp',pu_tarif='$tarif'
			where pu_id='$id'");
		return $hsl;
	}
	function update_hasil($id,$metode,$hasil,$satuan){
		$hsl=$this->db->query("update tbl_parameter_us set parameter_us_metode_id='$metode',parameter_us_satuan_id='$satuan',parameter_us_hasil='$hasil'
			where parameter_us='$id'");
		return $hsl;
	}
	function hapus($kode){
		$hsl=$this->db->query("delete from tbl_parameter_us where parameter_us_id='$kode'");
		return $hsl;
	}

	//Frontend
	function get_tentang(){
		$hsl=$this->db->query("SELECT * FROM tbl_parameter_us ORDER BY pu_id DESC");
		return $hsl;
	}

	function get_tentang_by_id($id){
		$hsl=$this->db->query("SELECT * FROM tbl_parameter_us where pu_id='$id'");
		return $hsl;
	}
	

}