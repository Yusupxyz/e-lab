<?php
class M_js extends CI_Model{

	function get_all(){
		$hsl=$this->db->query("SELECT * FROM tbl_jenis_sampel ORDER BY js_id DESC");
		return $hsl;
	}
	function simpan($jenis,$kode){
		$hsl=$this->db->query("insert into tbl_jenis_sampel(js_nama,js_kode) values 
		('$jenis','$kode')");
		return $hsl;
	}
	function get_tentang_by_kode($kode){
		$hsl=$this->db->query("SELECT * FROM tbl_jenis_sampel where js_id='$kode'");
		return $hsl;
	}
	function update($id,$jenis,$kode){
		$hsl=$this->db->query("update tbl_jenis_sampel set js_nama='$jenis',js_kode='$kode'
			where js_id='$id'");
		return $hsl;
	}
	function hapus($kode){
		$hsl=$this->db->query("delete from tbl_jenis_sampel where js_id='$kode'");
		return $hsl;
	}

	// get data dropdown
    function dd()
    {
        $this->db->order_by('js_kode', 'ASC');
        $result = $this->db->get('tbl_jenis_sampel');
        $dd[''] = '-- Pilih Jenis Sampel --';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $dd[$row->js_id] = $row->js_nama.' ('.$row->js_kode.')';;
            }
        }
        return $dd;
    }
}