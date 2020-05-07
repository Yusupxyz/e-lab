<?php
class Kontak extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_kontak');
	}


	function index(){
		$x['data']=$this->m_kontak->get_all_kontak();
		$x['title']="Kontak";
		$this->load->view('admin/kontak/v_kontak',$x);
	}
	
	function update_kontak(){
		$data=$this->input->post('xdata');
		$kode=$this->input->post('kode');
		$this->m_kontak->update_kontak($kode,$data);
		echo $this->session->set_flashdata('msg','info');
		redirect('admin/kontak');
	}


}