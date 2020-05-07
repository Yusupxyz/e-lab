<?php
class M_am extends CI_Model{

	function get_all(){
		$hsl=$this->db->query("SELECT * FROM tbl_acuan_metode ORDER BY acuan_metode_id DESC");
		return $hsl;
	}
	function simpan($nama,$pdf){
		$hsl=$this->db->query("insert into tbl_acuan_metode(acuan_metode_nama,acuan_metode_doc) values 
		('$nama','$pdf')");
		return $hsl;
	}
	function get_by_kode($kode){
		$hsl=$this->db->query("SELECT * FROM tbl_acuan_metode where acuan_metode_id='$kode'");
		return $hsl;
	}
	function update($id,$nama,$pdf){
		$hsl=$this->db->query("update tbl_acuan_metode set acuan_metode_nama='$nama',acuan_metode_doc='$pdf'
			where acuan_metode_id='$id'");
		return $hsl;
	}
	function update_tanpa_pdf($id,$nama){
		$hsl=$this->db->query("update tbl_acuan_metode set acuan_metode_nama='$nama'
			where acuan_metode_id='$id'");
		return $hsl;
	}
	function hapus($kode){
		$hsl=$this->db->query("delete from tbl_acuan_metode where acuan_metode_id='$kode'");
		return $hsl;
	}

	// get data dropdown
    function dd()
    {
        $this->db->order_by('acuan_metode_id', 'ASC');
        $result = $this->db->get('tbl_acuan_metode');
        $dd[''] = '-- Pilih Acuan Metode --';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $dd[$row->acuan_metode_id] = $row->acuan_metode_nama;
            }
        }
        return $dd;
    }
}