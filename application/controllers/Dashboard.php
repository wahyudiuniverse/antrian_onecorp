<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$session_login 	= $this->session->userdata('isLogin');
		$session_nama  	= $this->session->userdata('nama');
		$session_pt		= $this->session->userdata('company');
		if ($session_login != 'yes') {
			redirect(site_url('login'));
		}
	}

	public function index()
	{
		$user_id  		= $this->session->userdata('user_id');
		$session_pt		= $this->session->userdata('company');
		$loket_temp		= $this->session->userdata('loket_temp');
		$tanggal = date('Y-m-d');

		$data['loket_temp'] = $loket_temp;
		$data['data_waiting'] = $this->get_waiting($tanggal, $session_pt);
		$data['data_servicing'] = $this->get_servicing($tanggal,$user_id);
		$this->load->view('view_dashboard',$data);
	}

	public function panggil_antrian(){

	$user_id  			= $this->session->userdata('user_id');
	$session_pt			= $this->session->userdata('company');
	$tanggal_sekarang 	= date('Y-m-d');
	$get_min_waiting 	= $this->db->query("SELECT min(nomor) as nomor FROM antrian where status = 'waiting' AND tanggal = '$tanggal_sekarang' AND comp_id='$session_pt';")->row();
	$min_nomor = $get_min_waiting->nomor;

	if (empty($min_nomor)) {
		echo '0';
	}else{
	$update_status = $this->db->query("UPDATE antrian SET user_id = '$user_id', status = 'servicing' WHERE nomor = '$min_nomor' AND comp_id='$session_pt';");
	$data_waiting = $this->get_waiting($tanggal_sekarang, $session_pt);
	$data_servicing = $this->get_servicing($tanggal_sekarang,$user_id);



	echo json_encode(array('data_waiting' => $data_waiting, 'data_servicing' => $data_servicing));		
	}

	}

	public function get_waiting($tanggal, $pt){

		$query = $this->db->query("SELECT min(nomor) as nomor,status, COUNT(*) AS total_waiting FROM antrian WHERE tanggal = '$tanggal' AND status = 'waiting' AND comp_id='$pt';");	
		return $query->row();	
	}

	public function get_servicing($tanggal,$user_id){

		$query = $this->db->query('SELECT max(nomor) as nomor,status, COUNT(*) AS total_services FROM antrian WHERE tanggal = "'.$tanggal.'" AND status = "servicing" AND user_id = '.$user_id);	
		return $query->row();	
	}

}
