<?php
class Inbox extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_kontak');
		$this->load->model('m_setting_email');
	}

	function index(){
		$this->m_kontak->update_status_kontak();
		$x['data']=$this->m_kontak->get_all_inbox();
		foreach ($x['data']->result_array() as $i) {
			$dibalas[]=$this->m_kontak->get_outbox_by_id($i['inbox_id'])->row()->count;
		}
		$x['dibalas']=$dibalas;
		$x['title'] = "Inbox";
		$this->load->view('admin/inbox/v_inbox',$x);
	}

	function hapus_inbox(){
		$kode=$this->input->post('kode');
		$this->m_kontak->hapus_kontak($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/inbox');
	}

	function outbox(){
		$x['data']=$this->m_kontak->get_all_outbox();
		$x['title'] = "Outbox";
		$this->load->view('admin/inbox/v_outbox',$x);
	}

	function kirim_email(){
		$email=$this->m_setting_email->get_all()->result();
		$from_email = $email[0]->setting_data; 
		$nama_pengirim = $email[4]->setting_data;
		$kode = $this->input->post('kode'); 
		$to_email = $this->input->post('to_email'); 
		$subject = $this->input->post('xsubject'); 
		$pesan = $this->input->post('xpesan'); 
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
		$this->email->subject($subject); 
		$this->email->message($pesan); 

		//Send mail 
		if($this->email->send()){
			$this->m_kontak->simpan_outbox($kode,$subject,$pesan);
			echo $this->session->set_flashdata('msg','success-balas');
			echo "<script>window.top.location.href = '".base_url()."admin/inbox';</script>";
		}else {
			echo $this->email->print_debugger();
			echo $this->session->set_flashdata('msg','error');
			echo "<script>window.top.location.href = '".base_url()."admin/inbox';</script>";
		} 
	}

	function hapus_outbox(){
		$kode=$this->input->post('kode');
		$this->m_kontak->hapus_outbox($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/inbox/outbox');
	}
}