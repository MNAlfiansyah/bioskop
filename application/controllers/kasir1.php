<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir1 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id_level') !== '3') {
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
			$data['transaksi']=$this->bioskop->pesanan()->num_rows();

			$this->load->view('heater/header');
			$this->load->view('bioskop/dashboard',$data);
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

		$id_order = $this->input->post('id_order');
		

		$no_meja = $this->input->post('no_meja');
		$tanggal = $this->input->post('tanggal');
		// $masakan = $this->input->post('nama_masakan');
		// $qty = $this->input->post('qty');
		// $harga = $this->input->post('harga');
		$total_harga = $this->input->post('total_harga');
		$total_bayar = $this->input->post('total_bayar');
		
		

    if($this->input->post('submit')){ // Jika user menekan tombol Submit (Simpan) pada form
    	//print_r($i['nama_masakan']);

      // lakukan upload file dengan memanggil function upload yang ada di bioskop.php
    	$this->bioskop->cetakk($id_order, $total_bayar,$no_meja);

    	$trans = $this->bioskop->trans($no_meja, $id_order, $tanggal, $total_bayar);
    	if($trans == $id_order){
     //     // Panggil function save yang ada di bioskop.php untuk menyimpan data ke database
    		$this->bioskop->edit_a($id_order);
    		$this->bioskop->edit_a1($id_order);


        redirect('kasir1/pesanan'); // Redirect kembali ke halaman awal / halaman view data
      }else{ // Jika proses upload gagal
      	echo "error";
      }
  }
  redirect ('kasir1/pesanan');
  

}


public function pesanan()
{
	if($this->bioskop->logged_id())	
	{
		$data['pes'] = $this->bioskop->pesanan();
		$this->load->view('heater/header');
		$this->load->view('bioskop/pesanan',$data);
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
		$this->load->view('bioskop/data', $data);
		$this->load->view('heater/footer');
	}else {
		echo "Ada Kesalahan saat mengambil data !!!";
	}
}
}