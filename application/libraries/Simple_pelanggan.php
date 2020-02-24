<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Simple_pelanggan
{
    protected $CI;
    public function __construct()
    {
        $this->CI = &get_instance();
        //Load data model user
        $this->CI->load->model('pelanggan_model');
    }

    //Fungsi login
    public function login($email, $password)
    {
        $check = $this->CI->pelanggan_model->login($email, $password);
        //Jika ada data user, maka create session login
        if ($check) {
            $id_pelanggan       = $check->id_pelanggan;
            $nama_pelanggan     = $check->nama_pelanggan;
            //Create session
            $this->CI->session->set_userdata('id_pelanggan', $id_pelanggan);
            $this->CI->session->set_userdata('nama_pelanggan', $nama_pelanggan);
            $this->CI->session->set_userdata('email', $email);
            //redirect ke halaman admin yang diproteksi
            redirect(base_url('dashboard'), 'refresh');
        } else {
            //Jika tidak ada (username password salah), maka diminta login lagi
            $this->CI->session->set_flashdata('warning', 'Username atau password salah');
            redirect(base_url('masuk'), 'refresh');
        }
    }

    //Fungsi cek login
    public function cek_login()
    {
        //Memeriksa apakah session sudah atau belum, jika belum alihkan ke halaman login
        if ($this->CI->session->userdata('email') == "") {
            $this->CI->session->set_flashdata('warning', 'Anda belum login');
            redirect(base_url('masuk'), 'refresh');
        }
    }

    //Fungsi logout
    public function logout()
    {
        //Membuang semua session yang telah diset pada saat login
        $this->CI->session->unset_userdata('id_pelanggan');
        $this->CI->session->unset_userdata('nama_pelanggan');
        $this->CI->session->unset_userdata('email');
        //Setelah session dibuang maka redirect ke halaman login
        $this->CI->session->set_flashdata('sukses', 'Anda berhasil logout');
        redirect(base_url('masuk'), 'refresh');
    }
}
