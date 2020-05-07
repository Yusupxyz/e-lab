<?php
class M_anggota extends CI_Model{

	function get_all_anggota(){
		$id=$this->session->userdata('idadmin');
		$hsl=$this->db->query("SELECT * FROM tbl_anggota where anggota_id='$id'");
		return $hsl;	
	}

	function simpan_anggota($nama,$username,$password,$alamat,$personil,$jl,$kontak){
		$hsl=$this->db->query("INSERT INTO tbl_anggota (anggota_nama,anggota_username,anggota_password,anggota_alamat,anggota_personil,anggota_jenis_kelamin,anggota_kontak) VALUES ('$nama','$username',md5('$password'),'$alamat','$personil','$jl','$kontak')");
		return $hsl;
	}

	//UPDATE anggota //
	function update_anggota($kode,$nama,$username,$alamat,$personil,$jl,$kontak){
		$hsl=$this->db->query("UPDATE tbl_anggota set anggota_nama='$nama',anggota_username='$username',anggota_alamat='$alamat',anggota_personil='$personil',anggota_jenis_kelamin='$jl',anggota_kontak='$kontak' where anggota_id='$kode'");
		return $hsl;
	}

	function count_anggota(){
		$hsl=$this->db->query("SELECT count(*) as 'count' FROM tbl_anggota");
		return $hsl;
	}

	//END UPDATE anggota//

	function hapus_anggota($kode){
		$hsl=$this->db->query("DELETE FROM tbl_anggota where anggota_id='$kode'");
		return $hsl;
	}
	function getusername($id){
		$hsl=$this->db->query("SELECT * FROM tbl_anggota where anggota_id='$id'");
		return $hsl;
	}
	function resetpass($id,$pass){
		$hsl=$this->db->query("UPDATE tbl_anggota set anggota_password=md5('$pass') where anggota_id='$id'");
		return $hsl;
	}
	function cek_username($username){
		$hsl=$this->db->query("SELECT count(*) as count FROM tbl_anggota where anggota_username='$username'");
		return $hsl;
	}


}