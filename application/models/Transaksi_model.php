<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Listing all transaksi
    public function listing()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->order_by('id_transaksi', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    //Listing all transaksi berdasarkan header
    public function kode_transaksi($kode_transaksi)
    {
        $this->db->select('transaksi.*, produk.nama_produk, produk.kode_produk');
        $this->db->from('transaksi');
        $this->db->join('produk', 'produk.id_produk = transaksi.id_produk', 'left');
        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->order_by('id_transaksi', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    //Detail transaksi
    public function detail($id_transaksi)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->order_by('id_transaksi', 'asc');
        $query = $this->db->get();
        return $query->row();
    }

    //Detail slug   transaksi
    public function read($slug_transaksi)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('slug_transaksi', $slug_transaksi);
        $this->db->order_by('id_transaksi', 'asc');
        $query = $this->db->get();
        return $query->row();
    }

    //Login transaksi
    public function login($username, $password)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where(array(
            'username'    => $username,
            'password'    => SHA1($password)
        ));
        $this->db->order_by('id_transaksi', 'asc');
        $query = $this->db->get();
        return $query->row();
    }

    //Tambah
    public function tambah($data)
    {
        $this->db->insert('transaksi', $data);
    }

    //Edit
    public function edit($data)
    {
        $this->db->where('id_transaksi', $data['id_transaksi']);
        $this->db->update('transaksi', $data);
    }

    //Delete
    public function delete($data)
    {
        $this->db->where('id_transaksi', $data['id_transaksi']);
        $this->db->delete('transaksi', $data);
    }

    //Delete
    public function deleteTransaksi($data)
    {
        $this->db->where('kode_transaksi', $data['kode_transaksi']);
        $this->db->delete('transaksi', $data);
        $this->db->delete('header_transaksi', $data);
    }
}
