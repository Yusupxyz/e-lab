<?php
class Setting_ttd extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_setting_ttd');
	}


	function index(){
		$x['data']=$this->m_setting_ttd->get_all();
		$x['title'] = "Setting TTD";
		$x['golongan']=$this->m_setting_ttd->dd();
		$x['attribute'] = 'class="form-control" required';
		$this->load->view('admin/v_setting_ttd',$x);
	}


	function update(){
		$kode=$this->input->post('kode');
		$nama=$this->input->post('xnama');
		$golongan=$this->input->post('xgolongan');
		$nip=$this->input->post('xnip');
		if ($this->m_setting_ttd->update($kode,$nama,$golongan,$nip)) {
			echo $this->session->set_flashdata('msg','info');
			redirect('admin/setting_ttd');
		}else{
			echo $this->session->set_flashdata('msg','error');
			redirect('admin/setting_ttd');
		}
	}
}