<?php
class Status extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_status');
		$this->load->model('m_setting_email');
		$this->load->library('upload');
	}

	function index(){
		$x['data']=$this->m_status->get_all();
		$x['pratitle']="Status";
		$x['title']="Daftar Status";
		$this->load->view('admin/status/v_list',$x);
	}
	function add(){
		$x['pratitle']="Status";
		$x['title']="Tambah Status";
		$x['class']=array(
			'' => '--Pilih Class--',
			'alert-primary" class="alert-primary' => 'Normal',
			'alert-warning" class="alert-warning' => 'Warning',
			'alert-info" class="alert-info' => 'Info',
			'alert-danger" class="alert-danger' => 'Danger',
			'alert-success" class="alert-success' => 'Success',
		);
		$x['setting_email']=$this->m_setting_email->dd();
		$x['attribute'] = 'class="form-control" id="xclass" required';
		$x['attribute2'] = 'class="form-control"';
		$x['xclass']='';
		$x['xsettingemail']='';

		$this->load->view('admin/status/v_add',$x);
	}
	function get_edit(){
		$kode=$this->uri->segment(4);
		$x['data']=$this->m_status->get_by_kode($kode)->row();
		$x['pratitle']="Status";
		$x['title']="Daftar Status";
		$x['class']=array(
			'' => '--Pilih Class--',
			'alert-primary" class="alert-primary' => 'Normal',
			'alert-warning" class="alert-warning' => 'Warning',
			'alert-info" class="alert-info' => 'Info',
			'alert-danger" class="alert-danger' => 'Danger',
			'alert-success" class="alert-success' => 'Success',
		);

		$x['setting_email']=$this->m_setting_email->dd();
		$x['attribute'] = 'class="form-control" id="xclass" required disabled';
		$x['attribute2'] = 'class="form-control"';
		$this->load->view('admin/status/v_edit',$x);
	}

	// function simpan(){
	// 	$nama=$this->input->post('xnama');
	// 	$class=$this->input->post('xclass');
	// 	$settingemail=$this->input->post('xsettingemail');
	// 	if ($this->m_status->simpan($nama,$class,$settingemail)){
	// 		echo $this->session->set_flashdata('msg','success');
	// 		redirect('admin/status');
	// 	}else{
	// 		echo $this->session->set_flashdata('msg','warning');
	// 		redirect('admin/status');
	// 	}
				
	// }
	
	function update(){
		$id=$this->input->post('xid');
		$settingemail=$this->input->post('xsettingemail');
		$this->m_status->update($id,$settingemail);
		echo $this->session->set_flashdata('msg','info');
		redirect('admin/status');
	}

	// function hapus(){
	// 	$kode=$this->input->post('kode');
	// 	$this->m_status->hapus($kode);
	// 	echo $this->session->set_flashdata('msg','success-hapus');
	// 	redirect('admin/status');
	// }

}