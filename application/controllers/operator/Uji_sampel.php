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
		$this->load->model('m_satuan');
		$this->load->library('upload');
	}


	function index(){
		$x['data']=$this->m_uji_sampel->get_all_proses();
		$x['pratitle'] = 'Kelola Uji Sampel';
		$x['title']="Kelola Status";
		foreach ($x['data']->result_array() as $a) {
			$x['detail'][]=$this->m_parameter_us->get_by_fk($a['us_id'])->result_array();
		}
		$x['attribute'] = 'class="form-control" required';
        $x['attribute2'] = 'class="form-control" id="xstatus"';
		$x['status']=$this->m_status->dd2();
		$x['status2']=$this->m_status->dd3();
		$x['status3']=$this->m_status->dd4();
		$x['status4']=$this->m_status->dd5();
		// var_dump($x['detail']);
		$this->load->view('operator/uji_sampel/v_status',$x);
	}

	function transaksi(){
		$x['data']=$this->m_uji_sampel->get_all_proses2();
		$x['pratitle'] = 'Kelola Uji Sampel';
		$x['title']="Kelola Transaksi";
		foreach ($x['data']->result_array() as $a) {
			$x['detail'][]=$this->m_parameter_us->get_by_fk($a['us_id'])->result_array();
		}
		// var_dump($x['detail']);
		$this->load->view('operator/uji_sampel/v_transaksi',$x);
	}

	function informasi(){
		$x['data']=$this->m_uji_sampel->get_all_proses2();
		$x['pratitle'] = 'Kelola Uji Sampel';
		$x['title']="Kelola Informasi Sampel";
		$x['am']=$this->m_am->dd();
		$x['kondisi_list']=array("" => "--Pilih Kondisi--",
								"Terbuka" => "Terbuka",
								"Tertutup" => "Tertutup",
								);
        $x['attribute'] = 'class="form-control" required';
		$this->load->view('operator/uji_sampel/v_informasi',$x);
	}

	function bayar(){
		$id=$this->input->post('xid');
		$bayar=$this->input->post('xbayar');
		$status=$this->input->post('xstatus');
		$sisa=$this->input->post('xsisa')-$this->input->post('xbayar');

		if ($this->m_transaksi->simpan($id,$bayar)){
			if ($this->m_uji_sampel->update_sisa($id,$sisa)){
				if ($status=="5"){
					$status='7';
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
					echo $this->session->set_flashdata('msg','success');
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
		$catatan=$this->input->post('xcatatan');

		if ($this->m_uji_sampel->update_status($id,$status,$catatan)){
			if ($status=="6"){
				$this->m_uji_sampel->update_tanggal_pengujian_awal($id);
				echo $this->db->last_query();
			}
			// echo $this->db->last_query();
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

	function update_informasi(){
		$id=$this->input->post('xid');
		$oleh=$this->input->post('xoleh');
		$no=$this->input->post('xno');
		$kondisi=$this->input->post('xkondisi');

		if ($this->m_uji_sampel->update_informasi($id,$no,$kondisi)){
			if ($oleh=='Laboratorium'){
				$tanggal=$this->input->post('xtanggal');
				$lokasi=$this->input->post('xlokasi');
				$titik=$this->input->post('xtitik');
				$metode=$this->input->post('xmetode');
				$rincian=$this->input->post('xrincian');
				$this->m_uji_sampel->update_tanggal_pengambilan($id,$tanggal);
				$this->m_uji_sampel->update_pengambilan($id,$lokasi,$titik,$metode,$rincian);
				echo $this->session->set_flashdata('msg','success');
				echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel/informasi';</script>";
			}else{
				$this->m_uji_sampel->update_tanggal_pengambilan($id);
				echo $this->session->set_flashdata('msg','success');
				echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel/informasi';</script>";
			}
		}else{
			echo $this->session->set_flashdata('msg','warning');
			echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel/informasi';</script>";
		}	
	}

	function selesai(){
		$id=$this->input->post('kode');
		$catatan="Pengujian telah selesai.";
		$status="2";

		if ($this->m_uji_sampel->update_status($id,$status,$catatan)){
			$this->m_uji_sampel->update_tanggal_pengujian_akhir($id);
			// echo $this->db->last_query();
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
		$kode=$this->uri->segment(4);
		$x['kode'] = $kode;
		$x['pratitle'] = 'Kelola Uji Sampel';
		$x['title']="Kelola Status";
		$x['data']=$this->m_parameter_us->get_by_kode($kode);
		$x['am']=$this->m_am->dd();
		$x['satuan']=$this->m_satuan->dd();
		$x['kondisi_list']=array("" => "--Pilih Kondisi--",
								"Terbuka" => "Terbuka",
								"Tertutup" => "Tertutup",
								);
        $x['attribute'] = 'class="form-control" required';
		// echo $this->db->last_query();
		$this->load->view('operator/uji_sampel/v_hasil',$x);
	}

	function update_hasil(){
		$id=$this->input->post('xid');
		$metode=$this->input->post('xmetode');
		$hasil=$this->input->post('xhasil');
		$satuan=$this->input->post('xsatuan');
		$us_id=$this->input->post('xus_id');

		if ($this->m_parameter_us->update_hasil($id,$metode,$hasil,$satuan)){
			// echo $this->db->last_query();
			echo $this->session->set_flashdata('msg','success');
			echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel/isi_laporan/".$us_id."';</script>";
		}else{
			echo $this->session->set_flashdata('msg','warning');
			echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel/isi_laporan/".$us_id."';</script>";
		}	
	}

}