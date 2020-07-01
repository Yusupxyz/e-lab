<?php
class M_setting_ttd extends CI_Model{

	function get_all(){
		$hsl=$this->db->query("SELECT * FROM tbl_setting_ttd LEFT JOIN tbl_golongan ON tbl_setting_ttd.st_golongan=tbl_golongan.golongan_kode");
		return $hsl;	
	}

	function get_by_kode($id){
		$hsl=$this->db->query("SELECT * FROM tbl_setting_ttd 
		 WHERE st_id='$id'");
		return $hsl;	
	}

	function update($kode,$nama,$golongan,$nip){
		$hsl=$this->db->query("UPDATE tbl_setting_ttd set st_nama='$nama',st_golongan='$golongan',st_nip='$nip' where st_id='$kode'");
		return $hsl;
	}

	// get data dropdown
    function dd()
    {
        $this->db->order_by('golongan_kode', 'ASC');
        $result = $this->db->get('tbl_golongan');
        $dd[''] = '-- Pilih Golongan --';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $dd[$row->golongan_kode] = $row->golongan_nama;
            }
        }
        return $dd;
    }


}