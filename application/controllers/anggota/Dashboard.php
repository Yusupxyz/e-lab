<?php
class Dashboard extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_uji_sampel');
		$this->load->model('m_pengunjung');
	}
	function index(){
			$anggota=$this->session->userdata('idadmin');
			$x['visitor'] = $this->m_uji_sampel->statistik_perbulan($anggota);
			$x['konfirmasi'] = $this->m_uji_sampel->statistik_konfirmasi($anggota)->row()->count;
			$x['diterima'] = $this->m_uji_sampel->statistik_diterima($anggota)->row()->count;
			$x['diproses'] = $this->m_uji_sampel->statistik_diproses($anggota)->row()->count;
			$x['selesai'] = $this->m_uji_sampel->statistik_selesai($anggota)->row()->count;
			// echo $this->db->last_query();
			$x['title'] = 'Beranda';
			$this->load->view('anggota/dashboard/v_dashboard',$x);
	
	}
	
}