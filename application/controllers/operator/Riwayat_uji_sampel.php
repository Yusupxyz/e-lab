<?php
class Riwayat_uji_sampel extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
		};
		$this->load->model('m_uji_sampel');
		$this->load->model('m_parameter_us');
		$this->load->library('upload');
		$this->load->library('pdf');
	}


	function index(){
		$tgl_awal=$this->input->post('dateStart');
		$tgl_akhir=$this->input->post('dateEnd');
		$tabel=$this->input->post('tabel');
		if (!empty($tabel) && !empty($tgl_awal) && !empty($tgl_akhir)){
			$x['data']=$this->m_uji_sampel->get_riwayat_filter($tgl_awal,$tgl_akhir,$tabel);
			if ($tabel=='tanggal_sampel'){
				$tabel="Tanggal Penerimaan Sampel";
			}elseif($tabel=='tanggal_pengujian_awal'){
				$tabel="Tanggal Mulai Pengujian";
			}else{
				$tabel="Tanggal Selesai Pengujian";
			}
			$x['show']=$tabel.' dari '.$tgl_awal.' <i>s/d</i> '.$tgl_akhir;
		}else{
			$x['data']=$this->m_uji_sampel->get_riwayat();
			$x['show']='';
		}
		$x['title'] = 'Riwayat Uji Sampel';
		$x['pratitle'] = 'Riwayat';
		foreach ($x['data']->result_array() as $a) {
			$x['detail'][]=$this->m_parameter_us->get_by_fk($a['us_id'])->result_array();
		}
		$x['attribute'] = 'class="form-control" required';
		$x['xtabel']=array("" => "-- Pilih Jenis Filter --",
							"tanggal_sampel" => "Tanggal Penerimaan Sampel",
							"tanggal_pengujian_awal" => "Tanggal Mulai Pengujian",
							"tanggal_pengujian_akhir" => "Tanggal Selesai Pengujian",
						);
		$this->load->view('operator/riwayat_uji_sampel/v_riwayat',$x);
	}

}