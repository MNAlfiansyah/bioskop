<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id_level') !== '1') {
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
			$this->load->view('admin/manage',$data);
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
			$this->load->view('admin/manage',$data);
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
			$this->load->view('admin/buku',$data);
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
			$data['pesan']	 = $this->bioskop->view_data($this->input->post('id_order'));
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

      // lakukan upload file dengan memanggil function upload yang ada di bioskop.php
    	$this->bioskop->cetakk($id_order, $total_bayar,$no_meja);

    	$trans = $this->bioskop->trans($no_meja, $id_order, $tanggal, $total_bayar);
    	if($trans == $id_order){
     //     // Panggil function save yang ada di bioskop.php untuk menyimpan data ke database
    		$this->bioskop->edit_a($id_order);
    		$this->bioskop->edit_a1($id_order);


        redirect('admin/pesanan'); // Redirect kembali ke halaman awal / halaman view data
      }else{ // Jika proses upload gagal
      	echo "error";
      }
  }
  redirect ('admin/pesanan');
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

public function hapus_order($id)
{
	$where = array(
		'id_order' => $id
	);
	$this->db->where($where);
	$this->db->delete('orderan');
	redirect('admin/pesanan');
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
	
	$this->bioskop->edit_user($username, $password, $nama_user, $id_level, $id_user);
	redirect('admin/manage');
}

function editmas(){
	$nama_masakan = $this->input->post('nama_masakan');
	$deskripsi = $this->input->post('deskripsi');
	$harga = $this->input->post('harga');
	$gambar = $upload['file']['file_name'];
	$kategori = $this->input->post('kategori');
	$status_masakan = $this->input->post('status_masakan');
	$this->bioskop->edit_mas($nama_masakan, $deskripsi, $harga, $gambar, $kategori, $status_masakan);
	redirect('admin/manage');
}

public function addPesanan(){
	$no_meja = $this->input->post('no_meja');
	$keterangan = $this->input->post('keterangan');
	$kode = array(
		'no_meja'  => $no_meja,
		'tanggal'   =>  '01/01/2022',
		'keterangan'      =>  $keterangan,
		'status_order'   =>  "selesai");
	$oke = $this->db->insert('orderan',$kode);
	redirect('admin/pesanan');
}	

function editPesanan(){

	$id_order = $this->input->post('id_order');
	$no_meja = $this->input->post('no_meja');
	$tanggal = '01/01/2022';
	$keterangan = $this->input->post('keterangan');
	
	$this->bioskop->edit_pesanan($id_order, $no_meja, $tanggal, $keterangan);
	redirect('admin/pesanan');
}

public function gambar(){
	$data = array();

    if($this->input->post('submit')){ // Jika user menekan tombol Submit (Simpan) pada form
      // lakukan upload file dengan memanggil function upload yang ada di bioskop.php
    	$upload = $this->bioskop->upload();
    	
      if($upload['result'] == "success"){ // Jika proses upload sukses
         // Panggil function save yang ada di bioskop.php untuk menyimpan data ke database
      	$this->bioskop->save($upload);
      	
        redirect('admin/buku'); // Redirect kembali ke halaman awal / halaman view data
      }else{ // Jika proses upload gagal
        $data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
    }
}
redirect ('admin/buku');
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
    	$kategori = 'makanan';
    	$status_masakan = 'ready';
    	
    	$this->bioskop->edit($upload, $id_masakan,$gambar1, $nama_masakan, $deskripsi, $harga, $kategori, $status_masakan);
         // Panggil function save yang ada di bioskop.php untuk menyimpan data ke database
      if($upload['result'] == "success"){ // Jika proses upload sukses
        redirect('admin/buku'); // Redirect kembali ke halaman awal / halaman view data
      }else{ // Jika proses upload gagal
        $data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
    }
}
redirect ('admin/buku');
}



}
