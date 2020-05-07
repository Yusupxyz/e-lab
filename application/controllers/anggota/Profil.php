<?php
class Profil extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_anggota');
		$this->load->library('upload');
	}


	function index(){
		$x['data']=$this->m_anggota->get_all_anggota()->row();
		$x['title'] = 'Profil';
		$this->load->view('anggota/v_profil',$x);
	}

	function update_anggota(){
		$kode=$this->session->userdata('idadmin');
		$nama=$this->input->post('nama');
		$alamat=$this->input->post('alamat');
		$username=$this->input->post('username');
		$personil=$this->input->post('personil');
		$jl=$this->input->post('jl');
		$kontak=$this->input->post('kontak');
		$konfirmasipassword=$this->input->post('konfirmasipassword');
		if ($konfirmasipassword==$this->session->userdata('password')){
			$update=$this->m_anggota->update_anggota($kode,$nama,$username,$alamat,$personil,$jl,$kontak);
			if ($update){
				$this->session->set_flashdata('success', 'Profil berhasil diubah.');
				redirect('anggota/profil');
			}else{
				$this->session->set_flashdata('error','Profil gagal diubah.');
				redirect('anggota/profil');
			}
		}else{
			$this->session->set_flashdata('error','Password salah. Profil gagal diubah.');
			redirect('anggota/profil');
		}
	}

	function update_password(){
		$kode=$this->session->userdata('idadmin');
		$password=$this->input->post('password');
		$oldpassword=$this->input->post('oldpassword');
		$repassword=$this->input->post('repassword');
		if ($repassword==$password){
			if ($oldpassword==$this->session->userdata('password')){
				$update=$this->m_anggota->resetpass($kode,$password);
				if ($update){
					$this->session->unset_userdata('password');
					$this->session->set_userdata('password', $password);
					$this->session->set_flashdata('success', 'Password berhasil diubah.');
					redirect('anggota/profil');
				}else{
					$this->session->set_flashdata('error','Password gagal diubah.');
					redirect('anggota/profil');
				}
			}else{
				$this->session->set_flashdata('error','Password salah. Password gagal diubah.');
				redirect('anggota/profil');
			}
		}else{
			$this->session->set_flashdata('error','Password baru tidak sama. Password gagal diubah.');
			redirect('anggota/profil');
		}
	}


}