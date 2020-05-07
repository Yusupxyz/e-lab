<?php
class Sifat_pengujian extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_sp');
		$this->load->library('upload');
	}


	function index(){
		$x['data']=$this->m_sp->get_all();
		$x['pratitle']="Sifat Pengujian";
		$x['title']="Daftar Sifat Pengujian";
		$this->load->view('admin/sifat_pengujian/v_sifat_pengujian',$x);
	}
	function add_sifat_pengujian(){
		$x['pratitle']="Sifat Pengujian";
		$x['title']="Tambah Sifat Pengujian";
		$this->load->view('admin/sifat_pengujian/v_add_sifat_pengujian',$x);
	}
	function get_edit(){
		$kode=$this->uri->segment(4);
		$x['data']=$this->m_sp->get_tentang_by_kode($kode)->row();
		$x['pratitle']="Sifat Pengujian";
		$x['title']="Daftar Sifat Pengujian";
		$this->load->view('admin/sifat_pengujian/v_edit_sifat_pengujian',$x);
	}

	function simpan_sifat_pengujian(){
		$sifat=$this->input->post('xsifat');
		if ($this->m_sp->simpan_sp($sifat)){
			echo $this->session->set_flashdata('msg','success');
			redirect('admin/sifat_pengujian');
		}else{
			echo $this->session->set_flashdata('msg','warning');
			redirect('admin/sifat_pengujian');
		}
				
	}
	
	function update_sifat_pengujian(){
		$sifat=$this->input->post('xsifat');
		$id=$this->input->post('xid');
		$this->m_sp->update($id,$sifat);
		echo $this->session->set_flashdata('msg','info');
		redirect('admin/sifat_pengujian');
	}

	function hapus_sifat_pengujian(){
		$kode=$this->input->post('kode');
		$this->m_sp->hapus($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/sifat_pengujian');
	}

}