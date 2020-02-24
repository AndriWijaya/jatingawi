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
    }

    //Load data header transaksi
    public function index()
    {
        $header_transaksi  = $this->header_transaksi_model->myTransaction();

        $data   = array(
            'title'                => 'Data Transaksi',
            'header_transaksi'     => $header_transaksi,
            'isi'                  => 'penjual/transaksi/list'
        );
        $this->load->view('penjual/layout/wrapper', $data, FALSE);
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
            'isi'               => 'penjual/transaksi/detail'
        );
        $this->load->view('penjual/layout/wrapper', $data, FALSE);
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
        $this->load->view('penjual/transaksi/cetak', $data, FALSE);
    }
}
