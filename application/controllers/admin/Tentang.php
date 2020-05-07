<?php
class Tentang extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_tentang');
		$this->load->library('upload');
	}


	function index(){
		$x['data']=$this->m_tentang->get_all_tentang();
		$x['pratitle']="Tentang Lab";
		$x['title']="Daftar Tentang Lab";
		$this->load->view('admin/tentang/v_tentang',$x);
	}
	function add_tentang(){
		$x['pratitle']="Tentang Lab";
		$x['title']="Tambah Tentang Lab";
		$this->load->view('admin/tentang/v_add_tentang',$x);
	}
	function get_edit(){
		$kode=$this->uri->segment(4);
		$x['data']=$this->m_tentang->get_tentang_by_kode($kode)->row();
		$x['pratitle']="Tentang Lab";
		$x['title']="Daftar Tentang Lab";
		$this->load->view('admin/tentang/v_edit_tentang',$x);
	}

	function simpan_tentang(){
		$isi=$this->input->post('xisi');
		$judul=$this->input->post('xjudul');
		if ($this->m_tentang->simpan_tentang($isi,$judul)){
			echo $this->session->set_flashdata('msg','success');
			redirect('admin/tentang');
		}else{
			echo $this->session->set_flashdata('msg','warning');
			redirect('admin/tentang');
		}
				
	}
	
	function update_tentang(){
		$isi=$this->input->post('xisi');
		$judul=$this->input->post('xjudul');
		$id=$this->input->post('xid');
		$this->m_tentang->update_tentang($id,$judul,$isi);
		echo $this->session->set_flashdata('msg','info');
		redirect('admin/tentang');
	}

	function hapus_tentang(){
		$kode=$this->input->post('kode');
		$this->m_tentang->hapus_tentang($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/tentang');
	}

}