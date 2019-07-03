<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class owner extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id_level') !== '4') {
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
			$data['transaksi']=$this->kasir->transaksi()->num_rows();
			$this->load->view('heater/header');
			$this->load->view('owner/dashboard',$data);
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
			$this->load->view('owner/manage',$data);
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
			$this->load->view('owner/masakan',$data);
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
			$this->load->view('owner/pesanan',$data);
			$this->load->view('heater/footer');
		}else{

			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");

		}

	}

	public function laporan()
	{
		if($this->kasir->logged_id())	
		{
			$data['lap'] = $this->kasir->laporan();
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
			$data['pesan']	 = $this->kasir->view_data($this->input->post('id_order'));
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
			$data['lapor']	 = $this->kasir->view_lapor($this->input->post('tanggal'),$this->input->post('tanggal1'));
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
	// 		$this->kasir->laporanpenjualan($id_transaksi, $tanggal, $id_order, $no_meja, $total_bayar, $tanggal1);
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

      // lakukan upload file dengan memanggil function upload yang ada di kasir.php
    	$this->kasir->cetakk($id_order, $total_bayar,$no_meja);

    	$trans = $this->kasir->trans($no_meja, $id_order, $tanggal, $total_bayar);
    	
    	if($trans == $id_order){
     //     // Panggil function save yang ada di kasir.php untuk menyimpan data ke database
    		$this->kasir->edit_a($id_order);
    		$this->kasir->edit_a1($id_order);


        redirect('owner/pesanan'); // Redirect kembali ke halaman awal / halaman view data
      }else{ // Jika proses upload gagal
      	echo "error";
      }
  }
  redirect ('owner/pesanan');
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
	
	$this->kasir->edit_user($username, $password, $nama_user, $id_level, $id_user);
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
	$this->kasir->edit_mas($nama_masakan, $deskripsi, $harga, $gambar, $kategori, $status_masakan);
	redirect('owner/manage');
}

public function gambar(){
	$data = array();

    if($this->input->post('submit')){ // Jika user menekan tombol Submit (Simpan) pada form
      // lakukan upload file dengan memanggil function upload yang ada di kasir.php
    	$upload = $this->kasir->upload();
    	
      if($upload['result'] == "success"){ // Jika proses upload sukses
         // Panggil function save yang ada di kasir.php untuk menyimpan data ke database
      	$this->kasir->save($upload);
      	
        redirect('owner/masakan'); // Redirect kembali ke halaman awal / halaman view data
      }else{ // Jika proses upload gagal
        $data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
    }
}
redirect ('owner/masakan');
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
        redirect('owner/masakan'); // Redirect kembali ke halaman awal / halaman view data
      }else{ // Jika proses upload gagal
        $data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
    }
}
redirect ('owner/masakan');
}

public function laporanpenjualan(){
	$id_transaksi =$this->input->post('id_transaksi');
	$tanggal =$this->input->post('tanggal');
	$id_order =$this->input->post('id_order');
	$no_meja =$this->input->post('no_meja');
	$total_bayar =$this->input->post('total_bayar');
	$tanggal1 = $this->input->post('tanggal1');
	$cet = $this->db->query("SELECT * FROM transaksi WHERE tanggal BETWEEN '$tanggal' AND '$tanggal1' ");

	$pdf = new FPDF("P","mm","A4");
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',13);
	$pdf->Cell(45);
	$pdf->Cell(100,0,'Laporan Data Penjualan '.$tanggal.' - '.$tanggal1.' '  ,0,0,'C');
	$pdf->Ln(5);
	$pdf->SetFont('Arial','',10);
	$pdf->SetFillColor(100,0,0);
	$pdf->SetTextColor(255);
	$pdf->SetDrawColor(0,0,0);
	$header = array('Id_trans', 'Id Order', 'No Meja', 'Total Harga');
        // Lebar Header Sesuaikan Jumlahnya dengan Jumlah Field Tabel Database
	$w = array(47.5, 47.5, 47.5, 47.5);
	for($i=0;$i<count($header);$i++)
		$pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
	$pdf->Ln();
	$fill = false; // Data
	$pdf->SetFillColor(224,235,255);
	$pdf->SetTextColor(0);
	$pdf->SetFont('');

	foreach ($cet->result_array() as $i):
		$id_transaksi = $i['id_transaksi'];
		$tanggal = $tanggal;
		$id_order = $i['id_order'];
		$no_meja = $i['no_meja'];
		$total_bayar = $i['total_bayar'];
		$tanggal12 = $tanggal1;

		$pdf->Cell($w[0],6,$id_transaksi,'LR',0,'L',$fill); 
		$pdf->Cell($w[1],6,$id_order,'LR',0,'L',$fill);
		$pdf->Cell($w[2],6,$no_meja,'LR',0,'L',$fill);
		$pdf->Cell($w[3],6,$total_bayar,'LR',0,'L',$fill);
		
		$pdf->Ln();
		$fill = !$fill;
	endforeach;
	$pdf->Cell(array_sum($w),0,'','T');

	$pdf->Output();

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