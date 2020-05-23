<?php
class M_satuan extends CI_Model{

	function get_all(){
		$hsl=$this->db->query("SELECT * FROM tbl_satuan ORDER BY satuan_nama ASC");
		return $hsl;
	}
	function simpan($satuan){
		$hsl=$this->db->query("insert into tbl_satuan(satuan_nama) values 
		('$satuan')");
		return $hsl;
	}
	function get_by_kode($kode){
		$hsl=$this->db->query("SELECT * FROM tbl_satuan where satuan_id='$kode'");
		return $hsl;
	}
	function update($id,$satuan){
		$hsl=$this->db->query("update tbl_satuan set satuan_nama='$satuan'
			where satuan_id='$id'");
		return $hsl;
	}
	function hapus($kode){
		$hsl=$this->db->query("delete from tbl_satuan where satuan_id='$kode'");
		return $hsl;
	}

	// get data dropdown
    function dd()
    {
        $this->db->order_by('satuan_nama', 'ASC');
        $result = $this->db->get('tbl_satuan');
        $dd[''] = '-- Pilih Satuan --';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $dd[$row->satuan_id] = $row->satuan_nama;
            }
        }
        return $dd;
    }
}