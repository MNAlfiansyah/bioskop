<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class waiter extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id_level') !== '2') {
			redirect('login');
		}
		$this->load->model('bioskop');
	}

	public function index()
	{
		if($this->bioskop->logged_id())	
		{
			$data['user']=$this->bioskop->user()->num_rows();
			$data['masakan']=$this->bioskop->masakan()->num_rows();
			$data['transaksi']=$this->bioskop->waiter()->num_rows();

			$this->load->view('heater/header');
			$this->load->view('waiter/dashboard',$data);
			$this->load->view('heater/footer');
		}else{

			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");

		}

	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

	public function alldata(){	
		$id_order = $this->input->post('kode');
		$data = $this->bioskop->detail($id_order)->result();
		echo json_encode($data);
	}

	public function s_pesanan()
	{
		$id_transaksi =$this->input->post('id_transaksi');
		$tanggal =$this->input->post('tanggal');
		$id_order =$this->input->post('id_order');
		$no_meja =$this->input->post('no_meja');
		$total_bayar =$this->input->post('total_bayar');

		if (isset($_POST['submit'])) {
			$this->bioskop->waiter1($id_transaksi, $tanggal, $id_order, $no_meja, $total_bayar);
			$this->bioskop->waiter2($id_transaksi, $tanggal, $id_order, $no_meja, $total_bayar);
			$this->load->view('heater/header');
			redirect('waiter/pesanan');
			$this->load->view('heater/footer');
		}else {
			echo "Ada Kesalahan saat mengambil data !!!";
		}
	}


	public function pesanan()
	{
		if($this->bioskop->logged_id())	
		{
			$data['pes'] = $this->bioskop->waiter();
			$this->load->view('heater/header');
			$this->load->view('waiter/pesanan',$data);
			$this->load->view('heater/footer');
		}else{

			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");

		}
	}	

	public function view_data()
	{
		if (isset($_POST['cari'])) {
			$data['pesan']	 = $this->bioskop->view_data($this->input->post('id_order'));
			$this->load->view('heater/header');
			$this->load->view('waiter/data', $data);
			$this->load->view('heater/footer');
		}else {
			echo "Ada Kesalahan saat mengambil data !!!";
		}
	}
}