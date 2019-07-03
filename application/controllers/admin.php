<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id_level') !== '1') {
			redirect('login');
		}

		$this->load->model('kasir');
	}

	public function index()
	{
		if($this->kasir->logged_id())	
		{
			$data['user']=$this->kasir->user()->num_rows();
			$data['masakan']=$this->kasir->masakan()->num_rows();
			$data['transaksi']=$this->kasir->pesanan_admin()->num_rows();
			$this->load->view('heater/header');
			$this->load->view('admin/dashboard',$data);
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
		if($this->kasir->logged_id())	
		{
			$data['cek']=$this->kasir->user();
			$this->load->view('heater/header');
			$this->load->view('admin/manage',$data);
			$this->load->view('heater/footer');
		}else{

			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");

		}
	}

	public function masakan()
	{
		if($this->kasir->logged_id())	
		{
			$data['mas']=$this->kasir->masakan();
			$this->load->view('heater/header');
			$this->load->view('admin/masakan',$data);
			$this->load->view('heater/footer');
		}else{

			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");

		}
	}

	public function pesanan()
	{
		if($this->kasir->logged_id())	
		{
			$data['pes'] = $this->kasir->pesanan_admin();
			$this->load->view('heater/header');
			$this->load->view('admin/pesanan',$data);
			$this->load->view('heater/footer');
		}else{

			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");

		}

	}

	public function view_data()
	{
		if (isset($_POST['cari'])) {
			$data['pesan']	 = $this->kasir->view_data($this->input->post('id_order'));
			$this->load->view('heater/header');
			$this->load->view('admin/data', $data);
			$this->load->view('heater/footer');
		}else {
			echo "Ada Kesalahan saat mengambil data !!!";
		}
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

      // lakukan upload file dengan memanggil function upload yang ada di kasir.php
    	$this->kasir->cetakk($id_order, $total_bayar,$no_meja);

    	$trans = $this->kasir->trans($no_meja, $id_order, $tanggal, $total_bayar);
    	if($trans == $id_order){
     //     // Panggil function save yang ada di kasir.php untuk menyimpan data ke database
    		$this->kasir->edit_a($id_order);
    		$this->kasir->edit_a1($id_order);


        redirect('admin/pesanan'); // Redirect kembali ke halaman awal / halaman view data
      }else{ // Jika proses upload gagal
      	echo "error";
      }
  }
  redirect ('admin/pesanan');
}


public function alldata(){	
	$id_order = $this->input->post('kode');
	$data = $this->kasir->detail($id_order)->result();
	echo json_encode($data);
}

public function transaksi()
{
	$data['tran']=$this->kasir->transaksi();
	$this->load->view('heater/header');
	$this->load->view('admin/transaksi',$data);
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
	redirect('admin/manage');
}	

public function hapususer($id)
{
	$where = array(
		'id_user' => $id
	);
	$this->db->where($where);
	$this->db->delete('user');
	redirect('admin/manage');
}

public function hapusmas($id)
{
	$where = array(
		'id_masakan' => $id
	);
	$this->db->where($where);
	$this->db->delete('masakan');
	redirect('admin/masakan');
}

function hapuspes($nama_mas,$id_d)
{
	$this->db->query("DELETE orderan, detail_order FROM orderan , detail_order WHERE orderan.id_order = detail_order.id_order AND detail_order.nama_masakan = '$nama_mas' AND detail_order.id_detail_order = '$id_d'");
	redirect('admin/pesanan');
}

function edituser(){

	$username = $this->input->post('username');
	$password = $this->input->post('password');
	$nama_user = $this->input->post('nama_user');
	$id_level = $this->input->post('id_level');
	$id_user = $this->input->post('id_user');
	
	$this->kasir->edit_user($username, $password, $nama_user, $id_level, $id_user);
	redirect('admin/manage');
}

function editmas(){
	$nama_masakan = $this->input->post('nama_masakan');
	$deskripsi = $this->input->post('deskripsi');
	$harga = $this->input->post('harga');
	$gambar = $upload['file']['file_name'];
	$kategori = $this->input->post('kategori');
	$status_masakan = $this->input->post('status_masakan');
	$this->kasir->edit_mas($nama_masakan, $deskripsi, $harga, $gambar, $kategori, $status_masakan);
	redirect('admin/manage');
}

public function gambar(){
	$data = array();

    if($this->input->post('submit')){ // Jika user menekan tombol Submit (Simpan) pada form
      // lakukan upload file dengan memanggil function upload yang ada di kasir.php
    	$upload = $this->kasir->upload();
    	
      if($upload['result'] == "success"){ // Jika proses upload sukses
         // Panggil function save yang ada di kasir.php untuk menyimpan data ke database
      	$this->kasir->save($upload);
      	
        redirect('admin/masakan'); // Redirect kembali ke halaman awal / halaman view data
      }else{ // Jika proses upload gagal
        $data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
    }
}
redirect ('admin/masakan');
}

public function egambar(){

	$data = array();

    if($this->input->post('submit')){ // Jika user menekan tombol Submit (Simpan) pada form
      // lakukan upload file dengan memanggil function upload yang ada di kasir.php
    	$upload = $this->kasir->eupload();
    	$id_masakan = $this->input->post('id_masakan');
    	$nama_masakan = $this->input->post('nama_masakan');
    	$gambar1 = $this->input->post('gambar');
    	$deskripsi = $this->input->post('deskripsi');
    	$harga = $this->input->post('harga');
    	$kategori = $this->input->post('kategori');
    	$status_masakan = $this->input->post('status_masakan');
    	
    	$this->kasir->edit($upload, $id_masakan,$gambar1, $nama_masakan, $deskripsi, $harga, $kategori, $status_masakan);
         // Panggil function save yang ada di kasir.php untuk menyimpan data ke database
      if($upload['result'] == "success"){ // Jika proses upload sukses
        redirect('admin/masakan'); // Redirect kembali ke halaman awal / halaman view data
      }else{ // Jika proses upload gagal
        $data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
    }
}
redirect ('admin/masakan');
}



}
