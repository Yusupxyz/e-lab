<?php
class M_status extends CI_Model{

	function get_all(){
		$hsl=$this->db->query("SELECT * FROM tbl_status LEFT JOIN tbl_setting_email ON tbl_setting_email.setting_id=tbl_status.status_id_setting_email ORDER BY status_id DESC");
		return $hsl;
	}
	function simpan($nama,$class,$settingemail){
		$hsl=$this->db->query("insert into tbl_status(status_nama,status_class,status_id_setting_email) values 
		('$nama','$class','$settingemail')");
		return $hsl;
	}
	function get_by_kode($kode){
		$hsl=$this->db->query("SELECT * FROM tbl_status where status_id='$kode'");
		return $hsl;
	}
	function update($id,$settingemail){
		$hsl=$this->db->query("update tbl_status set status_id_setting_email='$settingemail'
			where status_id='$id'");
		return $hsl;
	}
	function hapus($kode){
		$hsl=$this->db->query("delete from tbl_status where status_id='$kode'");
		return $hsl;
	}

	// get data dropdown
    function dd()
    {
        $this->db->order_by('status_class', 'ASC');
        $result = $this->db->get('tbl_status');
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
		$this->db->where('status_id!="2"');
		$this->db->where('status_id!="6"');
		$this->db->order_by('status_nama', 'ASC');
        $result = $this->db->get('tbl_status');
        $dd[''] = '-- Pilih Status --';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $dd[$row->status_id] = $row->status_nama;
            }
        }
        return $dd;
	}
	
	// get data dropdown
    function dd3()
    {
        $this->db->where('status_id','2');
        $this->db->order_by('status_id', 'ASC');
        $result = $this->db->get('tbl_status');
        $dd[''] = '-- Pilih Status --';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $dd[$row->status_id] = $row->status_nama;
            }
        }
        return $dd;
    }
    
    // get data dropdown
    function dd4()
    {
        $this->db->where('status_id','6');
        $this->db->order_by('status_id', 'ASC');
        $result = $this->db->get('tbl_status');
        $dd[''] = '-- Pilih Status --';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $dd[$row->status_id] = $row->status_nama;
            }
        }
        return $dd;
    }
    
    // get data dropdown
    function dd5()
    {
        $this->db->where('status_id','8');
        $this->db->order_by('status_id', 'ASC');
        $result = $this->db->get('tbl_status');
        $dd[''] = '-- Pilih Status --';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $dd[$row->status_id] = $row->status_nama;
            }
        }
        return $dd;
	}
}