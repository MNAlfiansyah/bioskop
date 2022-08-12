<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Owner extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id_level') !== '4') {
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
			$data['transaksi']=$this->bioskop->orderan()->num_rows();
			$data['cek']=$this->bioskop->user();
			$this->load->view('heater/header');
			$this->load->view('owner/manage',$data);
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

	public function manage()
	{
		if($this->bioskop->logged_id())	
		{
			$data['cek']=$this->bioskop->user();
			$this->load->view('heater/header');
			$this->load->view('owner/manage',$data);
			$this->load->view('heater/footer');
		}else{

			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");

		}
	}

	public function buku()
	{
		if($this->bioskop->logged_id())	
		{
			$data['mas']=$this->bioskop->masakan();
			$this->load->view('heater/header');
			$this->load->view('owner/buku',$data);
			$this->load->view('heater/footer');
		}else{

			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");

		}
	}

	public function pesanan()
	{
		if($this->bioskop->logged_id())	
		{
			$data['mas'] = $this->bioskop->order();
			$this->load->view('heater/header');
			$this->load->view('owner/pesanan',$data);
			$this->load->view('heater/footer');
		}else{

			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");

		}

	}

	public function laporan()
	{
		if($this->bioskop->logged_id())	
		{
			$data['lap'] = $this->bioskop->laporan();
			$this->load->view('heater/header');
			$this->load->view('owner/laporan',$data);
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
			$this->load->view('owner/data', $data);
			$this->load->view('heater/footer');
		}else {
			echo "Ada Kesalahan saat mengambil data !!!";
		}
	}

	public function view_lapor()
	{
		if (isset($_POST['cari'])) {
			$data['lapor']	 = $this->bioskop->view_lapor($this->input->post('tanggal'),$this->input->post('tanggal1'));
			$this->load->view('heater/header');
			$this->load->view('owner/data1', $data);
			$this->load->view('heater/footer');
		}else {
			echo "Ada Kesalahan saat mengambil data !!!";
		}
	}

	// public function cetak()
	// {
	// 	$id_transaksi =$this->input->post('id_transaksi');
	// 	$tanggal =$this->input->post('tanggal');
	// 	$id_order =$this->input->post('id_order');
	// 	$no_meja =$this->input->post('no_meja');
	// 	$total_bayar =$this->input->post('total_bayar');
	// 	$tanggal1 = $this->input->post('tanggal1');
	// 	if (isset($_POST['submit'])) {
	// 		$this->bioskop->laporanpenjualan($id_transaksi, $tanggal, $id_order, $no_meja, $total_bayar, $tanggal1);
	// 		$this->load->view('heater/header');
	// 		$this->load->view('owner/data1');
	// 		$this->load->view('heater/footer');
	// 	}else {
	// 		echo "Ada Kesalahan saat mengambil data !!!";
	// 	}
	// }

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


        redirect('owner/pesanan'); // Redirect kembali ke halaman awal / halaman view data
      }else{ // Jika proses upload gagal
      	echo "error";
      }
  }
  redirect ('owner/pesanan');
}


public function alldata(){	
	$id_order = $this->input->post('kode');
	$data = $this->bioskop->detail($id_order)->result();
	echo json_encode($data);
}

public function transaksi()
{
	$data['tran']=$this->bioskop->transaksi();
	$this->load->view('heater/header');
	$this->load->view('owner/transaksi',$data);
	$this->load->view('heater/footer');
}

public function hakplus(){
	$nama_user = $this->input->post('nama_user');
	$user_name = $this->input->post('username');
	$user_pass = $this->input->post('password');
	$id_level = $this->input->post('id_level');
	$kode = array(
		'nama_user'  => $nama_user,
		'username'   =>  $user_name,
		'id_level'      =>  $id_level,
		'password'   =>  $user_pass);
	$oke = $this->db->insert('user',$kode);
	redirect('owner/manage');
}	

public function hapususer($id)
{
	$where = array(
		'id_user' => $id
	);
	$this->db->where($where);
	$this->db->delete('user');
	redirect('owner/manage');
}

public function hapusmas($id)
{
	$where = array(
		'id_masakan' => $id
	);
	$this->db->where($where);
	$this->db->delete('masakan');
	redirect('owner/masakan');
}

public function hapus_order($id)
{
	$where = array(
		'id_order' => $id
	);
	$this->db->where($where);
	$this->db->delete('orderan');
	redirect('owner/pesanan');
}

function hapuspes($nama_mas,$id_d)
{
	$this->db->query("DELETE orderan, detail_order FROM orderan , detail_order WHERE orderan.id_order = detail_order.id_order AND detail_order.nama_masakan = '$nama_mas' AND detail_order.id_detail_order = '$id_d'");
	redirect('owner/pesanan');
}

function edituser(){

	$username = $this->input->post('username');
	$password = $this->input->post('password');
	$nama_user = $this->input->post('nama_user');
	$id_level = $this->input->post('id_level');
	$id_user = $this->input->post('id_user');
	
	$this->bioskop->edit_user($username, $password, $nama_user, $id_level, $id_user);
	redirect('owner/manage');
}

function editmas(){
	$nama_masakan = $this->input->post('nama_masakan');
	$id = $this->input->post('id_masakan');
	$deskripsi = $this->input->post('deskripsi');
	$harga = $this->input->post('harga');
	$gambar = $upload['file']['file_name'];
	$kategori = $this->input->post('kategori');
	$status_masakan = $this->input->post('status_masakan');
	$this->bioskop->edit_mas($nama_masakan, $deskripsi, $harga, $gambar, $kategori, $status_masakan);
	redirect('owner/manage');
}

public function addPesanan(){
	$no_meja = $this->input->post('no_meja');
	$tanggal = $this->input->post('tanggal');
	$keterangan = $this->input->post('keterangan');
	$kode = array(
		'no_meja'  => $no_meja,
		'tanggal'   =>  $tanggal,
		'keterangan'      =>  $keterangan,
		'status_order'   =>  "selesai");
	$oke = $this->db->insert('orderan',$kode);
	redirect('owner/pesanan');
}	

function editPesanan(){

	$id_order = $this->input->post('id_order');
	$no_meja = $this->input->post('no_meja');
	$tanggal = $this->input->post('tanggal');
	$keterangan = $this->input->post('keterangan');
	
	$this->bioskop->edit_pesanan($id_order, $no_meja, $tanggal, $keterangan);
	redirect('owner/pesanan');
}

public function gambar(){
	$data = array();

    if($this->input->post('submit')){ // Jika user menekan tombol Submit (Simpan) pada form
      // lakukan upload file dengan memanggil function upload yang ada di bioskop.php
    	$upload = $this->bioskop->upload();
    	
      if($upload['result'] == "success"){ // Jika proses upload sukses
         // Panggil function save yang ada di bioskop.php untuk menyimpan data ke database
      	$this->bioskop->save($upload);
      	
        redirect('owner/buku'); // Redirect kembali ke halaman awal / halaman view data
      }else{ // Jika proses upload gagal
        $data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
    }
}
redirect ('owner/buku');
}

public function egambar(){

	$data = array();

    if($this->input->post('submit')){ // Jika user menekan tombol Submit (Simpan) pada form
      // lakukan upload file dengan memanggil function upload yang ada di bioskop.php
    	$upload = $this->bioskop->eupload();
    	$id_masakan = $this->input->post('id_masakan');
    	$nama_masakan = $this->input->post('nama_masakan');
    	$gambar1 = $this->input->post('gambar');
    	$deskripsi = $this->input->post('deskripsi');
    	$harga = $this->input->post('harga');
    	$kategori = $this->input->post('kategori');
    	$status_masakan = $this->input->post('status_masakan');
    	
    	$this->bioskop->edit($upload, $id_masakan,$gambar1, $nama_masakan, $deskripsi, $harga, $kategori, $status_masakan);
         // Panggil function save yang ada di bioskop.php untuk menyimpan data ke database
      if($upload['result'] == "success"){ // Jika proses upload sukses
        redirect('owner/buku'); // Redirect kembali ke halaman awal / halaman view data
      }else{ // Jika proses upload gagal
        $data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
    }
}
redirect ('owner/buku');
}

public function cetakk(){
// Wherever you want to invoke the print from
// Maybe a model, controller or other library/helper

	try {
		$this->load->library('ReceiptPrint');
		$this->receiptprint->connect("XP58");
		$this->receiptprint->print_test_receipt('Enak CUy ');
	} catch (Exception $e) {
		log_message("error", "Error: Could not print. Message ".$e->getMessage());
		$this->receiptprint->close_after_exception();
	}
}

}