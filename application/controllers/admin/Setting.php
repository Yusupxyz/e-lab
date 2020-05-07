<?php
class Setting extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_setting');
		$this->load->library('upload');
	}


	function index(){
		$x['data']=$this->m_setting->get_all();
		$x['title'] = "Setting";
		$this->load->view('admin/v_setting',$x);
	}


	function update(){
		$kode=$this->input->post('kode');
		$nama=$this->input->post('xnama');
		$data=$this->input->post('xdata');
		if ($this->m_setting->update($kode,$nama,$data)) {
			echo $this->session->set_flashdata('msg','info');
			redirect('admin/setting');
		}else{
			echo $this->session->set_flashdata('msg','error');
			redirect('admin/setting');
		}
	}
}