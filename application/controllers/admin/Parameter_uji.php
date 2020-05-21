<?php
class Parameter_uji extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
		};
		$this->load->model('m_pu');
		$this->load->model('m_sp');
		$this->load->library('upload');
	}


	function index(){
		$x['data']=$this->m_pu->get_all();
		$x['pratitle']="Parameter Uji";
		$x['title']="Daftar Parameter Uji";
		$this->load->view('admin/parameter_uji/v_list',$x);
	}
	function add_parameter_uji(){
		$x['pratitle']="Parameter Uji";
		$x['title']="Tambah Parameter Uji";
		$x['sp']=$this->m_sp->dd();
        $x['attribute'] = 'class="form-control" required';
        $x['xsifat'] = '';
		$this->load->view('admin/parameter_uji/v_add',$x);
	}
	function get_edit(){
		$kode=$this->uri->segment(4);
		$x['data']=$this->m_pu->get_by_kode($kode)->row();
		$x['pratitle']="Parameter Uji";
		$x['title']="Daftar Parameter Uji";
		$x['sp']=$this->m_sp->dd();
        $x['attribute'] = 'class="form-control" required';
		$this->load->view('admin/parameter_uji/v_edit',$x);
	}

	function simpan_parameter_uji(){
		$nama=$this->input->post('xparam');
		$sp=$this->input->post('xsifat');
		$tarif=$this->input->post('xtarif');
		$mutu=$this->input->post('xmutu');
		if ($this->m_pu->simpan($nama,$sp,$tarif,$mutu)){
			echo $this->session->set_flashdata('msg','success');
			redirect('admin/parameter_uji');
		}else{
			echo $this->session->set_flashdata('msg','warning');
			redirect('admin/parameter_uji');
		}
				
	}
	
	function update_parameter_uji(){
		$nama=$this->input->post('xparam');
		$sp=$this->input->post('xsifat');
		$tarif=$this->input->post('xtarif');
		$id=$this->input->post('xid');
		$mutu=$this->input->post('xmutu');
		$this->m_pu->update($id,$nama,$sp,$tarif,$mutu);
		echo $this->session->set_flashdata('msg','info');
		redirect('admin/parameter_uji');
	}

	function hapus_parameter_uji(){
		$kode=$this->input->post('kode');
		$this->m_pu->hapus($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/parameter_uji');
	}

}