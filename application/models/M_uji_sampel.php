<?php
class M_uji_sampel extends CI_Model{

	function get_all(){
		$hsl=$this->db->query("SELECT * FROM tbl_us LEFT JOIN tbl_jenis_sampel ON js_id=us_fk_js LEFT JOIN tbl_jenis_wadah ON 
		jw_id=us_fk_jw LEFT JOIN tbl_status ON us_status_id=status_id LEFT JOIN tbl_informasi_sampel ON tbl_informasi_sampel.is_us_id=
		tbl_us.us_id LEFT JOIN tbl_pengambilan_sampel ON tbl_pengambilan_sampel.ps_us_id=tbl_us.us_id LEFT JOIN tbl_anggota ON us_anggota=anggota_id WHERE us_status_id!='3'
		ORDER BY tbl_us.us_id DESC");
		return $hsl;
	}
	function get_byanggota($id){
		$hsl=$this->db->query("SELECT * FROM tbl_us LEFT JOIN tbl_jenis_sampel ON js_id=us_fk_js LEFT JOIN tbl_jenis_wadah ON 
		jw_id=us_fk_jw LEFT JOIN tbl_status ON us_status_id=status_id LEFT JOIN tbl_informasi_sampel ON tbl_informasi_sampel.is_us_id=
		tbl_us.us_id LEFT JOIN tbl_pengambilan_sampel ON tbl_pengambilan_sampel.ps_us_id=tbl_us.us_id WHERE us_anggota='$id'
		AND us_status_id!='3' AND us_status_id!='8' ORDER BY tbl_us.us_id DESC");
		return $hsl;
	}
	function get_all_proses(){
		$hsl=$this->db->query("SELECT * FROM tbl_us LEFT JOIN tbl_jenis_sampel ON js_id=us_fk_js LEFT JOIN tbl_jenis_wadah ON 
		jw_id=us_fk_jw LEFT JOIN tbl_status ON us_status_id=status_id LEFT JOIN tbl_informasi_sampel ON tbl_informasi_sampel.is_us_id=
		tbl_us.us_id LEFT JOIN tbl_pengambilan_sampel ON tbl_pengambilan_sampel.ps_us_id=tbl_us.us_id
		LEFT JOIN tbl_anggota ON us_anggota=anggota_id WHERE us_status_id!='8' ORDER BY tbl_us.us_id DESC");
		return $hsl;
	}
	function get_all_proses2(){
		$hsl=$this->db->query("SELECT * FROM tbl_us LEFT JOIN tbl_jenis_sampel ON js_id=us_fk_js LEFT JOIN tbl_jenis_wadah ON 
		jw_id=us_fk_jw LEFT JOIN tbl_status ON us_status_id=status_id LEFT JOIN tbl_informasi_sampel ON tbl_informasi_sampel.is_us_id=
		tbl_us.us_id LEFT JOIN tbl_pengambilan_sampel ON tbl_pengambilan_sampel.ps_us_id=tbl_us.us_id
		LEFT JOIN tbl_anggota ON us_anggota=anggota_id WHERE us_status_id!='8' AND us_status_id!='4' AND us_status_id!='3' ORDER BY tbl_us.us_id DESC");
		return $hsl;
	}
	function get_laporan(){
		$hsl=$this->db->query("SELECT * FROM tbl_us LEFT JOIN tbl_jenis_sampel ON js_id=us_fk_js LEFT JOIN tbl_jenis_wadah ON 
		jw_id=us_fk_jw LEFT JOIN tbl_status ON us_status_id=status_id LEFT JOIN tbl_informasi_sampel ON tbl_informasi_sampel.is_us_id=
		tbl_us.us_id LEFT JOIN tbl_pengambilan_sampel ON tbl_pengambilan_sampel.ps_us_id=tbl_us.us_id
		LEFT JOIN tbl_anggota ON us_anggota=anggota_id WHERE us_status_id='2' ORDER BY tbl_us.us_id DESC");
		return $hsl;
	}
	function get_laporan_bykode($kode){
		$hsl=$this->db->query("SELECT * FROM tbl_us LEFT JOIN tbl_jenis_sampel ON js_id=us_fk_js LEFT JOIN tbl_jenis_wadah ON 
		jw_id=us_fk_jw LEFT JOIN tbl_status ON us_status_id=status_id LEFT JOIN tbl_informasi_sampel ON tbl_informasi_sampel.is_us_id=
		tbl_us.us_id LEFT JOIN tbl_pengambilan_sampel ON tbl_pengambilan_sampel.ps_us_id=tbl_us.us_id LEFT JOIN tbl_acuan_metode ON
		tbl_acuan_metode.acuan_metode_id=tbl_pengambilan_sampel.metode_id
		LEFT JOIN tbl_anggota ON us_anggota=anggota_id LEFT JOIN tbl_interpretasi_hasil ON  tbl_interpretasi_hasil.ih_us_id=tbl_us.us_id
		 WHERE us_status_id='2' AND us_id='$kode' ORDER BY tbl_us.us_id DESC");
		return $hsl;
	}
	function get_riwayat(){
		$hsl=$this->db->query("SELECT * FROM tbl_us LEFT JOIN tbl_jenis_sampel ON js_id=us_fk_js LEFT JOIN tbl_jenis_wadah ON 
		jw_id=us_fk_jw LEFT JOIN tbl_status ON us_status_id=status_id LEFT JOIN tbl_informasi_sampel ON tbl_informasi_sampel.is_us_id=
		tbl_us.us_id LEFT JOIN tbl_pengambilan_sampel ON tbl_pengambilan_sampel.ps_us_id=tbl_us.us_id LEFT JOIN tbl_anggota ON 
		us_anggota=anggota_id  WHERE us_status_id!='3' AND year(tanggal_pengujian_awal)=year(curdate())
		ORDER BY tbl_us.us_id DESC");
		return $hsl;
	}
	function get_riwayat_filter($tgl_awal,$tgl_akhir,$tabel){
		$hsl=$this->db->query("SELECT * FROM tbl_us LEFT JOIN tbl_jenis_sampel ON js_id=us_fk_js LEFT JOIN tbl_jenis_wadah ON 
		jw_id=us_fk_jw LEFT JOIN tbl_status ON us_status_id=status_id LEFT JOIN tbl_informasi_sampel ON tbl_informasi_sampel.is_us_id=
		tbl_us.us_id LEFT JOIN tbl_pengambilan_sampel ON tbl_pengambilan_sampel.ps_us_id=tbl_us.us_id LEFT JOIN tbl_anggota ON 
		us_anggota=anggota_id WHERE us_status_id!='3' AND $tabel BETWEEN '$tgl_awal' AND '$tgl_akhir'
		ORDER BY tbl_us.us_id DESC");
		return $hsl;
	}
	function get_riwayat_transaksi(){
		$hsl=$this->db->query("SELECT * from tbl_transaksi LEFT JOIN tbl_us ON tbl_us.us_id=tbl_transaksi.transaksi_us
		LEFT JOIN tbl_jenis_sampel ON js_id=us_fk_js LEFT JOIN tbl_jenis_wadah ON 
		jw_id=us_fk_jw LEFT JOIN tbl_status ON us_status_id=status_id LEFT JOIN tbl_informasi_sampel ON tbl_informasi_sampel.is_us_id=
		tbl_us.us_id LEFT JOIN tbl_pengambilan_sampel ON tbl_pengambilan_sampel.ps_us_id=tbl_us.us_id LEFT JOIN tbl_anggota ON 
		us_anggota=anggota_id  WHERE us_status_id!='3' AND year(tanggal_pengujian_awal)=year(curdate())
		ORDER BY tbl_us.us_id DESC");
		return $hsl;
	}
	function get_riwayat_transaksi_filter($tgl_awal,$tgl_akhir,$pelanggan,$no){
		$hsl2='';
		$hsl3='';
		$hsl4='';
		$hsl5='';
		$hsl="SELECT * from tbl_transaksi LEFT JOIN tbl_us ON tbl_us.us_id=tbl_transaksi.transaksi_us
		LEFT JOIN tbl_jenis_sampel ON js_id=us_fk_js LEFT JOIN tbl_jenis_wadah ON 
		jw_id=us_fk_jw LEFT JOIN tbl_status ON us_status_id=status_id LEFT JOIN tbl_informasi_sampel ON tbl_informasi_sampel.is_us_id=
		tbl_us.us_id LEFT JOIN tbl_pengambilan_sampel ON tbl_pengambilan_sampel.ps_us_id=tbl_us.us_id LEFT JOIN tbl_anggota ON 
		us_anggota=anggota_id  WHERE us_status_id!='3' ";
		if ($pelanggan!=null){
			$hsl2="AND us_anggota='$pelanggan'";
		}
		if ($no!=null){
			$hsl3="AND no_identifikasi='$no'";
		}
		if ($tgl_awal!=null && $tgl_akhir!=null){
			$hsl4="AND transaksi_tgl BETWEEN '$tgl_awal' AND '$tgl_akhir'";
		}elseif($tgl_awal!=null){
			$hsl4="AND transaksi_tgl= '$tgl_awal'";
		}elseif($tgl_akhir!=null){
			$hsl4="AND transaksi_tgl= '".$tgl_akhir."'";
		}
		$hsl5="ORDER BY transaksi_tgl ASC";
		$query=$this->db->query($hsl.$hsl2.$hsl3.$hsl4.$hsl5);
		return $query;
	}
	function get_riwayat_anggota($id){
		$hsl=$this->db->query("SELECT * FROM tbl_us LEFT JOIN tbl_jenis_sampel ON js_id=us_fk_js LEFT JOIN tbl_jenis_wadah ON 
		jw_id=us_fk_jw LEFT JOIN tbl_status ON us_status_id=status_id LEFT JOIN tbl_informasi_sampel ON tbl_informasi_sampel.is_us_id=
		tbl_us.us_id LEFT JOIN tbl_pengambilan_sampel ON tbl_pengambilan_sampel.ps_us_id=tbl_us.us_id LEFT JOIN tbl_anggota ON 
		us_anggota=anggota_id  WHERE us_status_id!='3' AND year(tanggal_pengujian_awal)=year(curdate()) AND us_anggota='$id'
		ORDER BY tbl_us.us_id DESC");
		return $hsl;
	}
	function get_riwayat_anggota_filter($id,$tgl_awal,$tgl_akhir,$tabel){
		$hsl=$this->db->query("SELECT * FROM tbl_us LEFT JOIN tbl_jenis_sampel ON js_id=us_fk_js LEFT JOIN tbl_jenis_wadah ON 
		jw_id=us_fk_jw LEFT JOIN tbl_status ON us_status_id=status_id LEFT JOIN tbl_informasi_sampel ON tbl_informasi_sampel.is_us_id=
		tbl_us.us_id LEFT JOIN tbl_pengambilan_sampel ON tbl_pengambilan_sampel.ps_us_id=tbl_us.us_id LEFT JOIN tbl_anggota ON 
		us_anggota=anggota_id WHERE us_status_id!='3' AND $tabel BETWEEN '$tgl_awal' AND '$tgl_akhir' AND us_anggota='$id'
		ORDER BY tbl_us.us_id DESC");
		return $hsl;
	}
	function get_riwayat_transaksi_anggota($id){
		$hsl=$this->db->query("SELECT * from tbl_transaksi LEFT JOIN tbl_us ON tbl_us.us_id=tbl_transaksi.transaksi_us
		LEFT JOIN tbl_jenis_sampel ON js_id=us_fk_js LEFT JOIN tbl_jenis_wadah ON 
		jw_id=us_fk_jw LEFT JOIN tbl_status ON us_status_id=status_id LEFT JOIN tbl_informasi_sampel ON tbl_informasi_sampel.is_us_id=
		tbl_us.us_id LEFT JOIN tbl_pengambilan_sampel ON tbl_pengambilan_sampel.ps_us_id=tbl_us.us_id LEFT JOIN tbl_anggota ON 
		us_anggota=anggota_id  WHERE us_status_id!='3' AND year(tanggal_pengujian_awal)=year(curdate()) AND us_anggota='$id'
		ORDER BY tbl_us.us_id DESC");
		return $hsl;
	}
	function get_riwayat_transaksi_filter_anggota($id,$tgl_awal,$tgl_akhir,$pelanggan,$no){
		$hsl2='';
		$hsl3='';
		$hsl4='';
		$hsl5='';
		$hsl="SELECT * from tbl_transaksi LEFT JOIN tbl_us ON tbl_us.us_id=tbl_transaksi.transaksi_us
		LEFT JOIN tbl_jenis_sampel ON js_id=us_fk_js LEFT JOIN tbl_jenis_wadah ON 
		jw_id=us_fk_jw LEFT JOIN tbl_status ON us_status_id=status_id LEFT JOIN tbl_informasi_sampel ON tbl_informasi_sampel.is_us_id=
		tbl_us.us_id LEFT JOIN tbl_pengambilan_sampel ON tbl_pengambilan_sampel.ps_us_id=tbl_us.us_id LEFT JOIN tbl_anggota ON 
		us_anggota=anggota_id  WHERE us_status_id!='3' AND us_anggota='$id' ";
		if ($pelanggan!=null){
			$hsl2="AND us_anggota='$pelanggan'";
		}
		if ($no!=null){
			$hsl3="AND no_identifikasi='$no'";
		}
		if ($tgl_awal!=null && tgl_akhir!=null){
			$hsl4="AND transaksi_tgl BETWEEN '$tgl_awal' AND '$tgl_akhir'";
		}elseif($tgl_awal!=null){
			$hsl4="AND transaksi_tgl= '$tgl_awal'";
		}elseif($tgl_akhir!=null){
			$hsl4="AND transaksi_tgl= '".$tgl_akhir."'";
		}
		$hsl5="ORDER BY transaksi_tgl ASC";
		$query=$this->db->query($hsl.$hsl2.$hsl3.$hsl4.$hsl5);
		return $query;
	}
	function statistik_konfirmasi($kode){
		$hsl=$this->db->query("SELECT count(*) as 'count' FROM tbl_us where us_anggota='$kode' and us_status_id='1'");
		return $hsl;
	}
	function statistik_diterima($kode){
		$hsl=$this->db->query("SELECT count(*) as 'count' FROM tbl_us where us_anggota='$kode' and us_status_id='5'");
		return $hsl;
	}
	function statistik_diproses($kode){
		$hsl=$this->db->query("SELECT count(*) as 'count' FROM tbl_us where us_anggota='$kode' and us_status_id='6' OR us_status_id='7' ");
		return $hsl;
	}
	function statistik_selesai($kode){
		$hsl=$this->db->query("SELECT count(*) as 'count' FROM tbl_us where us_anggota='$kode' and (us_status_id='2' OR us_status_id='8')");
		return $hsl;
	}

	function count_uji_sampel(){
		$hsl=$this->db->query("SELECT count(*) as 'count' FROM tbl_us WHERE us_status_id!='3' AND us_status_id!='4'");
		return $hsl;
	}

	function count_uji_sampel_selesai(){
		$hsl=$this->db->query("SELECT count(*) as 'count' FROM tbl_us WHERE us_status_id='2' AND us_status_id='8'");
		return $hsl;
	}

	function simpan($anggota,$id,$kode,$pengambilan,$jenis_sampel,$jenis_wadah,$tarif,$catatan,$uang_muka,$sisa,$pdf){
		$hsl=$this->db->query("insert into tbl_us(us_id,us_anggota,us_kode_sampel,us_fk_js,us_fk_jw,us_pengambilan,us_total,us_catatan,us_uang_muka,us_sisa,us_file) values 
		('$id','$anggota','$kode','$jenis_sampel','$jenis_wadah','$pengambilan','$tarif','$catatan','$uang_muka','$sisa','$pdf')");
		return $hsl;
	}
	function simpan_informasi($id){
		$hsl=$this->db->query("insert into tbl_informasi_sampel(is_us_id) values 
		('$id')");
		return $hsl;
	}
	function simpan_pengambilan($id){
		$hsl=$this->db->query("insert into tbl_pengambilan_sampel(ps_us_id) values 
		('$id')");
		return $hsl;
	}
	function simpan_interpretasi($id){
		$hsl=$this->db->query("insert into tbl_interpretasi_hasil(ih_us_id) values 
		('$id')");
		return $hsl;
	}
	function get_by_kode($kode){
		$hsl=$this->db->query("SELECT * FROM tbl_us where us_id='$kode'");
		return $hsl;
	}
	function get_is_by_kode($kode){
		$hsl=$this->db->query("SELECT * FROM tbl_informasi_sampel where is_us_id='$kode'");
		return $hsl;
	}
	function get_ih_by_kode($kode){
		$hsl=$this->db->query("SELECT * FROM tbl_interpretasi_hasil where ih_us_id='$kode'");
		return $hsl;
	}
	function get_anggota($kode){
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
	function update_informasi($id,$no,$kondisi){
		$hsl=$this->db->query("update tbl_informasi_sampel set no_identifikasi='$no',kondisi='$kondisi'
		where is_id='$id'");
		return $hsl;
	}
	function update_pengambilan($id,$lokasi,$metode,$rincian){
		$hsl=$this->db->query("update tbl_pengambilan_sampel set lokasi='$lokasi',metode_id='$metode',rincian='$rincian'
		where ps_us_id='$id'");
		return $hsl;
	}
	function update_ih($id,$xpenyimpangan,$xpersyaratan){
		$hsl=$this->db->query("update tbl_interpretasi_hasil set ih_penyimpangan='$xpenyimpangan',ih_persyaratan='$xpersyaratan'
		where ih_us_id='$id'");
		return $hsl;
	}
	function update_tanggal_pengambilan($id,$tanggal=NULL){
		if ($tanggal==NULL){
			$tanggal= date('Y-m-d');
		}
		$hsl=$this->db->query("update tbl_informasi_sampel set tanggal_sampel='$tanggal'
		where is_id='$id'");
		return $hsl;
	}
	function update_tanggal_pengujian_awal($id){
		$hsl=$this->db->query("update tbl_informasi_sampel set tanggal_pengujian_awal=now()
		where is_us_id='$id'");
		return $hsl;
	}
	function update_tanggal_pengujian_akhir($id){
		$hsl=$this->db->query("update tbl_informasi_sampel set tanggal_pengujian_akhir=now()
		where is_us_id='$id'");
		return $hsl;
	}
	function update_laporan($id,$name){
		$hsl=$this->db->query("update tbl_us set us_laporan='$name'
		where us_id='$id'");
		return $hsl;
	}
	function batal($id){
		$hsl=$this->db->query("update tbl_us set us_status_id='3'
			where us_id='$id'");
		return $hsl;
	}
	function update_status($id,$status,$catatan){
		$hsl=$this->db->query("update tbl_us set us_status_id='$status',us_catatan_status='$catatan'
			where us_id	='$id'");
		return $hsl;
	}
	function update_status_dari_transaksi($id,$status,$catatan){
		$hsl=$this->db->query("update tbl_us set us_status_id='$status',us_catatan_status='$catatan'
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
        $query = $this->db->query("SELECT DATE_FORMAT(tanggal_sampel,'%d') AS tgl,COUNT(*) AS jumlah FROM tbl_us LEFT JOIN tbl_informasi_sampel ON
		tbl_informasi_sampel.is_us_id=tbl_us.us_id WHERE MONTH(tanggal_sampel)=MONTH(CURDATE()) AND us_anggota='$kode' AND us_status_id!='3'
		AND us_status_id!='4' GROUP BY DATE(tanggal_sampel)");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
	}
	
	function statistik_perbulan_opr(){
        $query = $this->db->query("SELECT DATE_FORMAT(tanggal_sampel,'%d') AS tgl,COUNT(*) AS jumlah FROM tbl_us LEFT JOIN tbl_informasi_sampel ON
		tbl_informasi_sampel.is_us_id=tbl_us.us_id WHERE MONTH(tanggal_sampel)=MONTH(CURDATE()) AND us_status_id!='3'
		AND us_status_id!='4'  GROUP BY DATE(tanggal_sampel)");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
	}

	function update_status_notif(){
		$hsl=$this->db->query("UPDATE tbl_us SET us_notif_status='1'");
		return $hsl;
	}
	
	// get data dropdown
    function dd()
    {
		$this->db->select('year(tanggal_pengujian_awal) as "tahun"');
		$this->db->group_by('year(tanggal_pengujian_awal)');
		$this->db->order_by('tahun', 'ASC');
        $result = $this->db->get('tbl_informasi_sampel');
        $dd[''] = '-- Pilih Tahun --';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $dd[$row->tahun] = $row->tahun;
            }
        }
        return $dd;
	}
	
	// get data dropdown
    function dd_no_identifikasi()
    {
		$this->db->join('tbl_informasi_sampel', 'tbl_informasi_sampel.is_us_id=tbl_us.us_id','left');
		$this->db->order_by('no_identifikasi', 'ASC');
        $result = $this->db->get('tbl_us');
        $dd[''] = '-- Pilih No. Identifikasi --';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $dd[$row->us_id] = $row->no_identifikasi;
            }
        }
        return $dd;
    }

}