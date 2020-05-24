<?php
class Riwayat_transaksi extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
		};
		$this->load->model('m_uji_sampel');
		$this->load->model('m_parameter_us');
		$this->load->model('m_anggota');
		$this->load->library('upload');
		$this->load->library('pdf');
	}


	function index(){
		$anggota=$this->session->userdata('idadmin');
		$tgl_awal=$this->input->post('dateStart');
		$tgl_akhir=$this->input->post('dateEnd');
		$no=$this->input->post('no_identifikasi');
		if (!empty($no) || !empty($tgl_awal) || !empty($tgl_akhir)){
			$x['data']=$this->m_uji_sampel->get_riwayat_transaksi_filter_anggota($anggota,$tgl_awal,$tgl_akhir,$pelanggan,$no);
			$hsl3='';
			$hsl4='';
			$hsl5='';
			if ($no!=null){
				$hsl3="| No. identifikasi = ".$this->m_uji_sampel->get_is_by_kode($no)->row()->no_identifikasi." ";
			}
			if ($tgl_awal!=null && tgl_akhir!=null){
				$hsl4="| Tanggal ".$tgl_awal." <i>s/d</i> ".$tgl_akhir." ";
			}elseif($tgl_awal!=null){
				$hsl4="| Tanggal ".$tgl_awal." ";
			}elseif($tgl_akhir!=null){
				$hsl4="| Tanggal ".$tgl_akhir." ";
			}
			$no=",dengan nomor identifikasi ".$no;
			$tgl=
			$x['show']='Transaksi '.$hsl2.$hsl3.$hsl4;
		}else{
			$x['data']=$this->m_uji_sampel->get_riwayat_transaksi_anggota($anggota);
			$x['show']='';
		}
		$x['title'] = 'Riwayat Transaksi';
		$x['pratitle'] = 'Riwayat';
		foreach ($x['data']->result_array() as $a) {
			$x['detail'][]=$this->m_parameter_us->get_by_fk($a['us_id'])->result_array();
		}
		$x['attribute'] = 'class="form-control"';
		$x['xno']=$this->m_uji_sampel->dd_no_identifikasi();
		$this->load->view('anggota/riwayat_transaksi/v_riwayat',$x);
	}

}