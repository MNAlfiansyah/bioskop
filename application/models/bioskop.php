<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class bioskop extends CI_Model
{
	function logged_id()
	{
		return $this->session->userdata('id_user');
	}

	function get_all()
	{
		$hasil=$this->db->query("SELECT * FROM level");
		return $hasil;
	}

	public function cek_user($data) {
		$query = $this->db->get_where('user', $data);
		return $query;
	}

	function check_login($table, $field1, $field2)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($field1);
		$this->db->where($field2);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			return FALSE;
		} else {
			return $query->result();
		}
	}

	public function user()
	{
		return $this->db->get('user');
	}  

	public function transaksi()
	{
		return $this->db->get('transaksi');
	}

	public function order()
	{
		return $this->db->get('orderan');
	}

	public function masakan()
	{
		return $this->db->get('masakan');
	}

	public function detail_order()
	{
		return $this->db->get('detail_order');
	}

	// Function Pesanan
	public function pesanan()
	{
		return $this->db->query("SELECT  o.no_meja ,o.id_order, r.nama_masakan, r.harga, r.qty, (r.harga * r.qty) as total_harga FROM orderan o INNER join detail_order r ON o.id_order = r.id_order where o.keterangan = 'selesai' AND o.status_order = 'belum selesai' group by o.id_order");
	}

	public function pesanan_admin()
	{
		return $this->db->query("SELECT  o.no_meja ,o.id_order, r.nama_masakan, r.harga, r.qty, (r.harga * r.qty) as total_harga FROM orderan o INNER join detail_order r ON o.id_order = r.id_order  group by o.id_order");
	}

	public function orderan()
	{
		return $this->db->query("SELECT  *  FROM orderan");
	}

	public function view_data($id)
	{
		return $this->db->query("SELECT  r.id_detail_order, o.tanggal, r.keterangan, o.no_meja ,o.id_order, r.nama_masakan, r.harga, r.qty, (r.harga * r.qty) as total_harga FROM orderan o INNER join detail_order r ON o.id_order = r.id_order where o.status_order = 'belum selesai' AND r.id_order = '$id' ");
	}

	public function trans($no_meja, $id_order, $tanggal, $total_bayar)
	{
		return $this->db->query("INSERT into transaksi (no_meja, id_order, tanggal, total_bayar) Values ('$no_meja', '$id_order', '$tanggal', '$total_bayar')");

	}

	public function o_del($id_order)
	{
		return $this->db->query("UPDATE user SET username='$username', password='$password', nama_user='$nama', id_level='$lvl' WHERE username='$username' ");
	}

	public function edit_a($id_order)
	{
		return $this->db->query("UPDATE orderan SET status_order = 'selesai' where id_order = '$id_order' ");
	}

	public function edit_a1($id_order)
	{
		return $this->db->query("UPDATE detail_order SET status_detail_order = 'selesai' where id_order = '$id_order' ");
	}
	//SELECT o.*,sum(r.harga * r.qty) as jumlah FROM orderan o INNER join detail_order r ON o.id_order = r.id_order where o.status_order = 'belum selesai' group by o.id_order

	// public function detail($id_order){
	// 	return $this->db->query("SELECT o.* FROM detail_order o INNER join orderan r ON o.id_order = r.id_order WHERE r.id_order= '$id_order'");
	// }

	// SELECT *, sum(transaksi.total_bayar) as jumlah_bayar FROM `orderan` JOIN transaksi WHERE orderan.id_order = transaksi.id_order GROUP BY transaksi.id_order, transaksi.tanggal

	// public function transaksi()
	// {
	// 	return $this->db->query("SELECT detail_order.*, transaksi.*, user.*, orderan.*, masakan.* FROM detail_order, transaksi, user, orderan, masakan WHERE detail_order.id_order = transaksi.id_order AND orderan.id_user = user.id_user AND detail_order.id_masakan = masakan.id_masakan	");
	// }

	// ----	Edit User ----

	public function laporan()
	{
		return $this->db->query("SELECT * from transaksi group by tanggal");
	}


	public function view_lapor($tanggal,$tanggal1)
	{
		return $this->db->query("SELECT * FROM transaksi WHERE tanggal BETWEEN '$tanggal' AND '$tanggal1' ");
	}

	//SELECT * FROM `transaksi` WHERE `tanggal` BETWEEN '2019-03-23' AND '2019-03-27'

	function edit_user($username, $password, $nama_user, $id_level, $id_user)
	{
		return $this->db->query("UPDATE user SET username = '$username', password = '$password', nama_user = '$nama_user', id_level = '$id_level' WHERE id_user = '$id_user' ");
	}

	function edit_pesanan($id_order, $no_meja, $tanggal, $keterangan)
	{
		return $this->db->query("UPDATE orderan SET no_meja = '$no_meja', tanggal = '$tanggal', keterangan = '$keterangan', status_order = 'selesai' WHERE id_order = '$id_order' ");
	}

	// ---- Nambah Masakan dengan foto ---- 

	public function upload(){
		$config['upload_path'] = './assets/pelanggan/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['remove_space'] = TRUE;

    $this->load->library('upload', $config); // Load konfigurasi uploadnya
    if($this->upload->do_upload('gambar')){ // Lakukan upload dan Cek jika proses upload berhasil
      // Jika berhasil :
    	$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
    	return $return;
    }else{
      // Jika gagal :
    	$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
    	return $return;
    }
}

public function waiter()
{
	return $this->db->query("SELECT  o.no_meja ,o.id_order, r.nama_masakan, r.harga, r.qty, (r.harga * r.qty) as total_harga FROM orderan o INNER join detail_order r ON o.id_order = r.id_order where o.keterangan = 'dibuat' AND o.status_order = 'belum selesai' group by o.id_order");
}

public function waiter1($id_transaksi, $tanggal, $id_order, $no_meja, $total_bayar)
{
	return $this->db->query("UPDATE orderan SET keterangan = 'selesai' where id_order = '$id_order' ");
}

public function waiter2($id_transaksi, $tanggal, $id_order, $no_meja, $total_bayar)
{
	return $this->db->query("UPDATE detail_order SET keterangan = 'selesai' where id_order = '$id_order' ");
}

public function save($upload){
	$data = array(
		'nama_masakan' => $this->input->post('nama_masakan'),
		'deskripsi' => $this->input->post('deskripsi'),
		'harga' => $this->input->post('harga'),
		'gambar' => $upload['file']['file_name'],
		'kategori'=> 'makanan',
		'status_masakan' => 'ready'
	);

	$this->db->insert('masakan', $data);
}

	// ---- Edit Foto Masakan ----

public function eupload(){
	$config['upload_path'] = './assets/pelanggan/';
	$config['allowed_types'] = 'jpg|png|jpeg';
	$config['remove_space'] = TRUE;

    $this->load->library('upload', $config); // Load konfigurasi uploadnya
    if($this->upload->do_upload('gambar')){ // Lakukan upload dan Cek jika proses upload berhasil
      // Jika berhasil :
    	$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
    	return $return;
    }else{
      // Jika gagal :
    	$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
    	return $return;
    }
}

public function edit($upload, $id_masakan, $gambar1, $nama_masakan, $deskripsi, $harga, $kategori, $status_masakan){
	$cek = $this->db->query("SELECT gambar from masakan where id_masakan = '$id_masakan'");

	 $gambar = $upload['file']['file_name'];
	if($gambar ==''){

		$sql = $this->db->query("UPDATE masakan SET id_masakan = '$id_masakan', nama_masakan = '$nama_masakan', deskripsi = '$deskripsi', harga = '$harga' , kategori ='$kategori', status_masakan ='$status_masakan'  where id_masakan = '$id_masakan' ");
		return $sql;

		 // or die (mysql_error());
	}else{

		$sql = $this->db->query("UPDATE masakan SET id_masakan = '$id_masakan', nama_masakan = '$nama_masakan', deskripsi = '$deskripsi', harga = '$harga' ,  gambar = '$gambar', kategori ='$kategori', status_masakan ='$status_masakan'  where id_masakan = '$id_masakan' ");
		return $sql;
	}
	if ($sql) {
                                //jika  berhasil tampil ini
		echo '<script>alert("DATA BERHASIL DIUBAH");</script>';
	} else {
                                // jika gagal tampil ini
		echo '<script>alert("DATA GAGAL DIUBAH");</script>';
	}
}

public function cetakk($id_order, $total_bayar,$no_meja){
// Wherever you want to invoke the print from
// Maybe a model, controller or other library/helper
	 $apa = $this->db->query("SELECT  r.id_detail_order, o.tanggal, r.keterangan, o.no_meja ,o.id_order, r.nama_masakan, r.harga, r.qty, (r.harga * r.qty) as total_harga FROM orderan o INNER join detail_order r ON o.id_order = r.id_order where o.status_order = 'belum selesai' AND r.id_order = '$id_order' ");

	try {
		$this->load->library('ReceiptPrint');
		$this->receiptprint->connect("XP581");
		$this->receiptprint->print_test_receipt($apa, $total_bayar,$no_meja);
	} catch (Exception $e) {
		log_message("error", "Error: Could not print. Message ".$e->getMessage());
		$this->receiptprint->close_after_exception();
	}
}

}