<?php
class M_jw extends CI_Model{

	function get_all(){
		$hsl=$this->db->query("SELECT * FROM tbl_jenis_wadah ORDER BY jw_id DESC");
		return $hsl;
	}
	function simpan($jenis,$kode){
		$hsl=$this->db->query("insert into tbl_jenis_wadah(jw_nama,jw_kode) values 
		('$jenis','$kode')");
		return $hsl;
	}
	function get_tentang_by_kode($kode){
		$hsl=$this->db->query("SELECT * FROM tbl_jenis_wadah where jw_id='$kode'");
		return $hsl;
	}
	function update($id,$jenis,$kode){
		$hsl=$this->db->query("update tbl_jenis_wadah set jw_nama='$jenis',jw_kode='$kode'
			where jw_id='$id'");
		return $hsl;
	}
	function hapus($kode){
		$hsl=$this->db->query("delete from tbl_jenis_wadah where jw_id='$kode'");
		return $hsl;
	}

	// get data dropdown
    function dd()
    {
        $this->db->order_by('jw_kode', 'ASC');
        $result = $this->db->get('tbl_jenis_wadah');
        $dd[''] = '-- Pilih Jenis Wadah --';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $dd[$row->jw_id] = $row->jw_nama.' ('.$row->jw_kode.')';
            }
        }
        return $dd;
    }
}