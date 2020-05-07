<?php
class Laporan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
		};
		$this->load->model('m_uji_sampel');
		$this->load->library('upload');
	}


	function index(){
		$x['data']=$this->m_uji_sampel->get_laporan();
		$x['title'] = 'Laporan';
		$this->load->view('anggota/laporan/v_laporan',$x);
	}

	function update_anggota(){
		$kode=$this->session->userdata('idadmin');
		$nama=$this->input->post('nama');
		$alamat=$this->input->post('alamat');
		$username=$this->input->post('username');
		$personil=$this->input->post('personil');
		$jl=$this->input->post('jl');
		$kontak=$this->input->post('kontak');
		$update=$this->m_anggota->update_anggota($kode,$nama,$username,$alamat,$personil,$jl,$kontak);
		if ($update){
			$this->session->set_flashdata('success', 'Profil berhasil diubah.');
			redirect('anggota/profil');
		}else{
			$this->session->set_flashdata('error','Profil gagal diubah.');
			redirect('anggota/profil');
		}
	}

	function update_password(){
		$kode=$this->session->userdata('idadmin');
		$password=$this->input->post('password');
		$update=$this->m_anggota->resetpass($kode,$password);
		if ($update){
			$this->session->set_flashdata('success', 'Password berhasil diubah.');
			redirect('anggota/profil');
		}else{
			$this->session->set_flashdata('error','Password gagal diubah.');
			redirect('anggota/profil');
		}
	}


}