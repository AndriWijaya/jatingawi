<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    //Load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('rekening_model');
        $this->load->model('transaksi_model');
        $this->load->model('header_transaksi_model');
        $this->load->model('konfigurasi_model');
        $this->simple_login->cek_admin();
    }

    //Load data header transaksi
    public function index()
    {
        $header_transaksi  = $this->header_transaksi_model->listing();

        $data   = array(
            'title'                => 'Data Transaksi',
            'header_transaksi'     => $header_transaksi,
            'isi'                  => 'admin/transaksi/list'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    //Detail
    public function detail($kode_transaksi)
    {
        $header_transaksi   = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
        $transaksi          = $this->transaksi_model->kode_transaksi($kode_transaksi);

        $data = array(
            'title'             => 'Riwayat Belanja',
            'header_transaksi'  => $header_transaksi,
            'transaksi'         => $transaksi,
            'isi'               => 'admin/transaksi/detail'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    //Cetak
    public function cetak($kode_transaksi)
    {
        $header_transaksi   = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
        $transaksi          = $this->transaksi_model->kode_transaksi($kode_transaksi);
        $site               = $this->konfigurasi_model->listing();

        $data = array(
            'title'             => 'Riwayat Belanja',
            'header_transaksi'  => $header_transaksi,
            'transaksi'         => $transaksi,
            'site'              => $site
        );
        $this->load->view('admin/transaksi/cetak', $data, FALSE);
    }

    //update status transaksi (kofirmasi --> terkonfirmasi)
    public function status($kode_transaksi)
    {
        $header_transaksi = $this->header_transaksi_model->detailHeaderTransaksi($kode_transaksi);

        if($header_transaksi->status_bayar == 'Konfirmasi'){
            $data = array(
                'kode_transaksi'    => $kode_transaksi,
                'status_bayar'      => 'Terkonfirmasi'
            );

            $this->header_transaksi_model->editTransaksi($data);
            $this->session->set_flashdata('sukses', 'Status transaksi berhasil diperbaruhi!');
        }
        redirect(base_url('admin/transaksi'), 'refresh');
    }

    //delete transaksi
    public function delete($kode_transaksi)
    {
        $transaksi = $this->transaksi_model->kode_transaksi($kode_transaksi);
        foreach ($transaksi as $transaksi){
            $dataProduk = array(
                'id_produk'         => $transaksi->id_produk,
                'stok'              => $transaksi->jumlah
            );

            //stok kembali tambah
            $this->produk_model->resetStok($dataProduk);
        }

        $data = array('kode_transaksi' => $kode_transaksi);
        $this->transaksi_model->deleteTransaksi($data);
        $this->session->set_flashdata('sukses', 'Data transaksi telah dihapus!');
        redirect(base_url('admin/transaksi'), 'refresh');
    }
}
