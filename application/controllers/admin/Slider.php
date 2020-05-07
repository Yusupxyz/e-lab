<?php
class Slider extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_slider');
		$this->load->model('m_pengguna');
		$this->load->library('upload');
	}


	function index(){
		$x['data']=$this->m_slider->get_all_slider();
		$x['pratitle']="Slider";
		$x['title']="Daftar Slider";
		$this->load->view('admin/slider/v_slider',$x);
	}
	function add_slider(){
		$x['pratitle']="Slider";
		$x['title']="Tambah Slider";
		$this->load->view('admin/slider/v_add_slider',$x);
	}
	function get_edit(){
		$kode=$this->uri->segment(4);
		$x['data']=$this->m_slider->get_slider_by_kode($kode)->row();
		$x['pratitle']="Slider";
		$x['title']="Daftar Slider";
		$this->load->view('admin/slider/v_edit_slider',$x);
	}
	function simpan_slider(){
		$config['upload_path'] = './assets/slider/'; //path folder
		$config['allowed_types'] = 'jpg|png'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if(!empty($_FILES['xfoto']['name']))
		{
			if ($this->upload->do_upload('xfoto'))
			{
					$gbr = $this->upload->data();

					$gambar=$gbr['file_name'];
					$judul=$this->input->post('xjudul');
					$tombol=$this->input->post('xtombol');
					$link=$this->input->post('xlink');
					$this->m_slider->simpan_slider($judul,$tombol,$link,$gambar);
					echo $this->session->set_flashdata('msg','success');
					redirect('admin/slider');
			}else{
				echo $this->session->set_flashdata('msg','warning');
				redirect('admin/slider');
			}
				
		}else{
			redirect('admin/slider');
		}
				
	}
	
	function update_slider(){
				
		$config['upload_path'] = './assets/slider/'; //path folder
		$config['allowed_types'] = 'jpg|png'; //type yang dapat diakses bisa anda sesuaikan
		$config['overwrite'] = TRUE; //nama yang terupload nantinya
		$config['file_name'] = $this->input->post('xikonlama');

		$this->upload->initialize($config);
		if(!empty($_FILES['xfoto']['name']))
		{
			if ($this->upload->do_upload('xfoto'))
			{
				$gbr = $this->upload->data();

				$gambar=$gbr['file_name'];
				$judul=$this->input->post('xjudul');
				$tombol=$this->input->post('xtombol');
				$link=$this->input->post('xlink');
				$id=$this->input->post('xid');
				$this->m_slider->update_slider($id,$judul,$tombol,$link,$gambar);
				echo $this->session->set_flashdata('msg','info');
				redirect('admin/slider');
				
			}else{
				echo $this->session->set_flashdata('msg','warning');
				redirect('admin/slider');
			}
			
		}else{
			$id=$this->input->post('xid');
			$judul=$this->input->post('xjudul');
			$tombol=$this->input->post('xtombol');
			$link=$this->input->post('xlink');
			$this->m_slider->update_slider_tanpa_img($id,$judul,$tombol,$link);
			echo $this->session->set_flashdata('msg','info');
			redirect('admin/slider');
		} 

	}

	function hapus_slider(){
		$kode=$this->input->post('kode');
		$gambar=$this->input->post('gambar');
		$path='./assets/slider/'.$gambar;
		unlink($path);
		$this->m_slider->hapus_slider($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/slider');
	}

}