<?php 
class Kontak extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('m_pengunjung');
		$this->load->model('m_kontak');
        $this->m_pengunjung->count_visitor();
	}

	function index(){
		$data=$this->m_kontak->get_all_kontak()->result_array();
		$this->load->library('googlemaps');
		error_reporting(0);
		$long=$data[4][kontak_data];
		$lat=$data[5][kontak_data];
		$config=array();
		$config['center']=$long.','. $lat;
		$config['zoom']=16;
		$this->googlemaps->initialize($config);
		$marker=array();
		$marker['position']=$long.','. $lat;
		$this->googlemaps->add_marker($marker);
		$x['map']=$this->googlemaps->create_map();
		$x['data']=$data;
		$x['menu']="kontak";
		$this->load->view('v_kontak',$x);
	}

	function kirim_pesan(){
		$nama=htmlspecialchars($this->input->post('nama',TRUE),ENT_QUOTES);
		$email=htmlspecialchars($this->input->post('email',TRUE),ENT_QUOTES);
		$pesan=htmlspecialchars(trim($this->input->post('pesan',TRUE)),ENT_QUOTES);
		$this->m_kontak->kirim_pesan($nama,$email,$pesan);
		echo $this->session->set_flashdata('msg',"<div class='alert alert-info'>Terima kasih telah menghubungi kami.</div>");
		redirect('kontak');
	}
}