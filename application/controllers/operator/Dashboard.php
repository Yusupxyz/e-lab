<?php
class Dashboard extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_pengunjung');
		$this->load->model('m_uji_sampel');
		$this->load->model('m_anggota');
	}
	function index(){
			$x['visitor'] = $this->m_uji_sampel->statistik_perbulan_opr();
			$x['anggota'] = $this->m_anggota->count_anggota()->row()->count;
			$x['uji_sampel'] = $this->m_uji_sampel->count_uji_sampel()->row()->count;
			$x['selesai'] = $this->m_uji_sampel->count_uji_sampel_selesai()->row()->count;
			$x['title'] = "Beranda";
			$this->load->view('operator/dashboard/v_dashboard',$x);
	
	}
	
}