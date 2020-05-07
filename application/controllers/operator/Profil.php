<?php
class Profil extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_pengguna');
		$this->load->library('upload');
	}


	function index(){
		$id=$this->session->userdata('idadmin');
		$x['data']=$this->m_pengguna->get_pengguna($id)->row();
		$x['title'] = 'Profil';
		$this->load->view('operator/v_profil',$x);
	}

	function update(){
		$config['upload_path'] = './assets/images/profil/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
		$this->upload->initialize($config);
		echo $_FILES['filefoto']['name'];
		if(!empty($_FILES['filefoto']['name']))
		{
			if ($this->upload->do_upload('filefoto'))
			{
					$gbr = $this->upload->data();
					//Compress Image
					$config['image_library']='gd2';
					$config['source_image']='./assets/images/profil/'.$gbr['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '60%';
					$config['width']= 300;
					$config['height']= 300;
					$config['new_image']= './assets/images/'.$gbr['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					$gambar=$gbr['file_name'];
					$kode=$this->session->userdata('idadmin');
					$nama=$this->input->post('nama');
					$email=$this->input->post('email');
					$username=$this->input->post('username');
					$jl=$this->input->post('jl');
					$nohp=$this->input->post('nohp');
					$konfirmasipassword=$this->input->post('konfirmasipassword');

					if ($konfirmasipassword==$this->session->userdata('password')){
						$update=$this->m_pengguna->update_pengguna_tanpa_pass($kode,$nama,$jl,$username,$konfirmasipassword,$email,$nohp,'2',$gambar);
						if ($update){
							$this->session->set_flashdata('success', 'Profil berhasil diubah.');
							redirect('operator/profil');
						}else{
							$this->session->set_flashdata('error','Profil gagal diubah.');
							redirect('operator/profil');
						}
					}else{
						$this->session->set_flashdata('error','Password salah. Profil gagal diubah.');
						redirect('operator/profil');
					}
				
			}else{
				echo $this->session->set_flashdata('msg','warning');
				redirect('admin/pengguna');
			}
				
		}else{
			$kode=$this->session->userdata('idadmin');
			$nama=$this->input->post('nama');
			$email=$this->input->post('email');
			$username=$this->input->post('username');
			$jl=$this->input->post('jl');
			$nohp=$this->input->post('nohp');
			$konfirmasipassword=$this->input->post('konfirmasipassword');

			if ($konfirmasipassword==$this->session->userdata('password')){
				$update=$this->m_pengguna->update_pengguna_tanpa_pass_dan_gambar($kode,$nama,$jl,$username,$konfirmasipassword,$email,$nohp,'2');
				if ($update){
					$this->session->set_flashdata('success', 'Profil berhasil diubah.');
					redirect('operator/profil');
				}else{
					$this->session->set_flashdata('error','Profil gagal diubah.');
					redirect('operator/profil');
				}
			}else{
				$this->session->set_flashdata('error','Password salah. Profil gagal diubah.');
				redirect('operator/profil');
			}
		} 
	}

	function update_password(){
		$kode=$this->session->userdata('idadmin');
		$password=$this->input->post('password');
		$oldpassword=$this->input->post('oldpassword');
		$repassword=$this->input->post('repassword');
		if ($repassword==$password){
			if ($oldpassword==$this->session->userdata('password')){
				$update=$this->m_pengguna->resetpass($kode,$password);
				if ($update){
					$this->session->unset_userdata('password');
    				$this->session->set_userdata('password', $password);
					$this->session->set_flashdata('success', 'Password berhasil diubah.');
					redirect('operator/profil');
				}else{
					$this->session->set_flashdata('error','Password gagal diubah.');
					redirect('operator/profil');
				}
			}else{
				$this->session->set_flashdata('error','Password salah. Password gagal diubah.');
				redirect('operator/profil');
			}
		}else{
			$this->session->set_flashdata('error','Password baru tidak sama. Password gagal diubah.');
			redirect('operator/profil');
		}
	}


}