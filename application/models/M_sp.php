<?php
class M_sp extends CI_Model{

	function get_all(){
		$hsl=$this->db->query("SELECT * FROM tbl_sifat_pengujian ORDER BY sp_id ASC");
		return $hsl;
	}
	function simpan_sp($sifat){
		$hsl=$this->db->query("insert into tbl_sifat_pengujian(sp_jenis) values 
		('$sifat')");
		return $hsl;
	}
	function get_tentang_by_kode($kode){
		$hsl=$this->db->query("SELECT * FROM tbl_sifat_pengujian where sp_id='$kode'");
		return $hsl;
	}
	function update($id,$sifat){
		$hsl=$this->db->query("update tbl_sifat_pengujian set sp_jenis='$sifat'
			where sp_id='$id'");
		return $hsl;
	}
	function hapus($kode){
		$hsl=$this->db->query("delete from tbl_sifat_pengujian where sp_id='$kode'");
		return $hsl;
	}

	// get data dropdown
    function dd()
    {
        $this->db->order_by('sp_id', 'ASC');
        $result = $this->db->get('tbl_sifat_pengujian');
        $dd[''] = '-- Pilih Sifat Pengujian --';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $dd[$row->sp_id] = $row->sp_jenis;
            }
        }
        return $dd;
    }
}