<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antrian_sc extends CI_Controller {

	public function index()
	{

		$tanggal = date('Y-m-d');
		$data['nomor'] = $this->get_last($tanggal);
		$this->load->view('view_antrian',$data);
	}

	public function antrian_baru()
	{
		$this->load->view('welcome_message');
	}


	public function print_antrian()
	{
		$tanggal_sekarang = date('Y-m-d');
		$nomor = $this->generate_antrian($tanggal_sekarang);
		echo $nomor;
	}	

	public function generate_antrian($tanggal){

		$query = $this->db->query("SELECT max(nomor) as nomor FROM antrian WHERE tanggal = '$tanggal' AND comp_id=2;");
		if ($query->num_rows() > 0) {

			$nomor_lama = $query->row()->nomor;
			$nomor_baru = $nomor_lama+1;
			$nomor 		= $nomor_baru;

		$data = array('tanggal' => $tanggal, 'nomor' => $nomor_baru, 'status' => 'waiting', 'comp_id'=>'2');	
		$this->db->insert('antrian',$data);	

		}else{

		$nomor = 1;
		$data = array('tanggal' => $tanggal, 'nomor' => $nomor, 'status' => 'waiting', 'comp_id'=>'2');	
		$this->db->insert('antrian',$data);	

		}

		return $nomor;

	}

	public function get_last($tanggal){

		$query = $this->db->query("SELECT max(nomor) as nomor FROM antrian WHERE tanggal = '$tanggal' AND comp_id = 2;");	
		return $query->row()->nomor;	
	}
}
