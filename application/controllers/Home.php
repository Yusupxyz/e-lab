<?php 
class Home extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('m_slider');
		$this->load->model('m_pengunjung');
        $this->m_pengunjung->count_visitor();
	}
	function index(){
		$x['slider']=$this->m_slider->get_all_slider();
		// $x['post']=$this->m_tulisan->get_post_home();
		$x['menu']="home";
		$this->load->view('v_home',$x);
	}
}