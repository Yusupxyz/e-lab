<?php
class Jenis_sampel extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_js');
		$this->load->library('upload');
	}


	function index(){
		$x['data']=$this->m_js->get_all();
		$x['pratitle']="Jenis Sampel";
		$x['title']="Daftar Jenis Sampel";
		$this->load->view('admin/jenis_sampel/v_list',$x);
	}
	function add(){
		$x['pratitle']="Jenis Sampel";
		$x['title']="Tambah Jenis Sampel";
		$this->load->view('admin/jenis_sampel/v_add',$x);
	}
	function get_edit(){
		$kode=$this->uri->segment(4);
		$x['data']=$this->m_js->get_tentang_by_kode($kode)->row();
		$x['pratitle']="Jenis Sampel";
		$x['title']="Daftar Jenis Sampel";
		$this->load->view('admin/jenis_sampel/v_edit',$x);
	}

	function simpan(){
		$jenis=$this->input->post('xjenis');
		$kode=$this->input->post('xkode');
		if ($this->m_js->simpan($jenis,$kode)){
			echo $this->session->set_flashdata('msg','success');
			redirect('admin/jenis_sampel');
		}else{
			echo $this->session->set_flashdata('msg','warning');
			redirect('admin/jenis_sampel');
		}
				
	}
	
	function update(){
		$jenis=$this->input->post('xjenis');
		$kode=$this->input->post('xkode');
		$id=$this->input->post('xid');
		$this->m_js->update($id,$jenis,$kode);
		echo $this->session->set_flashdata('msg','info');
		redirect('admin/jenis_sampel');
	}

	function hapus(){
		$kode=$this->input->post('kode');
		$this->m_js->hapus($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/jenis_sampel');
	}

}