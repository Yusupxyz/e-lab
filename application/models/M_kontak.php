<?php
class M_kontak extends CI_Model{

	//kontak
	function get_all_kontak(){
		$hsl=$this->db->query("SELECT * FROM tbl_kontak ORDER BY kontak_id ASC");
		return $hsl;
	}

	function update_kontak($kode,$data){
		$hsl=$this->db->query("update tbl_kontak set kontak_data='$data' where kontak_id='$kode'");
		return $hsl;
	}

	//inbox

	function kirim_pesan($nama,$email,$pesan){
		$hsl=$this->db->query("INSERT INTO tbl_inbox(inbox_nama,inbox_email,inbox_pesan) VALUES ('$nama','$email','$pesan')");
		return $hsl;
	}

	function get_all_inbox(){
		$hsl=$this->db->query("SELECT tbl_inbox.*,DATE_FORMAT(inbox_tanggal,'%d %M %Y') AS tanggal FROM tbl_inbox ORDER BY inbox_id DESC");
		return $hsl;
	}

	function hapus_kontak($kode){
		$hsl=$this->db->query("DELETE FROM tbl_inbox WHERE inbox_id='$kode'");
		return $hsl;
	}

	function update_status_kontak(){
		$hsl=$this->db->query("UPDATE tbl_inbox SET inbox_status='0'");
		return $hsl;
	}

	//outbox
	function get_all_outbox(){
		$hsl=$this->db->query("SELECT tbl_outbox.*,tbl_inbox.*,DATE_FORMAT(outbox_tanggal,'%d %M %Y') AS tanggal FROM tbl_outbox LEFT JOIN tbl_inbox ON tbl_outbox.inbox_id=tbl_inbox.inbox_id ORDER BY outbox_id DESC");
		return $hsl;
	}

	function simpan_outbox($kode,$subject,$pesan){
		$hsl=$this->db->query("INSERT INTO tbl_outbox(inbox_id,outbox_sub,outbox_msg) VALUES ('$kode','$subject','$pesan')");
		return $hsl;
	}

	function get_outbox_by_id($id){
		$hsl=$this->db->query("SELECT count(*) as 'count' FROM tbl_outbox WHERE inbox_id='$id'");
		return $hsl;
	}

	function hapus_outbox($kode){
		$hsl=$this->db->query("DELETE FROM tbl_outbox WHERE outbox_id='$kode'");
		return $hsl;
	}

}