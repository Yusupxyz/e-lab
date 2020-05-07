<?php
class Tentang extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('m_tentang');
	}
	function index(){
        $x['data']=$this->m_tentang->get_tentang();
		$x['menu']="tentang";
		$this->load->view('v_tentang',$x);
    }
    
    function detail($id){
		$x['menu']="tentang";
		$x['data']=$this->m_tentang->get_tentang_by_id($id)->row();
		$this->load->view('v_tentang_detail',$x);
    }

}