<?php
class Administrator extends CI_Controller{
    function __construct(){
        parent:: __construct();
        $this->load->model('m_login');
        $this->load->model('m_anggota');
        $this->load->helper('string');
		$this->load->model('m_setting_email');

    }
    function index($role=""){
        $x['role']=$role;
        if ($role=="anggota"){
            $x['title'] = "Masuk Anggota";
        }else{
            $x['title'] = "Masuk Admin";
        }
        $this->load->view('admin/v_login',$x);
    }

    function registrasi(){
        $submit=$this->input->post('submit');
        if(isset($submit)){
            $nama=$this->input->post('nama');
            $username=$this->input->post('username');
            $password=$this->input->post('password');
            $alamat=$this->input->post('alamat');
            $personil=$this->input->post('personil');
            $jl=$this->input->post('jl');
            $email=$this->input->post('email');
            $kontak=$this->input->post('kontak');
            $simpan=$this->m_anggota->simpan_anggota($nama,$username,$password,$alamat,$personil,$jl,$email,$kontak);
            if (!$simpan){
                echo $this->session->set_flashdata('msg','<center>Registrasi Gagal! Silahkan kontak admin.</center>');
                redirect('administrator/registrasi');
            }else{
                echo $this->session->set_flashdata('msg','<center>Registrasi berhasil, silahkan masuk!</center>');
                redirect('anggota');
            }
        }else{
            $x['role']='anggota';
            $this->load->view('v_regis',$x);
        }
    }

    function auth($role=""){
        // echo $role;
        $username=strip_tags(str_replace("'", "", $this->input->post('username',TRUE)));
        $password=strip_tags(str_replace("'", "", $this->input->post('password',TRUE)));
        if ($role=="anggota"){
            $cadmin=$this->m_login->cekanggota($username,$password);
            if($cadmin->num_rows() > 0){
                $xcadmin=$cadmin->row_array();
                $newdata = array(
                    'idadmin'   => $xcadmin['anggota_id'],
                    'username'  => $xcadmin['anggota_username'],
                    'nama'      => $xcadmin['anggota_nama'],
                    'level'     => $xcadmin['anggota_level'],
                    'password'     => $password,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($newdata);
                redirect('anggota/dashboard'); 
            }else{
                redirect('administrator/gagallogin/anggota'); 
            }
        }else{
            $cadmin=$this->m_login->cekadmin($username,$password);
            if($cadmin->num_rows() > 0){
                $xcadmin=$cadmin->row_array();
                $newdata = array(
                    'idadmin'   => $xcadmin['pengguna_id'],
                    'username'  => $xcadmin['pengguna_username'],
                    'nama'      => $xcadmin['pengguna_nama'],
                    'level'     => $xcadmin['pengguna_level'],
                    'password'     => $password,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($newdata);
                if ($xcadmin['pengguna_level']=='1'){
                    redirect('admin/dashboard'); 
                }else{
                    redirect('operator/dashboard');  
                }
            }else{
                redirect('administrator/gagallogin'); 
            }
        }

    }


    function gagallogin($role=""){
        if ($role=="anggota"){
            $role="anggota";
        }else{
            $role="administrator";
        }
        $url=base_url($role);
        echo $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Username Atau Password Salah</div>');
        redirect($url);
    }

    function logout($role=""){
        if ($role=="anggota"){
            $role="anggota";
        }else{
            $role="administrator";
        }
        $this->session->sess_destroy();
        $url=base_url($role);
        redirect($url);
    }

    function cek_username(){
        $username=$this->input->post('username');
        $count=$this->m_anggota->cek_username($username)->row()->count;
        if ($count=='0'){
            echo '0';
        }else{
            echo '1';
        }
    }

    function reset(){
        $submit=$this->input->post('submit');
        if(isset($submit)){
            $email=$this->input->post('email');
            $reset_key =  random_string('alnum', 50);
            $cek=$this->m_anggota->cek_email($email)->num_rows();
            if ($cek==0){
                echo $this->session->set_flashdata('msg','<center>Email tidak terdaftar! Silahkan daftar.</center>');
                redirect('administrator/registrasi');
            }else{
                $this->m_anggota->update_reset($email,$reset_key);
                $this->kirim_email($email,$reset_key);
            }
        }else{
            $x['role']='anggota';
            $this->load->view('v_reset',$x);
        }
    }

    function kirim_email($to_email,$reset_key){
		$email=$this->m_setting_email->get_all()->result();
		$from_email = $email[0]->setting_data; 
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
	//    var_dump($email);

		   $this->load->library('email', $config);
		   $this->email->set_newline("\r\n");   

		$this->email->from($from_email,$email[4]->setting_data); 
		$this->email->to($to_email);
        $this->email->subject("Ganti Password"); 
        $message = "<p>Anda melakukan permintaan reset password. Klik link dibawah ini jika benar, abaikan email ini jika tidak benar.</p>";
		$message .= "<a href='".site_url('administrator/reset_password/'.$reset_key)."'>link reset password</a>";
        $this->email->message($message); 
		//Send mail 
        if($this->email->send()){
            echo $this->session->set_flashdata('msg','<center>Link reset email telah dikirim, silahkan cek email anda!</center>');
            redirect('anggota');
        }else {
            echo $this->session->set_flashdata('msg','<center>Maaf email gagal terkirim, silahkan coba beberapa saat lagi. Atau silahkan kontak admin.</center>');
            redirect('anggota');
        } 
    }
    
    public function reset_password(){
        $reset_key = $this->uri->segment(3);
        if(!$reset_key){
			die('Jangan Dihapus');
		}
        $cek=$this->m_anggota->check_reset_key($reset_key);
		if($cek->num_rows() > 0)
		{
            $submit=$this->input->post('submit');
			if(isset($submit)){
                $password=strip_tags(str_replace("'", "", $this->input->post('password',TRUE)));
                $update=$this->m_anggota->update_password($cek->row()->anggota_id,$password);
                if (!$update){
                    echo $this->session->set_flashdata('msg','<center>Password Gagal diubah! Silahkan kontak admin.</center>');
                    redirect('administrator/registrasi');
                }else{
                    echo $this->session->set_flashdata('msg','<center>Password berhasil diubah, silahkan masuk!</center>');
                    redirect('anggota');
                }
            }else{
                $x['role']='anggota';
                $x['reset_key']=$reset_key;
                $this->load->view('v_reset_password',$x);
            }
		} else{
			die("reset key salah");
		}
		

	
	}

}