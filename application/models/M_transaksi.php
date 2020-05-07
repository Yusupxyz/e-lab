<?php
class M_transaksi extends CI_Model{

	function get_all(){
		$hsl=$this->db->query("SELECT * FROM tbl_transaksi ORDER BY status_id DESC");
		return $hsl;
	}
	function simpan($id,$bayar){
		$hsl=$this->db->query("insert into tbl_transaksi(transaksi_us,transaksi_bayar) values 
		('$id','$bayar')");
		return $hsl;
	}
	function get_by_kode($kode){
		$hsl=$this->db->query("SELECT * FROM tbl_transaksi where status_id='$kode'");
		return $hsl;
	}
	function update($id,$nama,$class){
		$hsl=$this->db->query("update tbl_transaksi set status_nama='$nama',status_class='$class'
			where status_id='$id'");
		return $hsl;
	}
	function hapus($kode){
		$hsl=$this->db->query("delete from tbl_transaksi where status_id='$kode'");
		return $hsl;
	}

	// get data dropdown
    function dd()
    {
        $this->db->order_by('status_class', 'ASC');
        $result = $this->db->get('tbl_transaksi');
        $dd[''] = '-- Pilih Class --';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $dd[$row->status_id] = $row->status_nama.' ('.$row->status_class.')';
            }
        }
        return $dd;
	}
	
	// get data dropdown
    function dd2()
    {
        $this->db->order_by('status_id', 'ASC');
        $result = $this->db->get('tbl_transaksi');
        $dd[''] = '-- Pilih Status --';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $dd[$row->status_id] = $row->status_nama;
            }
        }
        return $dd;
    }
}