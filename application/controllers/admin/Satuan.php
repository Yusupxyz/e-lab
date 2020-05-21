<?php
class Satuan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_satuan');
		$this->load->library('upload');
	}

	function index(){
		$x['data']=$this->m_satuan->get_all();
		$x['pratitle']="Satuan";
		$x['title']="Daftar Satuan";
		$this->load->view('admin/satuan/v_list',$x);
	}
	function add(){
		$x['pratitle']="Satuan";
		$x['title']="Tambah Satuan";
		$this->load->view('admin/satuan/v_add',$x);
	}
	function get_edit(){
		$kode=$this->uri->segment(4);
		$x['data']=$this->m_satuan->get_by_kode($kode)->row();
		$x['pratitle']="Satuan";
		$x['title']="Daftar Satuan";
		$this->load->view('admin/satuan/v_edit',$x);
	}

	function simpan(){
		$satuan=$this->input->post('xsatuan');
		if ($this->m_satuan->simpan($satuan)){
			echo $this->session->set_flashdata('msg','success');
			redirect('admin/satuan');
		}else{
			echo $this->session->set_flashdata('msg','warning');
			redirect('admin/satuan');
		}	
	}
	
	function update(){
		$satuan=$this->input->post('xsatuan');
		$id=$this->input->post('xid');
		$this->m_satuan->update($id,$satuan);
		echo $this->session->set_flashdata('msg','info');
		redirect('admin/satuan');
	}

	function hapus(){
		$kode=$this->input->post('kode');
		$this->m_satuan->hapus($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/satuan');
	}

}