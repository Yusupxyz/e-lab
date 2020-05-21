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
        $x['attribute2'] = 'class="form-control" id="xstatus"';
		$x['status']=$this->m_status->dd2();
		$x['status2']=$this->m_status->dd3();
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
				$status='6';
				$catatan="Transaksi berhasil, uji sampel memasuki tahap proses.";
				if ($this->m_uji_sampel->update_status_dari_transaksi($id,$status,$catatan)){
					$status_id_setting_email=$this->m_status->get_by_kode($status)->row()->status_id_setting_email;
					$status_nama=$this->m_status->get_by_kode($status)->row()->status_nama;
					$anggota_email=$this->m_uji_sampel->get_email_anggota($id)->row()->anggota_email;
					if ($status_id_setting_email!=0){
						$this->kirim_email($anggota_email,$status_id_setting_email,$status_nama,$catatan);
					}else{
						echo $this->session->set_flashdata('msg','success');
						echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel/transaksi';</script>";
					}
				}else{
					echo $this->session->set_flashdata('msg','warning');
					echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel/transaksi';</script>";
				}	
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
		$catatan=$this->input->post('xcatatan');
		$tggl=$this->input->post('xtanggalditerima');

		if ($this->m_uji_sampel->update_status($id,$status,$no_sampel,$metode,$catatan,$tggl)){
			$status_id_setting_email=$this->m_status->get_by_kode($status)->row()->status_id_setting_email;
			$status_nama=$this->m_status->get_by_kode($status)->row()->status_nama;
			$anggota_email=$this->m_uji_sampel->get_email_anggota($id)->row()->anggota_email;
			if ($status_id_setting_email!=0){
				$this->kirim_email($anggota_email,$status_id_setting_email,$status_nama,$catatan);
			}else{
				echo $this->session->set_flashdata('msg','success');
				echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel';</script>";
			}
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

	function kirim_email($to_email,$status,$status_nama,$catatan){
		$email=$this->m_setting_email->get_all()->result();
		$from_email = $email[0]->setting_data; 
		$nama_pengirim = $email[4]->setting_data;
		// $to_email = 'yusufxyx114@gmail.com'; 
		if (empty($catatan)){
			$catatan='-';
		}
		$config = Array(
			   'protocol' => 'smtp',
			   'smtp_host' => $email[1]->setting_data,
			   'smtp_port' => $email[2]->setting_data,
			   'smtp_timeout' => '30',
			   'smtp_user' => $from_email,
			   'smtp_pass' => $email[3]->setting_data,
			   'mailtype'  => 'html', 
			   'charset'   => 'iso-8859-1'
	   );
	//    var_dump($config);

		   $this->load->library('email', $config);
		   $this->email->set_newline("\r\n");   

		$this->email->from($from_email,$email[4]->setting_data); 
		$this->email->to($to_email);
		if ($status==6){
			$this->email->subject($email[5]->setting_data); 
			$this->email->message($email[7]->setting_data.' <b>'.$status_nama.'</b>. Terima kasih.<br>Catatan : <b>'.$catatan.'</b>'); 
		}elseif($status==7){
			$this->email->subject($email[6]->setting_data); 
			$this->email->message($email[7]->setting_data.' <b>'.$status_nama.'</b>. Terima kasih.<br>Catatan : <b>'.$catatan.'</b>'); 
		}

		//Send mail 
		if($this->email->send()){
			echo $this->session->set_flashdata('msg','success2');
			echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel';</script>";
		}else {
			echo $this->email->print_debugger();
			echo $this->session->set_flashdata('msg','error');
			echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel';</script>";
		} 
	}

	function isi_laporan(){

	}

}