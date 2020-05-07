<?php
class Jenis_wadah extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_jw');
		$this->load->library('upload');
	}


	function index(){
		$x['data']=$this->m_jw->get_all();
		$x['pratitle']="Jenis Wadah";
		$x['title']="Daftar Jenis Wadah";
		$this->load->view('admin/jenis_wadah/v_list',$x);
	}
	function add(){
		$x['pratitle']="Jenis Wadah";
		$x['title']="Tambah Jenis Wadah";
		$this->load->view('admin/jenis_wadah/v_add',$x);
	}
	function get_edit(){
		$kode=$this->uri->segment(4);
		$x['data']=$this->m_jw->get_tentang_by_kode($kode)->row();
		$x['pratitle']="Jenis Wadah";
		$x['title']="Daftar Jenis Wadah";
		$this->load->view('admin/jenis_wadah/v_edit',$x);
	}

	function simpan(){
		$jenis=$this->input->post('xjenis');
		$kode=$this->input->post('xkode');
		if ($this->m_jw->simpan($jenis,$kode)){
			echo $this->session->set_flashdata('msg','success');
			redirect('admin/jenis_wadah');
		}else{
			echo $this->session->set_flashdata('msg','warning');
			redirect('admin/jenis_wadah');
		}
				
	}
	
	function update(){
		$jenis=$this->input->post('xjenis');
		$kode=$this->input->post('xkode');
		$id=$this->input->post('xid');
		$this->m_jw->update($id,$jenis,$kode);
		echo $this->session->set_flashdata('msg','info');
		redirect('admin/jenis_wadah');
	}

	function hapus(){
		$kode=$this->input->post('kode');
		$this->m_jw->hapus($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/jenis_wadah');
	}

}