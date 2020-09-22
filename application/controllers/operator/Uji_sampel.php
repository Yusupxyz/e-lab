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
		$this->load->model('m_kontak');
		$this->load->model('m_uji_sampel');
		$this->load->model('m_parameter_us');
		$this->load->model('m_transaksi');
		$this->load->model('m_setting_email');
		$this->load->model('m_satuan');
		$this->load->library('upload');
		$this->load->library('pdf');
	}


	function index(){
		$this->m_uji_sampel->update_status_notif();
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
		$x['jenis']=array("" => "--Pilih Kondisi--",
								"1" => "Uang Muka",
								"2" => "Lunas",
								);
		// var_dump($x);
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
		$jenis=$this->input->post('xjenis');
		$sisa=$this->input->post('xsisa')-$this->input->post('xbayar');

		if ($this->m_transaksi->simpan($id,$bayar)){
			if ($this->m_uji_sampel->update_sisa($id,$sisa)){
				if ($status=="5"){
					$status='7';
					$catatan="Transaksi (".$jenis.") berhasil, uji sampel memasuki tahap proses.";
					if ($this->m_uji_sampel->update_status_dari_transaksi($id,$status,$catatan)){
						$status_id_setting_email=$this->m_status->get_by_kode($status)->row()->status_id_setting_email;
						$status_nama=$this->m_status->get_by_kode($status)->row()->status_nama;
						$anggota_email=$this->m_uji_sampel->get_anggota($id)->row()->anggota_email;
						if ($status_id_setting_email!=0){
							$this->kirim_email($anggota_email,$status_id_setting_email,$status_nama,$catatan,$jenis);
							$this->struk($id,$jenis,$bayar);
						}else{
							$this->struk($id,$jenis,$bayar);
							echo $this->session->set_flashdata('msg','success');
						}
					}else{
						echo $this->session->set_flashdata('msg','warning');
						echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel/transaksi';</script>";
					}	
				}else{
					$catatan="Transaksi (".$jenis.") berhasil, uji sampel memasuki tahap proses.";
					$status_id_setting_email=$this->m_status->get_by_kode('7')->row()->status_id_setting_email;
					$status_nama=$this->m_status->get_by_kode('7')->row()->status_nama;
					$anggota_email=$this->m_uji_sampel->get_anggota($id)->row()->anggota_email;
					$this->kirim_email($anggota_email,$status_id_setting_email,$status_nama,$catatan,$jenis);
					$this->struk($id,$jenis,$bayar);
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
				// echo $this->db->last_query();
			}
			// echo $this->db->last_query();
			$status_id_setting_email=$this->m_status->get_by_kode($status)->row()->status_id_setting_email;
			$status_nama=$this->m_status->get_by_kode($status)->row()->status_nama;
			$anggota_email=$this->m_uji_sampel->get_anggota($id)->row()->anggota_email;
			if ($status_id_setting_email!=0){
				if ($status=="8"){
					$file=$this->m_uji_sampel->get_by_kode($id)->row()->us_laporan;
					$this->kirim_email($anggota_email,$status_id_setting_email,$status_nama,$catatan,null,$file);
				}else{
					$this->kirim_email($anggota_email,$status_id_setting_email,$status_nama,$catatan);
				}
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
			echo $this->db->last_query();
			if ($oleh=='Laboratorium'){
				$tanggal=$this->input->post('xtanggal');
				$lokasi=$this->input->post('xlokasi');
				$metode=$this->input->post('xmetode');
				$rincian=$this->input->post('xrincian');
				$this->m_uji_sampel->update_tanggal_pengambilan($id,$tanggal);
				$this->m_uji_sampel->update_pengambilan($id,$lokasi,$metode,$rincian);
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
			$anggota_email=$this->m_uji_sampel->get_anggota($id)->row()->anggota_email;
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

	function kirim_email($to_email,$status,$status_nama,$catatan,$jenis=null,$file=null){
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
		if ($file!=null){
			// echo 'C:\xampp\htdocs\e-lab\assets\hasil_pengujian/'.$file;
			$this->email->attach('C:\xampp\htdocs\e-lab\assets\hasil_pengujian/'.$file);
		}

		//Send mail 
		if ($jenis!=null){
			if($this->email->send()){
				echo $this->session->set_flashdata('msg','success2');
			}else {
				echo $this->email->print_debugger();
				echo $this->session->set_flashdata('msg','error2');
				echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel/transaksi';</script>";
			} 
		}else{
			if($this->email->send()){
				echo $this->session->set_flashdata('msg','success2');
				echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel';</script>";
			}else {
				echo $this->email->print_debugger();
				echo $this->session->set_flashdata('msg','error2');
				echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel';</script>";
			} 
		}
	}

	function isi_laporan(){
		$kode=$this->uri->segment(4);
		$x['kode'] = $kode;
		$x['pratitle'] = 'Kelola Uji Sampel';
		$x['title']="Kelola Status";
		$x['data']=$this->m_parameter_us->get_by_kode($kode);
		$x['ih']=$this->m_uji_sampel->get_ih_by_kode($kode)->row();
		$x['am']=$this->m_am->dd();
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
		$us_id=$this->input->post('xus_id');

		if ($this->m_parameter_us->update_hasil($id,$metode,$hasil)){
			// echo $this->db->last_query();
			echo $this->session->set_flashdata('msg','success');
			echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel/isi_laporan/".$us_id."';</script>";
		}else{
			echo $this->session->set_flashdata('msg','warning');
			echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel/isi_laporan/".$us_id."';</script>";
		}	
	}

	function update_ih(){
		$id=$this->input->post('kode');
		$xpenyimpangan=$this->input->post('xpenyimpangan');
		$xpersyaratan=$this->input->post('xpersyaratan');

		if ($this->m_uji_sampel->update_ih($id,$xpenyimpangan,$xpersyaratan)){
			echo $this->db->last_query();
			echo $this->session->set_flashdata('msg','success');
			echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel/isi_laporan/".$id."';</script>";
		}else{
			echo $this->session->set_flashdata('msg','warning');
			echo "<script>window.top.location.href = '".base_url()."operator/uji_sampel/isi_laporan/".$id."';</script>";
		}	
	}

	private function struk($id,$jenis,$uang){
		$kontak=$this->m_kontak->get_all_kontak()->result();
		$laporan=$this->m_uji_sampel->get_laporan_bykode($id)->row();
		$nomor=3;
		$email=$kontak[3]->kontak_data;
		$alamat=$kontak[1]->kontak_data;
		$telp=$kontak[2]->kontak_data;
		$teks1='PEMERINTAH KOTA PALANGKA RAYA';
		$teks2='DINAS LINGKUNGAN HIDUP DAN KEHUTANAN';
		$teks3='UNIT PELAKSANA TEKNIS (UPT) LABORATORIUM LINGKUNGAN';
		$teks4='Email : '.$email;
		$teks5=$alamat.' Telp. '.$telp;
		$pdf = new FPDF('P','mm',array(210,330));
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
		$pdf->SetFont('Courier','B',12);
		$this->letak(base_url().'assets/images/logo%20plk.png',$pdf);
		//meletakkan judul disamping logo diatas
		$this->judul($pdf,$teks1,$teks2 ,$teks3,$teks4,$teks5);
		//membuat garis ganda tebal dan tipis
		$this->garis($pdf);

		$this->body($pdf,$id,$uang,$jenis);
		$this->garis2($pdf);
		$this->footer($pdf);
		if ($jenis==2){
			$pdf->SetFont('Helvetica','','12');
			$pdf->Cell(-10);
			$pdf->Cell(100,6,'--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,1,'L');
			$this->lembar_dua($pdf,$id,$laporan);	
		}
		$pdf->Output('I','struk.pdf');
	}

	private function letak($gambar,$pdf){
		//memasukkan gambar untuk header
		$pdf->Image($gambar,10,8,25,25);
		//menggeser posisi sekarang
	}
	
	private function judul($pdf,$teks1, $teks2, $teks3, $teks4, $teks5){
		$pdf->Cell(20);
		$pdf->SetFont('Helvetica','B','12');
		$pdf->Cell(0,6,$teks1,0,1,'C');
		$pdf->Cell(20);
		$pdf->Cell(0,6,$teks2,0,1,'C');
		$pdf->Cell(20);
		$pdf->SetFont('Helvetica','B','14');
		$pdf->Cell(0,6,$teks3,0,1,'C');
		$pdf->Cell(20);
		$pdf->SetFont('Helvetica','B','10');
		$pdf->Cell(0,6,$teks5,0,1,'C');
		$pdf->Cell(20);
		$pdf->Cell(0,2,$teks4,0,1,'C');
	}
	
	private function garis($pdf){
		$pdf->SetLineWidth(0);
		$pdf->Line(12.6,38,196.4,38);
		$pdf->SetLineWidth(1);
		$pdf->Line(13,39,196,39);
	}

	private function body($pdf,$id,$uang,$jenis){
		if ($jenis=="1"){
			$jenis="Uang Muka";
		}else{
			$jenis="Lunas";
		}		$terbilang=$this->terbilang($uang);
		$pelanggan=$this->m_uji_sampel->get_anggota($id)->row();
		// var_dump($pelanggan);
		$pdf->Cell(0,10,'',0,1,'L');
		$pdf->Cell(1);
		$pdf->SetFont('Helvetica','','12');
		$pdf->Cell(0,10,'Bendahara Penerima',0,0,'L');
		$pdf->Cell(-100);
		$pdf->Cell(0,10,': DLH Kota Palangka Raya',0,1,'L');
		$pdf->Cell(1);
		$pdf->Cell(0,10,'Telah menerima uang sebesar',0,0,'L');
		$pdf->Cell(-100);
		$pdf->Cell(0,10,': Rp '.number_format($uang).',-',0,1,'L');
		$pdf->Cell(1);
		$pdf->Cell(0,10,'Terbilang',0,0,'L');
		$pdf->Cell(-100);
		$pdf->Cell(0,10,': '.$terbilang,0,1,'L');
		$pdf->Cell(1);
		$pdf->Cell(0,10,'Dari ',0,0,'L');
		$pdf->Cell(-100);
		$pdf->Cell(0,10,': '.$pelanggan->anggota_nama,0,1,'L');
		$pdf->Cell(1);
		$pdf->Cell(0,10,'Alamat ',0,0,'L');
		$pdf->Cell(-100);
		$pdf->Cell(0,10,': '.$pelanggan->anggota_alamat,0,1,'L');
		$pdf->Cell(1);
		$pdf->Cell(0,10,'Pembayaran ',0,0,'L');
		$pdf->Cell(-100);
		$pdf->Cell(0,10,': Biaya Pengujian Sampel',0,1,'L');
		$pdf->Cell(1);
		$pdf->Cell(0,10,'Keterangan ',0,0,'L');
		$pdf->Cell(-100);
		$pdf->Cell(0,10,': '.$jenis,0,1,'L');
	}

	private function garis2($pdf){
		$pdf->SetLineWidth(0);
		$pdf->Line(12.6,118,196.4,118);
	}

	private function footer($pdf){
		$date = date('Y-m-d', time());
		$pdf->SetFont('Helvetica','','12');
		$pdf->Cell(1);
		$pdf->Cell(0,3,'',0,1,'L');
		$pdf->Cell(1);
		$pdf->Cell(0,5,'Uang tersebut diatas diterima di Palangka Raya',0,1,'L');
		$pdf->Cell(1);
		$pdf->Cell(0,5,'Tanggal, '.date_indo($date),0,1,'L');
		$pdf->Cell(1);
		$pdf->Cell(0,3,'',0,1,'L');
		$pdf->Cell(100,5,'Penerima,',0,0,'C');
		$pdf->Cell(100,5,'Penyetor,',0,1,'C');
		$pdf->Cell(0,14,'',0,1,'R');
		$pdf->Cell(1);
		$pdf->Cell(0,3,'',0,1,'L');
		$pdf->Cell(100,5,'(.................................)',0,0,'C');
		$pdf->Cell(100,5,'(.................................)',0,1,'C');

	}

	private function lembar_dua($pdf,$id,$laporan){
		$pelanggan=$this->m_uji_sampel->get_anggota($id)->row();
		$sifat=$this->m_sp->get_all()->result();
		$pembatas=count($sifat);
		$hasil=$this->m_parameter_us->get_by_kode($id)->result();
		$a='A';
		$x=1;
		$pdf->Cell(20);
		$pdf->SetFont('Helvetica','B','12');
		$pdf->Cell(0,7,'',0,1,'C');
		$pdf->Cell(1);
		$pdf->Cell(0,6,'RINCIAN BIAYA PENGUJIAN SAMPEL '.strtoupper($laporan->lokasi),0,1,'C');
		$pdf->Cell(1);
		$pdf->Cell(0,6,$pelanggan->anggota_nama,0,1,'C');
		$pdf->SetLineWidth(0);
		$pdf->Cell(1);
		$pdf->SetFont('Helvetica','','12');
		$pdf->Cell(0,5,'',0,1,'L');
		$pdf->Cell(30);
		$pdf->SetFont('Times','B','12');
		$pdf->Cell(11,6,'NO.',1,0,'C');
		$pdf->Cell(70,6,'PARAMETER',1,0,'C');
		$pdf->Cell(40,6,'HARGA SATUAN',1,1,'C');
		foreach ($sifat as $key => $value) {
			$pembatas--;
			$pdf->Cell(30);
			$pdf->Cell(11,6,'',1,0,'L');
			$pdf->SetFont('Times','B','12');
			$pdf->Cell(70,6,$a++.'. '.$value->sp_jenis,1,0,'l');
			$pdf->SetFont('Times','','12');
			$pdf->Cell(40,6,'',1,1,'C');
			$parameter=$this->m_parameter_us->get_by_pu($value->sp_id)->result();
			// echo $this->db->last_query();
			foreach ($parameter as $key => $value2) {
				$pdf->Cell(30);
				$pdf->Cell(11,6,$x++.'.',1,0,'C');
				$pdf->Cell(70,6,$value2->pu_nama,1,0,'L');
				$pdf->Cell(40,6,number_format($value2->pu_tarif),1,1,'R');
			}
			if ($pembatas!=0){
				$pdf->Cell(30);
				$pdf->Cell(11,6,'',1,0,'C');
				$pdf->Cell(70,6,'',1,0,'L');
				$pdf->Cell(40,6,'',1,1,'R');
			}
		}
		$pdf->Cell(30);
		$pdf->Cell(81,6,'JUMLAH HARGA SATUAN',1,0,'C');
		$pdf->Cell(40,6,number_format($laporan->us_total),1,1,'R');
		$pdf->Cell(30);
	}

	function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = $this->penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . $this->penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . $this->penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim($this->penyebut($nilai));
		} else {
			$hasil = trim($this->penyebut($nilai));
		}     		
		return ucwords($hasil." rupiah");
	}
	

}