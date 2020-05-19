<?php
class Administrator extends CI_Controller{
    function __construct(){
        parent:: __construct();
        $this->load->model('m_login');
        $this->load->model('m_anggota');
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
        echo $role;
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
}