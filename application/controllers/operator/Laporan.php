<?php
class Laporan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
		};
		$this->load->model('m_uji_sampel');
		$this->load->model('m_kontak');
		$this->load->model('m_uji_sampel');
		$this->load->model('m_parameter_us');
		$this->load->model('m_setting_ttd');
		$this->load->model('m_sp');
		$this->load->library('upload');
		$this->load->library('pdf');
	}


	function index(){
		$x['data']=$this->m_uji_sampel->get_laporan();
		$x['title'] = 'Laporan';
		$this->load->view('operator/laporan/v_laporan',$x);
	}

	function generate(){
		$kode=$this->uri->segment(4);
		$kontak=$this->m_kontak->get_all_kontak()->result();
		$laporan=$this->m_uji_sampel->get_laporan_bykode($kode)->row();
		$ttd=$this->m_setting_ttd->get_all()->result();
		$nomor=3;
		$email=$kontak[3]->kontak_data;
		$alamat=$kontak[1]->kontak_data;
		$telp=$kontak[2]->kontak_data;
		$teks1='PEMERINTAH KOTA PALANGKA RAYA';
		$teks2='DINAS LINGKUNGAN HIDUP';
		$teks3='UNIT PELAKSANA TEKNIS DAERAH (UPTD) LABORATORIUM LINGKUNGAN';
		$teks4='Email : '.$email;
		$teks5=$alamat.' Telp. '.$telp;
		$pdf = new FPDF('P','mm',array(210,330));
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
		$pdf->SetFont('Arial','B',16);
		$this->letak(base_url().'assets/images/logo%20plk.png',$pdf);
		//meletakkan judul disamping logo diatas
		$this->judul($pdf,$teks1,$teks2 ,$teks3,$teks4,$teks5);
		//membuat garis ganda tebal dan tipis
		$this->garis($pdf);
		$pdf->Cell(7);
		$pdf->SetFont('Times','BU','12');
		$pdf->Cell(0,8,"",0,1,'C');
		$pdf->Cell(0,5,"LEMBAR HASIL UJI",0,1,'C');
		$pdf->Cell(7);
		$pdf->SetFont('Times','','12');
		$pdf->Cell(0,5,"Nomor :         /DLH/UPTD.LL-LHU/".$this->numberToRomanRepresentation(date('m'))."/".date("Y"),0,1,'C');
		$this->informasi_pelanggan($pdf,$kode);
		$this->batas($pdf);
		$this->informasi_sampel($pdf,$kode,$laporan);
		if ($laporan->us_pengambilan=='Laboratorium'){	
			$this->batas($pdf);
			$this->informasi_pengambilan($pdf,$kode,$laporan);
			$nomor=4;
		}
		$this->batas($pdf);
		$this->informasi_interpretasi($pdf,$kode,$laporan,$nomor++);
		$this->batas($pdf);
		$this->informasi_hasil($pdf,$kode,$nomor);
		$this->catatan($pdf);
		$this->footer($pdf,$ttd);
		$name='doc'.$kode.'.pdf';
		$path='C:/xampp/htdocs/e-lab/assets/hasil_pengujian/'.$name;
		// $pdf->Output('F',$path);
		$pdf->Output('I',$path);
		if($this->m_uji_sampel->update_laporan($kode,$name)){
			echo $this->session->set_flashdata('msg','success');
			echo "<script>window.top.location.href = '".base_url()."operator/laporan';</script>";
		}else{
			echo $this->session->set_flashdata('msg','warning');
			echo "<script>window.top.location.href = '".base_url()."operator/laporan';</script>";
		}
	}

	private function letak($gambar,$pdf){
		//memasukkan gambar untuk header
		$pdf->Image($gambar,10,8,25,25);
		//menggeser posisi sekarang
	}
	
	private function judul($pdf,$teks1, $teks2, $teks3, $teks4, $teks5){
		$pdf->Cell(20);
		$pdf->SetFont('Times','B','18');
		$pdf->Cell(0,7,$teks1,0,1,'C');
		$pdf->Cell(20);
		$pdf->Cell(0,7,$teks2,0,1,'C');
		$pdf->Cell(20);
		$pdf->SetFont('Times','B','12');
		$pdf->Cell(0,3,$teks3,0,1,'C');
		$pdf->Cell(20);
		$pdf->SetFont('Times','B','10');
		$pdf->Cell(0,7,$teks4,0,1,'C');
		$pdf->Cell(20);
		$pdf->Cell(0,2,$teks5,0,1,'C');
	}
	
	private function garis($pdf){
		$pdf->SetLineWidth(0);
		$pdf->Line(12.6,38,196.4,38);
		$pdf->SetLineWidth(1);
		$pdf->Line(12,39,196,39);
		$pdf->SetLineWidth(0);

	}

	private function informasi_pelanggan($pdf,$id){
		$pelanggan=$this->m_uji_sampel->get_anggota($id)->row();
		// var_dump($pelanggan);
		$pdf->Cell(1);
		$pdf->Cell(0,5,'',0,1,'L');
		$pdf->Cell(7,5,'1.',1,0,'L');
		$pdf->Cell(180,5,'Informasi Pelanggan',1,1,'L');
		$pdf->SetFont('Times','','12');
		$pdf->Cell(7,5,'',1,0,'L');
		$pdf->Cell(10,5,'1.1.',1,0,'L');
		$pdf->Cell(90,5,'Nama',1,0,'L');
		$pdf->Cell(5,5,':',1,0,'C');
		$pdf->Cell(75,5,$pelanggan->anggota_nama,1,1,'L');
		$pdf->Cell(7,5,'',1,0,'L');
		$pdf->Cell(10,5,'1.2.',1,0,'L');
		$pdf->Cell(90,5,'Alamat',1,0,'L');
		$pdf->Cell(5,5,':',1,0,'C');
		$pdf->Cell(75,5,$pelanggan->anggota_alamat,1,1,'L');
		$pdf->Cell(7,5,'',1,0,'L');
		$pdf->Cell(10,5,'1.3.',1,0,'L');
		$pdf->Cell(90,5,'No.telp/faks',1,0,'L');
		$pdf->Cell(5,5,':',1,0,'C');
		$pdf->Cell(75,5,$pelanggan->anggota_kontak,1,1,'L');
		$pdf->Cell(7,5,'',1,0,'L');
		$pdf->Cell(10,5,'1.4.',1,0,'L');
		$pdf->Cell(90,5,'Personil penghubung',1,0,'L');
		$pdf->Cell(5,5,':',1,0,'C');
		$pdf->Cell(75,5,$pelanggan->anggota_personil,1,1,'L');
	}

	private function batas($pdf){
		
		$pdf->Cell(187,5,'',1,1,'L');
	}

	private function informasi_sampel($pdf,$id,$laporan){
		$sampel=$laporan;
		$tgl_sampel=$sampel->tanggal_sampel==null?'-':date_indo($sampel->tanggal_sampel);
		$tanggal_pengujian_awal=$sampel->tanggal_pengujian_awal==null?'-':date_indo($sampel->tanggal_pengujian_awal);
		$tanggal_pengujian_akhir=$sampel->tanggal_pengujian_akhir==null?'-':date_indo($sampel->tanggal_pengujian_akhir);
		// var_dump($sampel);
		$pdf->SetFont('Times','','12');
		$pdf->Cell(7,5,'2.',1,0,'L');
		$pdf->Cell(180,5,'Informasi Sampel',1,1,'L');
		$pdf->Cell(7,5,'',1,0,'L');
		$pdf->Cell(10,5,'2.1',1,0,'L');
		$pdf->Cell(90,5,'No. Identifikasi',1,0,'L');
		$pdf->Cell(5,5,':',1,0,'C');
		$pdf->Cell(75,5,$sampel->no_identifikasi,1,1,'L');
		$pdf->Cell(7,5,'',1,0,'L');
		$pdf->Cell(10,5,'2.2',1,0,'L');
		$pdf->Cell(90,5,'Uraian',1,0,'L');
		$pdf->Cell(5,5,':',1,0,'C');
		$pdf->Cell(75,5,$sampel->us_kode_sampel,1,1,'L');
		$pdf->Cell(7,5,'',1,0,'L');
		$pdf->Cell(10,5,'2.3',1,0,'L');
		$pdf->Cell(90,5,'Kondisi saat diterima',1,0,'L');
		$pdf->Cell(5,5,':',1,0,'C');
		$pdf->Cell(75,5,$sampel->kondisi,1,1,'L');
		$pdf->Cell(7,5,'',1,0,'L');
		$pdf->Cell(10,5,'2.4',1,0,'L');
		$pdf->Cell(90,5,'Tanggal diterima',1,0,'L');
		$pdf->Cell(5,5,':',1,0,'C');
		$pdf->Cell(75,5,$tgl_sampel,1,1,'L');
		$pdf->Cell(7,5,'',1,0,'L');
		$pdf->Cell(10,5,'2.5',1,0,'L');
		$pdf->Cell(90,5,'Tanggal pengujian',1,0,'L');
		$pdf->Cell(5,5,':',1,0,'C');
		$pdf->Cell(75,5,$tanggal_pengujian_awal.' - '.$tanggal_pengujian_akhir,1,1,'L');
	}

	private function informasi_pengambilan($pdf,$id,$laporan){
		$pengambilan=$laporan;
		$length= ceil(strlen($pengambilan->acuan_metode_nama)/34);
		$rh=5*$length;
		// var_dump($pengambilan);
		$tgl_sampel=$pengambilan->tanggal_sampel==null?'-':date_indo($pengambilan->tanggal_sampel);
		$pdf->SetFont('Times','','12');
		$pdf->Cell(7,5,'3.',1,0,'L');
		$pdf->Cell(180,5,'Informasi Pengambilan Sampel (Apabila pengambilan sampel bagian dari pengujian)',1,1,'L');
		$pdf->Cell(7,5,'',1,0,'L');
		$pdf->Cell(10,5,'1.',1,0,'L');
		$pdf->Cell(90,5,'Tanggal Pengambilan Sampel',1,0,'L');
		$pdf->Cell(5,5,':',1,0,'C');
		$pdf->Cell(75,5,$tgl_sampel,1,1,'L');
		$pdf->Cell(7,5,'',1,0,'L');
		$pdf->Cell(10,5,'2.',1,0,'L');
		$pdf->Cell(90,5,'Lokasi Pengambilan Sampel',1,0,'L');
		$pdf->Cell(5,5,':',1,0,'C');
		$pdf->Cell(75,5,$pengambilan->lokasi,1,1,'L');
		$pdf->Cell(7,$rh,'',1,0,'L');
		$pdf->Cell(10,$rh,'3.',1,0,'L');
		$pdf->Cell(90,$rh,'Acuan Prosedur Pengambilan Sampel',1,0,'L');
		$pdf->Cell(5,$rh,':',1,0,'C');
		$pdf->MultiCell(75,5,$pengambilan->acuan_metode_nama,1,'L');
		$pdf->Cell(7,5,'',1,0,'L');
		$pdf->Cell(10,5,'4.',1,0,'L');
		$pdf->Cell(90,5,'Kondisi Lingkungan Selama Pengambilan Sampel',1,0,'L');
		$pdf->Cell(5,5,':',1,0,'C');
		$pdf->Cell(75,5,$pengambilan->kondisi,1,1,'L');
		$pdf->Cell(7,5,'',1,0,'L');
		$pdf->Cell(10,5,'5.',1,0,'L');
		$pdf->Cell(90,5,'Penyimpangan Prosedur Pengambilan Sampel',1,0,'L');
		$pdf->Cell(5,5,':',1,0,'C');
		$pdf->Cell(75,5,$pengambilan->rincian,1,1,'L');
	}

	private function informasi_interpretasi($pdf,$id,$laporan,$nomor){
		$interpretasi=$laporan;
		// var_dump($pengambilan);
		$tgl_sampel=$interpretasi->tanggal_sampel==null?'-':date_indo($interpretasi->tanggal_sampel);
		$pdf->Cell(7,5,$nomor.'.',1,0,'L');
		$pdf->Cell(180,5,'Informasi Intreptasi Hasil Pengujian (Apabila diperlukan opini dan interpretasi terhadap hasil pengujian)',1,1,'L');
		$pdf->Cell(7,5,'',1,0,'L');
		$pdf->Cell(10,5,'1.',1,0,'L');
		$pdf->Cell(90,5,' Penyimpagan Prosedur Pengujian',1,0,'L');
		$pdf->Cell(5,5,':',1,0,'C');
		$pdf->Cell(75,5,$interpretasi->ih_penyimpangan,1,1,'L');
		$pdf->Cell(7,5,'',1,0,'L');
		$pdf->Cell(10,5,'2.',1,0,'L');
		$pdf->Cell(90,5,' Persyaratan Pelanggan',1,0,'L');
		$pdf->Cell(5,5,':',1,0,'C');
		$pdf->Cell(75,5,$interpretasi->ih_persyaratan,1,1,'L');
	}

	private function informasi_hasil($pdf,$id,$nomor){
		$sifat=$this->m_sp->get_all()->result();
		$hasil=$this->m_parameter_us->get_by_kode($id)->result();
		$a='A';
		$x=1;
		// var_dump($hasil);
		$pdf->Cell(7,5,$nomor.'.',1,0,'L');
		$pdf->Cell(180,5,'Informasi Hasil Pengujian',1,1,'L');
		$pdf->SetFont('Times','B','12');
		$pdf->Cell(7,7,'',1,0,'L');
		$pdf->Cell(11,7,'NO.',1,0,'C');
		$pdf->Cell(64,7,'PARAMETER',1,0,'C');
		$pdf->Cell(20,7,'SATUAN',1,0,'C');
		$pdf->Cell(15,7,'HASIL',1,0,'C');
		$pdf->Cell(30,7,'BAKU MUTU*',1,0,'C');
		$pdf->Cell(40,7,'ACUAN METODE',1,1,'C');
		$pdf->SetFont('Times','','12');
		foreach ($sifat as $key => $value) {
			$parameter=$this->m_parameter_us->get_by_pu($value->sp_id)->result();
			// echo $this->db->last_query();
			foreach ($parameter as $key => $value2) {
				$length= ceil(strlen($value2->acuan_metode_nama)/16);
				$length2= ceil(strlen($value2->pu_nama)/34);
				if ($length>0){
					$rh=5*$length;
					$rh2=5*$length;
					$rh3=5;
				}else {
					if ($length2>0){
						$rh=5*$length2;
						$rh3=5*$length2;
						$rh2=5;
					}else{
						$rh=5;
					}
				}
				// echo $rh2.'/';
				$pdf->Cell(7,$rh,'',1,0,'L');
				$pdf->Cell(11,$rh,$x++.'.','1',0,'C');
				$pdf->MultiCell(64,$rh2,$value2->pu_nama,1,'L');
				$pdf->SetXY($pdf->GetX()+82,$pdf->GetY()-$rh);
				$pdf->Cell(20,$rh,$value2->satuan_nama,'1',0,'C');
				$pdf->Cell(15,$rh,$value2->parameter_us_hasil,'1',0,'C');
				$pdf->Cell(30,$rh,$value2->pu_mutu,'1',0,'C');
				$pdf->MultiCell(40,$rh3,$value2->acuan_metode_nama,1,'L');
			}
		}
	}

	private function catatan($pdf){
		$pdf->SetFont('Times','','10');
		$pdf->Cell(0,2,'',0,1,'L');
		$pdf->Cell(7,5,'',0,0,'L');
		$pdf->Cell(7,5,'Catatan: 1. Lembar Hasil Pengujian tidak boleh digandakan kecuali seluruhnya, tanpa persetujuan',0,1,'L');
		$pdf->Cell(23,5,'',0,0,'L');
		$pdf->Cell(7,5,'tertulis dari laboratorium',0,1,'L');
		$pdf->Cell(23,5,'',0,0,'L');
		$pdf->SetFont('Times','I','10');
		$pdf->Cell(7,5,'*Peraturan Menteri LH RI No. 68 Thn 2016 ttg baku mutu air limbah domestik',0,1,'L');
	}

	private function footer($pdf,$ttd){
		$date = date('Y-m-d', time());
		$pdf->SetFont('Times','','12');
		$pdf->Cell(1);
		// echo $pdf->GetY();
		if ($pdf->GetY()<230){
			$pdf->Cell(0,20,'',0,1,'R');
		}elseif ($pdf->GetY()<245){
			$pdf->Cell(0,5,'',0,1,'R');
		}else{
			$pdf->AddPage();
		}
		$pdf->Cell(100);
		$pdf->Cell(0,5,'Palangka Raya, '.date_indo($date),0,1,'C');
		$pdf->Cell(0,10,'',0,1,'L');
		$pdf->Cell(93.5,5,'Mengetahui,',0,0,'C');
		$pdf->Cell(93.5,5,'',0,1,'C');
		$pdf->Cell(93.5,5,'Kepala UPTD. Laboratorium Lingkungan,',0,0,'C');
		$pdf->Cell(93.5,5,'Manager Teknis',0,1,'C');
		$pdf->Cell(93.5,5,'Dinas Lingkungan Hidup Kota Palangka Raya,',0,0,'C');
		$pdf->Cell(93.5,20,'',0,0,'C');
		$pdf->Cell(93.5,20,',',0,1,'C');
		$pdf->SetFont('Times','B','12');
		$pdf->Cell(93.5,5,$ttd[0]->st_nama,0,0,'C');
		$pdf->Cell(93.5,5,$ttd[1]->st_nama,0,1,'C');
		$pdf->SetFont('Times','','12');
		$pdf->Cell(93.5,5,$ttd[0]->golongan_nama,0,0,'C');
		$pdf->Cell(93.5,5,$ttd[1]->golongan_nama,0,1,'C');
		$pdf->SetFont('Times','B','12');
		$pdf->Cell(93.5,5,'NIP. '.$ttd[0]->st_nip,0,0,'C');
		$pdf->Cell(93.5,5,'NIP. '.$ttd[1]->st_nip,0,1,'C');
	}

	function numberToRomanRepresentation($number) {
		$map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
		$returnValue = '';
		while ($number > 0) {
			foreach ($map as $roman => $int) {
				if($number >= $int) {
					$number -= $int;
					$returnValue .= $roman;
					break;
				}
			}
		}
		return $returnValue;
	}
}