<?php
class Layanan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_layanan');
		$this->load->library('upload');
	}


	function index(){
		$x['data']=$this->m_layanan->get_all_layanan();
		$x['pratitle']="Layanan Lab";
		$x['title']="Daftar Layanan Lab";
		$this->load->view('admin/layanan/v_layanan',$x);
	}
	function add_layanan(){
		$x['pratitle']="Layanan Lab";
		$x['title']="Tambah Layanan Lab";
		$this->load->view('admin/layanan/v_add_layanan',$x);
	}
	function get_edit(){
		$kode=$this->uri->segment(4);
		$x['data']=$this->m_layanan->get_layanan_by_kode($kode)->row();
		$x['pratitle']="Layanan Lab";
		$x['title']="Daftar Layanan Lab";
		$this->load->view('admin/layanan/v_edit_layanan',$x);
	}
	function simpan_layanan(){
		$config['upload_path'] = './assets/layanan/'; //path folder
		$config['allowed_types'] = 'jpg|png'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if(!empty($_FILES['xikon']['name']))
		{
			if ($this->upload->do_upload('xikon'))
			{
					$gbr = $this->upload->data();

					$gambar=$gbr['file_name'];
					$penjelasan=$this->input->post('xpenjelasan');
					$nama=$this->input->post('xnama');
					$this->m_layanan->simpan_layanan($penjelasan,$nama,$gambar);
					echo $this->session->set_flashdata('msg','success');
					redirect('admin/layanan');
			}else{
				echo $this->session->set_flashdata('msg','warning');
				redirect('admin/layanan');
			}
				
		}else{
			redirect('admin/layanan');
		}
				
	}
	
	function update_layanan(){
				
		$config['upload_path'] = './assets/layanan/'; //path folder
		$config['allowed_types'] = 'png'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
		$this->upload->initialize($config);

		if(!empty($_FILES['xikon']['name']))
		{
			if ($this->upload->do_upload('xikon'))
			{
				$gbr = $this->upload->data();
				// var_dump($gbr);
				$gambar=$gbr['file_name'];
				$nama=$this->input->post('xnama');
				$penjelasan=$this->input->post('xpenjelasan');
				$id=$this->input->post('xid');
				$this->m_layanan->update_layanan($id,$nama,$penjelasan,$gambar);
			 	$path='./assets/layanan/'.$this->input->post('xikonlama');
				unlink($path);
				$this->session->set_flashdata('msg','info');
				redirect('admin/layanan');
				
			}else{
				echo $this->session->set_flashdata('msg','warning');
				redirect('admin/layanan');
			}
			
		}else{
			$nama=$this->input->post('xnama');
			$penjelasan=$this->input->post('xpenjelasan');
			$id=$this->input->post('xid');
			$this->m_layanan->update_layanan_tanpa_img($id,$nama,$penjelasan);
			echo $this->session->set_flashdata('msg','info');
			redirect('admin/layanan');
		} 

	}

	function hapus_layanan(){
		$kode=$this->input->post('kode');
		$ikon=$this->input->post('ikon');
		$path='./assets/layanan/'.$ikon;
		unlink($path);
		$this->m_layanan->hapus_layanan($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/layanan');
	}

	function upload(){
		if(isset($_FILES['upload']['name']))
		{
			$file = $_FILES['upload']['tmp_name'];
			$file_name = $_FILES['upload']['name'];
			$file_name_array = explode(".", $file_name);
			$extension = end($file_name_array);
			$new_image_name = rand() . '.' . $extension;
			$allowed_extension = array("jpg", "gif", "png");
			if(in_array($extension, $allowed_extension))
			{
				move_uploaded_file($file, './assets/upload/' . $new_image_name);
				$function_number = $_GET['CKEditorFuncNum'];
				$url = base_url().'assets/upload/'.$new_image_name;
				$message = '';
				echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
			}
		}
	}

}