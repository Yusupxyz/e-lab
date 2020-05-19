<?php
class Setting_email extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_setting_email');
		$this->load->library('upload');
	}


	function index(){
		$x['data']=$this->m_setting_email->get_all();
		$x['title'] = "Setting Email";
		$this->load->view('admin/v_setting_email',$x);
	}


	function update(){
		$kode=$this->input->post('kode');
		$nama=$this->input->post('xnama');
		$data=$this->input->post('xdata');
		if ($this->m_setting_email->update($kode,$nama,$data)) {
			echo $this->session->set_flashdata('msg','info');
			redirect('admin/setting_email');
		}else{
			echo $this->session->set_flashdata('msg','error');
			redirect('admin/setting_email');
		}
	}
}