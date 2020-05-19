<?php
class Uji_sampel extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_anggota');
		$this->load->model('m_js');
		$this->load->model('m_jw');
		$this->load->model('m_sp');
		$this->load->model('m_am');
		$this->load->model('m_pu');
		$this->load->model('m_status');
		$this->load->model('m_uji_sampel');
		$this->load->model('m_parameter_us');
		$this->load->model('m_transaksi');
		$this->load->model('m_setting_email');
		$this->load->library('upload');
	}


	function index(){
		$x['data']=$this->m_uji_sampel->get_all_proses();
		$x['pratitle'] = 'Kelola Uji Sampel';
		$x['title']="Kelola Data";
		foreach ($x['data']->result_array() as $a) {
			$x['detail'][]=$this->m_parameter_us->get_by_fk($a['us_id'])->result_array();
		}
		$x['am']=$this->m_am->dd();
        $x['attribute'] = 'class="form-control" required';
		$x['status']=$this->m_status->dd2();
		// var_dump($x['detail']);
		$this->load->view('operator/uji_sampel/v_status',$x);
	}

	function transaksi(){
		$x['data']=$this->m_uji_sampel->get_all();
		$x['pratitle'] = 'Kelola Uji Sampel';
		$x['title']="Kelola Transaksi";
		foreach ($x['data']->result_array() as $a) {
			$x['detail'][]=$this->m_parameter_us->get_by_fk($a['us_id'])->result_array();
		}
		// var_dump($x['detail']);
		$this->load->view('operator/uji_sampel/v_transaksi',$x);
	}

	function bayar(){
		$id=$this->input->post('xid');
		$bayar=$this->input->post('xbayar');
		$sisa=$this->input->post('xsisa')-$this->input->post('xbayar');

		if ($this->m_transaksi->simpan($id,$bayar)){
			if ($this->m_uji_sampel->update_sisa($id,$sisa)){
				echo $this->session->set_flashdata('msg','success');
				echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel/transaksi';</script>";
			}else{
				echo $this->session->set_flashdata('msg','warning');
				echo "<script>window.top.location.href = '".base_url()."anggota/uji_sampel/transaksi';</script>";
			}
			echo $this->session->set_flashdata('msg','success');
			echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel/transaksi';</script>";
		}else{
			echo $this->session->set_flashdata('msg','warning');
			echo "<script>window.top.location.href = '".base_url()."anggota/uji_sampel/transaksi';</script>";
		}	
	}

	function update(){
		$id=$this->input->post('xid');
		$status=$this->input->post('xstatus');
		$no_sampel=$this->input->post('xno');
		$metode=$this->input->post('xmetode');
		$status=$this->input->post('xstatus');

		if ($this->m_uji_sampel->update_status($id,$status,$no_sampel,$metode)){
			$this->kirim_email($id);
			echo $this->session->set_flashdata('msg','success');
			echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel';</script>";
		}else{
			echo $this->session->set_flashdata('msg','warning');
			echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel';</script>";
		}	
	}

	function hapus(){
		$kode=$this->input->post('kode');
		$this->m_uji_sampel->hapus($kode);
		$this->m_parameter_us->hapus($kode);
		$file=$this->m_uji_sampel->get_by_kode($kode)->row()->us_file;
		unlink('assets/surat_permohonan/'.$file);
	    echo $this->session->set_flashdata('msg','success-hapus');
	    redirect('operator/uji_sampel');
	}

	function kirim_email($id){
		$email=$this->m_setting_email->get_all()->result();
		$from_email = $email[0]->setting_data; 
		$to_email = $this->m_uji_sampel->get_email_pengguna($id)->row1()->anggota_email; 
		// $to_email = 'yusufxyx114@gmail.com'; 

		$config = Array(
			   'protocol' => 'smtp',
			   'smtp_host' => 'ssl://smtp.googlemail.com',
			   'smtp_port' => $email[2]->setting_data,
			   'smtp_timeout' => '30',
			   'smtp_user' => $from_email,
			   'smtp_pass' => 'zhikanoseishin',
			   'mailtype'  => 'html', 
			   'charset'   => 'iso-8859-1'
	   );
	   var_dump($config);

		   $this->load->library('email', $config);
		   $this->email->set_newline("\r\n");   

		$this->email->from($from_email, 'nama'); 
		$this->email->to($to_email);
		$this->email->subject('Test Pengiriman Email'); 
		$this->email->message('Coba mengirim Email dengan CodeIgniter.'); 

		//Send mail 
		if($this->email->send()){
			   echo "Berhasil";
		}else {
			echo $this->email->print_debugger();
 
		} 
	}


}