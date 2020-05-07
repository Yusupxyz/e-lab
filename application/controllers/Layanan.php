<?php
class Layanan extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('m_layanan');
	}
	function index(){
		$jum=$this->m_layanan->get_layanan();
        $page=$this->uri->segment(3);
        if(!$page):
            $offset = 0;
        else:
            $offset = $page;
        endif;
        $limit=6;
        $config['base_url'] = base_url() . 'layanan/index/';
        $config['total_rows'] = $jum->num_rows();
        $config['per_page'] = $limit;
        $config['uri_segment'] = 3;
        $config['first_link'] = 'Awal';
        $config['last_link'] = 'Akhir';
        $config['next_link'] = 'Next >>';
        $config['prev_link'] = '<< Prev';
        $this->pagination->initialize($config);
        $x['page'] =$this->pagination->create_links();
        $x['data']=$this->m_layanan->get_layanan_per_page($offset,$limit);
		$x['menu']="layanan";
		$this->load->view('v_layanan',$x);
    }
    
    function detail($id){
		$x['menu']="layanan";
		$x['data']=$this->m_layanan->get_layanan_by_id($id);
		$this->load->view('v_layanan_detail',$x);
    }

}