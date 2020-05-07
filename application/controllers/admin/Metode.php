<?php
class Metode extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_am');
		$this->load->library('upload');
	}

	function index(){
		$x['data']=$this->m_am->get_all();
		$x['pratitle']="Acuan Metode";
		$x['title']="Daftar Metode";
		$this->load->view('admin/metode/v_list',$x);
	}
	function add(){
		$x['pratitle']="Acuan Metode";
		$x['title']="Tambah Metode";
		$this->load->view('admin/metode/v_add',$x);
	}
	function get_edit(){
		$kode=$this->uri->segment(4);
		$x['data']=$this->m_am->get_by_kode($kode)->row();
		$x['pratitle']="Acuan Metode";
		$x['title']="Daftar Metode";
		$this->load->view('admin/metode/v_edit',$x);
	}

	function simpan(){
		$config['upload_path'] = './assets/metode/'; //path folder
		$config['allowed_types'] = 'pdf'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if(!empty($_FILES['xpdf']['name']))
		{
			if ($this->upload->do_upload('xpdf'))
			{
					$pdf = $this->upload->data();

					$pdf=$pdf['file_name'];
					$nama=$this->input->post('xnama');
					$this->m_am->simpan($nama,$pdf);
					echo $this->session->set_flashdata('msg','success');
					redirect('admin/metode');
				
			}else{
				echo $this->session->set_flashdata('msg','warning');
				redirect('admin/metode');
			}
				
		}else{
			$nama=$this->input->post('xnama');
			$pdf='-';
			$this->m_am->simpan($nama,$pdf);
			echo $this->session->set_flashdata('msg','success');
			redirect('admin/metode');
		} 		
	}
	
	function update(){
		$config['upload_path'] = './assets/metode/'; //path folder
		$config['allowed_types'] = 'pdf'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if(!empty($_FILES['xpdf']['name']))
		{
			if ($this->upload->do_upload('xpdf'))
			{
					$pdf = $this->upload->data();

					$pdf=$pdf['file_name'];
					$nama=$this->input->post('xnama');
					$id=$this->input->post('xid');
					$this->m_am->update($id,$nama,$pdf);
					echo $this->session->set_flashdata('msg','success');
					redirect('admin/metode');
				
			}else{
				echo $this->session->set_flashdata('msg','warning');
				redirect('admin/metode');
			}
				
		}else{
			$nama=$this->input->post('xnama');
			$id=$this->input->post('xid');
			$this->m_am->update_tanpa_pdf($id,$nama);
			echo $this->session->set_flashdata('msg','success');
			redirect('admin/metode');
		} 		
	}

	function hapus(){
		$kode=$this->input->post('kode');
		$this->m_am->hapus($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/metode');
	}

}