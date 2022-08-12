<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Keranjang_model extends CI_Model {

	public function get_produk_all()
	{
		$this->db->where('status_masakan','ready');
		$query = $this->db->get('masakan');
		return $query->result_array();
	}
	
	public function get_produk_kategori($kategori)
	{
		$this->db->where('status_masakan','ready');
		if($kategori>0)
		{
			$this->db->where('kategori',$kategori);
		}
		$query = $this->db->get('masakan');
		return $query->result_array();
	}
	
	public function get_kategori_all()
	{
		$query = $this->db->get('kategori');
		return $query->result_array();
	}
	
	public  function get_produk_id($id)
	{
		$this->db->select('masakan.*,nama_kategori');
		$this->db->from('masakan');
		$this->db->join('kategori', 'kategori=kategori.id','left');
		$this->db->where('id_masakan',$id);
		return $this->db->get();
	}	
	
	public function tambah_order($data)
	{
		$this->db->insert('orderan', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function tambah_dorder($data)
	{
		$this->db->insert('detail_order', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function tambah_transaksi($data)
	{
		$this->db->insert('transaksi', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}

	
}
?>