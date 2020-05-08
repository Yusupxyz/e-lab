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
		$this->load->model('m_pu');
		$this->load->model('m_uji_sampel');
		$this->load->model('m_setting');
		$this->load->model('m_parameter_us');
		$this->load->library('upload');
	}


	function index(){
		$anggota=$this->session->userdata('idadmin');
		$x['data']=$this->m_uji_sampel->get_byanggota($anggota);
		$x['pratitle'] = 'Uji Sampel';
		$x['title']="Status Uji Sampel";
		foreach ($x['data']->result_array() as $a) {
			$x['detail'][]=$this->m_parameter_us->get_by_fk($a['us_id'])->result_array();
		}
		// var_dump($x['detail']);
		$this->load->view('anggota/uji_sampel/v_status',$x);
	}

	function transaksi(){
		$anggota=$this->session->userdata('idadmin');
		$x['data']=$this->m_uji_sampel->get_byanggota($anggota);
		$x['pratitle'] = 'Uji Sampel';
		$x['title']="Transaksi Uji Sampel";
		foreach ($x['data']->result_array() as $a) {
			$x['detail'][]=$this->m_parameter_us->get_by_fk($a['us_id'])->result_array();
		}
		// var_dump($x['detail']);
		$this->load->view('anggota/uji_sampel/v_transaksi',$x);
	}

	function stepper(){
		$x['data']=$this->m_anggota->get_all_anggota()->row();
		$x['pratitle'] = 'Uji Sampel';
		$x['title'] = 'Pendaftaran Uji Sampel';
		$x['sifat_pengujian']=$this->m_sp->get_all()->result();
		foreach ($x['sifat_pengujian'] as $key => $value) {
			$parameter[$value->sp_id]=$this->m_pu->get_by_fk($value->sp_id)->result();
		}
		// var_dump($parameter);
		$x['parameter']=$parameter;
		$x['jenis_sampel']=$this->m_js->dd();
		$x['jenis_wadah']=$this->m_jw->dd();
		$x['xjenis_sampel']='';
		$x['xjenis_wadah']='';
		$x['attribute'] = 'class="form-control" id="xjenis_sampel" required';
		$x['attribute2'] = 'class="form-control" id="xjenis_wadah" required';
		$x['attribute3'] = 'class="form-control" id="xjenis_sampeledit" required';
		$x['attribute4'] = 'class="form-control" id="xjenis_wadahedit" required';
		$this->load->view('anggota/uji_sampel/stepper',$x);
	}

	function pendaftaran(){
		$x['pratitle'] = 'Uji Sampel';
		$x['title'] = 'Pendaftaran Uji Sampel';
		$x['url'] = 'stepper';
		$this->load->view('anggota/uji_sampel/pendaftaran',$x);
	}

	function simpan(){
		$config['upload_path'] = './assets/surat_permohonan/'; //path folder
		$config['allowed_types'] = 'pdf'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
		$this->upload->initialize($config);
		if(!empty($_FILES['xfile']['name']))
		{
			if ($this->upload->do_upload('xfile'))
			{
				$pdf = $this->upload->data();
				$pdf=$pdf['file_name'];
				$sifat_pengujian=$this->m_sp->get_all()->result();
				$anggota=$this->session->userdata('idadmin');
				$id=uniqid();
				$pengambilan=$this->input->post('pengambilan');
				$kode=$this->input->post('xkode');
				$jenis_sampel=$this->input->post('xjenis_sampel');
				$jenis_wadah=$this->input->post('xjenis_wadah');
				$catatan=$this->input->post('xcatatan');
				$tarif=0;
				foreach ($sifat_pengujian as $key => $value) { 
					if ($this->input->post('xparam'.$value->sp_id)){
						foreach ($this->input->post('xparam'.$value->sp_id) as $key => $value) {
							$tarif=$this->m_pu->get_by_kode($value)->row()->pu_tarif+$tarif;
							$this->m_parameter_us->simpan($id,$value,'0');
						}
					}
				}
				$persentase=$this->m_setting->get_by_kode('1')->row()->setting_data;
				$uang_muka=$tarif*($persentase/100);
				$sisa=$tarif-$uang_muka;
				if ($this->m_uji_sampel->simpan($anggota,$id,$kode,$pengambilan,$jenis_sampel,$jenis_wadah,$tarif,$catatan,$uang_muka,$sisa,$pdf)){
					echo $this->session->set_flashdata('msg','success');
					echo "<script>window.top.location.href = '".base_url()."anggota/uji_sampel';</script>";
				}else{
					echo $this->session->set_flashdata('msg','warning');
					echo "<script>window.top.location.href = '".base_url()."anggota/uji_sampel/pendaftaran';</script>";
				}
			}else{
				echo $this->session->set_flashdata('msg','warning');
				echo "<script>window.top.location.href = '".base_url()."anggota/uji_sampel/pendaftaran';</script>";
			}
		}else{
			echo $this->session->set_flashdata('msg','warning');
			echo "<script>window.top.location.href = '".base_url()."anggota/uji_sampel/pendaftaran';</script>";
		}	

	}

	function get_edit(){
		$kode=$this->uri->segment(4);
		$x['pratitle'] = 'Uji Sampel';
		$x['title'] = 'Pendaftaran Uji Sampel';
		$x['url'] = 'stepper_edit/'.$kode;
		$x['pratitle'] = 'Uji Sampel';
		$x['title'] = 'Pendaftaran Uji Sampel';
		$this->load->view('anggota/uji_sampel/pendaftaran',$x);
	}

	function stepper_edit(){
		$x['kode']=$this->uri->segment(4);
		$data=$this->m_uji_sampel->get_by_kode($this->uri->segment(4))->row();
		$x['pratitle'] = 'Uji Sampel';
		$x['title'] = 'Pendaftaran Uji Sampel';
		$x['sifat_pengujian']=$this->m_sp->get_all()->result();
		$parameter_uji_sampel=$this->m_parameter_us->get_by_kode($this->uri->segment(4))->result();
		foreach ($parameter_uji_sampel as $key => $value) {
			$parameter_us[]=$value->parameter_us_uji_id;
		}
		foreach ($x['sifat_pengujian'] as $key => $value) {
			$parameter[$value->sp_id]=$this->m_pu->get_by_fk($value->sp_id)->result();
		}
		$x['us_id']=$data->us_id;
		$x['pengambilan']=$data->us_pengambilan;
		$x['file']=$data->us_file;
		$x['kode_sampel']=$data->us_kode_sampel;
		$x['xjenis_sampel']=$data->us_fk_js;
		$x['xjenis_wadah']=$data->us_fk_jw;
		// var_dump($parameter_us);
		$x['parameter_us']=$parameter_us;
		$x['parameter']=$parameter;
		$x['jenis_sampel']=$this->m_js->dd();
		$x['jenis_wadah']=$this->m_jw->dd();
		$x['attribute'] = 'class="form-control" id="xjenis_sampel" required';
		$x['attribute2'] = 'class="form-control" id="xjenis_wadah" required';
		$x['attribute3'] = 'class="form-control" id="xjenis_sampeledit" required';
		$x['attribute4'] = 'class="form-control" id="xjenis_wadahedit" required';
		$this->load->view('anggota/uji_sampel/stepper_edit',$x);
	}


	function update(){
		$config['upload_path'] = './assets/surat_permohonan/'; //path folder
		$config['allowed_types'] = 'pdf'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
		$this->upload->initialize($config);
		if(!empty($_FILES['xfile']['name']))
		{
			if ($this->upload->do_upload('xfile'))
			{
				$pdf = $this->upload->data();
				$pdf=$pdf['file_name'];
				$id=$this->input->post('xid');
				$pengambilan=$this->input->post('pengambilan');
				$kode=$this->input->post('xkode');
				$jenis_sampel=$this->input->post('xjenis_sampel');
				$jenis_wadah=$this->input->post('xjenis_wadah');
				$catatan=$this->input->post('xcatatan');
				$oldpdf=$this->input->post('xpdf');
				unlink('assets/surat_permohonan/'.$oldpdf);
				if ($this->m_uji_sampel->update($id,$kode,$pengambilan,$jenis_sampel,$jenis_wadah,$catatan,$pdf)){
					echo $this->session->set_flashdata('msg','success');
					echo "<script>window.top.location.href = '".base_url()."anggota/uji_sampel';</script>";
				}else{
					echo $this->session->set_flashdata('msg','warning');
					echo "<script>window.top.location.href = '".base_url()."anggota/uji_sampel/pendaftaran';</script>";
				}
			}else{
				echo $this->session->set_flashdata('msg','warning');
				echo "<script>window.top.location.href = '".base_url()."anggota/uji_sampel/pendaftaran';</script>";
			}
		}else{
			$id=$this->input->post('xid');
			$pengambilan=$this->input->post('pengambilan');
			$kode=$this->input->post('xkode');
			$jenis_sampel=$this->input->post('xjenis_sampel');
			$jenis_wadah=$this->input->post('xjenis_wadah');
			$catatan=$this->input->post('xcatatan');
			if ($this->m_uji_sampel->update_nopdf($id,$kode,$pengambilan,$jenis_sampel,$jenis_wadah,$catatan)){
				echo $this->session->set_flashdata('msg','success');
				echo "<script>window.top.location.href = '".base_url()."anggota/uji_sampel';</script>";
			}else{
				echo $this->session->set_flashdata('msg','warning');
				echo "<script>window.top.location.href = '".base_url()."anggota/uji_sampel/pendaftaran';</script>";
			}
		}		
	}

	function batal(){
		$kode=$this->uri->segment(4);
		if ($this->m_uji_sampel->batal($kode)){
			echo $this->session->set_flashdata('msg','success');
			echo "<script>window.top.location.href = '".base_url()."anggota/uji_sampel';</script>";
		}else{
			echo $this->session->set_flashdata('msg','warning');
			echo "<script>window.top.location.href = '".base_url()."anggota/uji_sampel';</script>";
		}	
	}


}