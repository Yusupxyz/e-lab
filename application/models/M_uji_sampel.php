<?php
class M_uji_sampel extends CI_Model{

	function get_all(){
		$hsl=$this->db->query("SELECT * FROM tbl_us LEFT JOIN tbl_jenis_sampel ON js_id=us_fk_js LEFT JOIN tbl_jenis_wadah ON 
		jw_id=us_fk_jw LEFT JOIN tbl_parameter_us ON us_id=parameter_us_id LEFT JOIN tbl_status ON us_status_id=status_id WHERE us_status_id!='3'
		ORDER BY us_id DESC");
		return $hsl;
	}
	function get_byanggota($id){
		$hsl=$this->db->query("SELECT * FROM tbl_us LEFT JOIN tbl_jenis_sampel ON js_id=us_fk_js LEFT JOIN tbl_jenis_wadah ON 
		jw_id=us_fk_jw LEFT JOIN tbl_parameter_us ON us_id=parameter_us_id LEFT JOIN tbl_status ON us_status_id=status_id WHERE us_anggota='$id'
		AND us_status_id!='3' ORDER BY us_id DESC");
		return $hsl;
	}
	function get_all_proses(){
		$hsl=$this->db->query("SELECT * FROM tbl_us LEFT JOIN tbl_jenis_sampel ON js_id=us_fk_js LEFT JOIN tbl_jenis_wadah ON 
		jw_id=us_fk_jw LEFT JOIN tbl_parameter_us ON us_id=parameter_us_id LEFT JOIN tbl_status ON us_status_id=status_id 
		LEFT JOIN tbl_anggota ON us_anggota=anggota_id WHERE us_status_id!='2' ORDER BY us_id DESC");
		return $hsl;
	}
	function get_laporan(){
		$hsl=$this->db->query("SELECT * FROM tbl_us WHERE us_status_id='2' ORDER BY us_id DESC");
		return $hsl;
	}
	function statistik_konfirmasi($kode){
		$hsl=$this->db->query("SELECT count(*) as 'count' FROM tbl_us where us_anggota='$kode' and us_status_id='1'");
		return $hsl;
	}
	function statistik_diproses($kode){
		$hsl=$this->db->query("SELECT count(*) as 'count' FROM tbl_us where us_anggota='$kode' and us_status_id!='1' and us_status_id!='2' ");
		return $hsl;
	}
	function statistik_selesai($kode){
		$hsl=$this->db->query("SELECT count(*) as 'count' FROM tbl_us where us_anggota='$kode' and us_status_id='2'");
		return $hsl;
	}

	function count_uji_sampel(){
		$hsl=$this->db->query("SELECT count(*) as 'count' FROM tbl_us");
		return $hsl;
	}

	function count_uji_sampel_selesai(){
		$hsl=$this->db->query("SELECT count(*) as 'count' FROM tbl_us WHERE us_status_id='2'");
		return $hsl;
	}

	function simpan($anggota,$id,$kode,$pengambilan,$jenis_sampel,$jenis_wadah,$tarif,$catatan,$uang_muka,$sisa,$pdf){
		$hsl=$this->db->query("insert into tbl_us(us_id,us_anggota,us_kode_sampel,us_fk_js,us_fk_jw,us_pengambilan,us_total,us_catatan,us_uang_muka,us_sisa,us_file) values 
		('$id','$anggota','$kode','$jenis_sampel','$jenis_wadah','$pengambilan','$tarif','$catatan','$uang_muka','$sisa','$pdf')");
		return $hsl;
	}
	function get_by_kode($kode){
		$hsl=$this->db->query("SELECT * FROM tbl_us where us_id='$kode'");
		return $hsl;
	}
	function get_email_anggota($kode){
		$hsl=$this->db->query("SELECT * FROM tbl_us LEFT JOIN tbl_anggota ON tbl_anggota.anggota_id=tbl_us.us_anggota where us_id='$kode'");
		return $hsl;
	}
	function get_by_fk($fk){
		$hsl=$this->db->query("SELECT * FROM tbl_us where pu_sp_id='$fk'");
		return $hsl;
	}
	function update($id,$kode,$pengambilan,$jenis_sampel,$jenis_wadah,$catatan,$pdf){
		$hsl=$this->db->query("update tbl_us set us_kode_sampel='$kode',us_fk_js='$jenis_sampel',us_fk_jw='$jenis_wadah',us_pengambilan='$pengambilan',
		us_catatan='$catatan',us_file='$pdf' where us_id='$id'");
		return $hsl;
	}
	function update_nopdf($id,$kode,$pengambilan,$jenis_sampel,$jenis_wadah,$catatan){
		$hsl=$this->db->query("update tbl_us set us_kode_sampel='$kode',us_fk_js='$jenis_sampel',us_fk_jw='$jenis_wadah',us_pengambilan='$pengambilan',
		us_catatan='$catatan' where us_id='$id'");
		return $hsl;
	}
	function batal($id){
		$hsl=$this->db->query("update tbl_us set us_status_id='3'
			where us_id='$id'");
		return $hsl;
	}
	function update_status($id,$status,$no_sampel,$metode){
		$hsl=$this->db->query("update tbl_us set us_no_sampel='$no_sampel',us_status_id='$status',us_metode='$metode'
			where us_id	='$id'");
		return $hsl;
	}
	function update_sisa($id,$sisa){
		$hsl=$this->db->query("update tbl_us set us_sisa='$sisa'
			where us_id	='$id'");
		return $hsl;
	}
	function hapus($kode){
		$hsl=$this->db->query("delete from tbl_us where us_id='$kode'");
		return $hsl;
	}
	
	function statistik_perbulan($kode){
        $query = $this->db->query("SELECT DATE_FORMAT(us_tanggal_diterima,'%d') AS tgl,COUNT(*) AS jumlah FROM tbl_us WHERE MONTH(us_tanggal_diterima)=MONTH(CURDATE()) AND us_anggota='$kode' GROUP BY DATE(us_tanggal_diterima)");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
	}
	
	function statistik_perbulan_opr(){
        $query = $this->db->query("SELECT DATE_FORMAT(us_tanggal_diterima,'%d') AS tgl,COUNT(*) AS jumlah FROM tbl_us WHERE MONTH(us_tanggal_diterima)=MONTH(CURDATE())  GROUP BY DATE(us_tanggal_diterima)");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

}