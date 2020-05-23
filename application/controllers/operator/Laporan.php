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
		$pdf->SetFont('Arial','B',16);
		$this->letak(base_url().'assets/images/logo%20plk.png',$pdf);
		//meletakkan judul disamping logo diatas
		$this->judul($pdf,$teks1,$teks2 ,$teks3,$teks4,$teks5);
		//membuat garis ganda tebal dan tipis
		$this->garis($pdf);
		$pdf->Cell(7);
		$pdf->SetFont('Times','BU','12');
		$pdf->Cell(0,8,"",0,1,'C');
		$pdf->Cell(0,5,"LAPORAN HASIL UJI",0,1,'C');
		$pdf->Cell(7);
		$pdf->SetFont('Times','B','12');
		$pdf->Cell(0,5,"Nomor :                                         ",0,1,'C');
		$this->informasi_pelanggan($pdf,$kode);
		$this->informasi_sampel($pdf,$kode,$laporan);
		if ($laporan->us_pengambilan=='Laboratorium'){
			$this->informasi_pengambilan($pdf,$kode,$laporan);
			$nomor=4;
		}
		$this->informasi_hasil($pdf,$kode,$nomor);
		$this->catatan($pdf);
		$this->footer($pdf);
		$name='doc'.$kode.'.pdf';
		$path='C:/xampp/htdocs/e-lab/assets/hasil_pengujian/'.$name;
		$pdf->Output('F',$path);
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
		$pdf->SetFont('Times','B','14');
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
	}

	private function informasi_pelanggan($pdf,$id){
		$pelanggan=$this->m_uji_sampel->get_anggota($id)->row();
		// var_dump($pelanggan);
		$pdf->Cell(1);
		$pdf->Cell(0,5,'',0,1,'L');
		$pdf->Cell(0,5,'1. Informasi Pelanggan',0,1,'L');
		$pdf->Cell(4);
		$pdf->SetFont('Times','','12');
		$pdf->Cell(0,5,'1.1. Nama',0,0,'L');
		$pdf->Cell(-123);
		$pdf->Cell(0,5,': '.$pelanggan->anggota_nama,0,1,'L');
		$pdf->Cell(4);
		$pdf->Cell(0,5,'1.2. Alamat',0,0,'L');
		$pdf->Cell(-123);
		$pdf->Cell(0,5,': '.$pelanggan->anggota_alamat,0,1,'L');
		$pdf->Cell(4);
		$pdf->Cell(0,5,'1.3. No.telp/faks',0,0,'L');
		$pdf->Cell(-123);
		$pdf->Cell(0,5,': '.$pelanggan->anggota_kontak,0,1,'L');
		$pdf->Cell(4);
		$pdf->Cell(0,5,'1.4. Personil penghubung',0,0,'L');
		$pdf->Cell(-123);
		$pdf->Cell(0,5,': '.$pelanggan->anggota_personil,0,1,'L');
	}

	private function informasi_sampel($pdf,$id,$laporan){
		$sampel=$laporan;
		// var_dump($sampel);
		$pdf->Cell(1);
		$pdf->SetFont('Times','B','12');
		$pdf->Cell(0,5,'',0,1,'L');
		$pdf->Cell(0,5,'2. Informasi Sampel',0,1,'L');
		$pdf->Cell(4);
		$pdf->SetFont('Times','','12');
		$pdf->Cell(0,5,'2.1. No. Identifikasi',0,0,'L');
		$pdf->Cell(-123);
		$pdf->Cell(0,5,': '.$sampel->no_identifikasi,0,1,'L');
		$pdf->Cell(4); 
		$pdf->Cell(0,5,'2.2. Uraian',0,0,'L');
		$pdf->Cell(-123);
		$pdf->Cell(0,5,': '.$sampel->us_kode_sampel,0,1,'L');
		$pdf->Cell(4);
		$pdf->Cell(0,5,'2.3. Kondisi saat diterima',0,0,'L');
		$pdf->Cell(-123);
		$pdf->Cell(0,5,': '.$sampel->kondisi,0,1,'L');
		$pdf->Cell(4);
		$pdf->Cell(0,5,'2.4. Tanggal diterima',0,0,'L');
		$pdf->Cell(-123);
		$pdf->Cell(0,5,': '.$sampel->tanggal_sampel,0,1,'L');
		$pdf->Cell(4);
		$pdf->Cell(0,5,'2.5. Tanggal pengujian',0,0,'L');
		$pdf->Cell(-123);
		$pdf->Cell(0,5,': '.$sampel->tanggal_pengujian_awal.' sampai '.$sampel->tanggal_pengujian_akhir,0,1,'L');
	}

	private function informasi_pengambilan($pdf,$id,$laporan){
		$pengambilan=$laporan;
		// var_dump($pengambilan);
		$pdf->Cell(1);
		$pdf->SetFont('Times','B','12');
		$pdf->Cell(0,5,'',0,1,'L');
		$pdf->Cell(0,5,'3. Informasi pengambilan sampel (bila pengambilan sampel bagian dari pengujian)',0,1,'L');
		$pdf->Cell(4);
		$pdf->SetFont('Times','','12');
		$pdf->Cell(0,5,'3.1. Tanggal pengambilan sampel',0,0,'L');
		$pdf->Cell(-85);
		$pdf->Cell(0,5,': '.$pengambilan->tanggal_sampel,0,1,'L');
		$pdf->Cell(4); 
		$pdf->Cell(0,5,'3.2. Lokasi pengambilan sampel',0,0,'L');
		$pdf->Cell(-85);
		$pdf->Cell(0,5,': '.$pengambilan->lokasi,0,1,'L');
		$pdf->Cell(4);
		$pdf->Cell(0,5,'3.3. Titik pengambilan sampel',0,0,'L');
		$pdf->Cell(-85);
		$pdf->Cell(0,5,': '.$pengambilan->titik_pengambilan,0,1,'L');
		$pdf->Cell(4);
		$pdf->Cell(0,5,'3.4. Acuan rencana dan prosedur pengambilan sampel',0,0,'L');
		$pdf->Cell(-85);
		$pdf->Cell(0,5,': '.$pengambilan->acuan_metode_nama,0,1,'L');
		$pdf->Cell(4);
		$pdf->Cell(0,5,'3.5. Rincian dari kondisi lingkungan selama pengambilan',0,1,'L');
		$pdf->Cell(12);
		$pdf->Cell(0,5,'sampel yang dapat mempengaruhi hasil pengujian',0,0,'L');
		$pdf->Cell(-85);
		$pdf->Cell(0,5,': '.$pengambilan->rincian,0,1,'L');
	}

	private function informasi_hasil($pdf,$id,$nomor){
		$sifat=$this->m_sp->get_all()->result();
		$hasil=$this->m_parameter_us->get_by_kode($id)->result();
		$a='A';
		$x=1;
		// var_dump($hasil);
		$pdf->SetLineWidth(0);
		$pdf->Cell(1);
		$pdf->SetFont('Times','B','12');
		$pdf->Cell(0,5,'',0,1,'L');
		$pdf->Cell(0,7,$nomor.'. Informasi Hasil Pengujian',0,1,'L');
		$pdf->Cell(5.5);
		$pdf->SetFont('Times','','12');
		$pdf->Cell(11,6,'NO.',1,0,'C');
		$pdf->Cell(70,6,'PARAMETER',1,0,'C');
		$pdf->Cell(20,6,'SATUAN',1,0,'C');
		$pdf->Cell(15,6,'HASIL',1,0,'C');
		$pdf->Cell(30,6,'BAKU MUTU*',1,0,'C');
		$pdf->Cell(40,6,'ACUAN METODE',1,1,'C');
		$pdf->Cell(5.5);
		$pdf->Cell(11,5,'','LR',0,'L');
		$pdf->Cell(70,5,'','LR',0,'l');
		$pdf->Cell(20,5,'','LR',0,'C');
		$pdf->Cell(15,5,'','LR',0,'C');
		$pdf->Cell(30,5,'','LR',0,'C');
		$pdf->Cell(40,5,'','LR',1,'C');
		foreach ($sifat as $key => $value) {
			$pdf->Cell(5.5);
			$pdf->Cell(11,6,'','LR',0,'L');
			$pdf->SetFont('Times','B','12');
			$pdf->Cell(70,6,$a++.'. '.$value->sp_jenis,'LR',0,'l');
			$pdf->SetFont('Times','','12');
			$pdf->Cell(20,6,'','LR',0,'C');
			$pdf->Cell(15,6,'','LR',0,'C');
			$pdf->Cell(30,6,'','LR',0,'C');
			$pdf->Cell(40,6,'','LR',1,'C');
			$parameter=$this->m_parameter_us->get_by_pu($value->sp_id)->result();
			// echo $this->db->last_query();
			foreach ($parameter as $key => $value2) {
				$pdf->Cell(5.5);
				$pdf->Cell(11,6,$x++.'.','LR',0,'C');
				$pdf->Cell(70,6,'     '.$value2->pu_nama,'LR',0,'L');
				$pdf->Cell(20,6,$value2->satuan_nama,'LR',0,'C');
				$pdf->Cell(15,6,$value2->parameter_us_hasil,'LR',0,'C');
				$pdf->Cell(30,6,$value2->pu_mutu,'LR',0,'C');
				$pdf->Cell(40,6,$value2->acuan_metode_nama,'LR',1,'C');
			}
		}
		$pdf->Cell(5.5);
		$pdf->Cell(11,3,'','BLR',0,'L');
		$pdf->Cell(70,3,'','BLR',0,'l');
		$pdf->Cell(20,3,'','BLR',0,'C');
		$pdf->Cell(15,3,'','BLR',0,'C');
		$pdf->Cell(30,3,'','BLR',0,'C');
		$pdf->Cell(40,3,'','BLR',1,'C');
	}

	private function catatan($pdf){
		$pdf->SetFont('Times','B','12');
		$pdf->Cell(1);
		$pdf->Cell(0,2,'',0,1,'L');
		$pdf->Cell(0,7,'Catatan:',0,1,'L');
		$pdf->SetFont('Times','','12');
		$pdf->Cell(3);
		$pdf->Cell(0,5,'1. Hasil yang ditampilkan hanya berhubungan dengan sampel yang diuji;',0,1,'L');
		$pdf->Cell(3);
		$pdf->Cell(0,5,'2. Laporan hasil pengujian tidak boleh digandakan kecuali seluruhnya tanpa persetujuan tertulis dari laboratorium.',0,1,'L');
		$pdf->SetFont('Times','I','12');
		$pdf->Cell(6);
		$pdf->Cell(0,5,'*Peraturan Menteri LH RI No. 68 Thn 2016 ttg Baku Mutu Air Limbah Domestik',0,1,'L');
	}

	private function footer($pdf){
		$date = date('d-m-Y', time());
		$pdf->SetFont('Times','','12');
		$pdf->Cell(1);
		$pdf->Cell(0,20,'',0,1,'R');
		$pdf->Cell(100);
		$pdf->Cell(0,5,'Palangka Raya, '.$date,0,1,'C');
		$pdf->Cell(100);
		$pdf->Cell(0,5,'Kepala UPTD. Laboratorium Lingkungan',0,1,'C');
		$pdf->Cell(100);
		$pdf->Cell(0,5,'Dinas Lingkungan Hidup Kota Palangka Raya',0,1,'C');
		$pdf->Cell(100);
		$pdf->Cell(0,14,'',0,1,'R');
		$pdf->Cell(100);
		$pdf->SetFont('Times','B','12');
		$pdf->Cell(0,5,'BOWO BUDIARSO, ST',0,1,'C');
		$pdf->Cell(100);
		$pdf->SetFont('Times','','12');
		$pdf->Cell(0,5,'Penata Tk I',0,1,'C');
		$pdf->Cell(100);
		$pdf->SetFont('Times','B','12');
		$pdf->Cell(0,5,'NIP. 19830311 200802 1 002',0,1,'C');
	}
}