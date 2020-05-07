<?php
class Status extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_status');
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
		$x['attribute'] = 'class="form-control" id="xclass" required';
		$x['xclass']='';

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
		$x['attribute'] = 'class="form-control" id="xclass" required';
		$this->load->view('admin/status/v_edit',$x);
	}

	function simpan(){
		$nama=$this->input->post('xnama');
		$class=$this->input->post('xclass');
		if ($this->m_status->simpan($nama,$class)){
			echo $this->session->set_flashdata('msg','success');
			redirect('admin/status');
		}else{
			echo $this->session->set_flashdata('msg','warning');
			redirect('admin/status');
		}
				
	}
	
	function update(){
		$nama=$this->input->post('xnama');
		$class=$this->input->post('xclass');
		$id=$this->input->post('xid');
		$this->m_status->update($id,$nama,$class);
		echo $this->session->set_flashdata('msg','info');
		redirect('admin/status');
	}

	function hapus(){
		$kode=$this->input->post('kode');
		$this->m_status->hapus($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/status');
	}

}