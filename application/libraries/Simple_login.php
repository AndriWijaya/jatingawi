<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Simple_login
{
    protected $CI;
    public function __construct()
    {
        $this->CI = &get_instance();
        //Load data model user
        $this->CI->load->model('user_model');
    }

    //Fungsi login
    public function login($username, $password)
    {
        $check = $this->CI->user_model->login($username, $password);
        //Jika ada data user, maka create session login
        if ($check) {
            $id_user        = $check->id_user;
            $nama           = $check->nama;
            $akses_level    = $check->akses_level;
            //Create session
            $this->CI->session->set_userdata('id_user', $id_user);
            $this->CI->session->set_userdata('nama', $nama);
            $this->CI->session->set_userdata('username', $username);
            $this->CI->session->set_userdata('akses_level', $akses_level);

            //redirect ke halaman admin yang diproteksi
            // redirect(base_url('admin/dashboard'), 'refresh');
            if($akses_level == 'Admin'){ 
                redirect(base_url('admin/dashboard'), 'refresh');
            } else if($akses_level == 'Penjual'){ 
                redirect(base_url('penjual/transaksi'), 'refresh');
            }
        } else {
            //Jika tidak ada (username password salah), maka diminta login lagi
            $this->CI->session->set_flashdata('warning', 'Username atau password salah');
            redirect(base_url('login'), 'refresh');
        }
    }

    //Fungsi cek login
    public function cek_login()
    {
        //Memeriksa apakah session sudah atau belum, jika belum alihkan ke halaman login
        if ($this->CI->session->userdata('username') == "") {
            $this->CI->session->set_flashdata('warning', 'Anda belum login');
            redirect(base_url('login'), 'refresh');
        }
    }

    //Fungsi cek login
    public function cek_admin()
    {
        //Memeriksa apakah session admin
        if ($this->CI->session->userdata('akses_level') != "Admin") {
            redirect(base_url('penjual/transaksi'), 'refresh');
        }
    }

    //Fungsi logout
    public function logout()
    {
        //Membuang semua session yang telah diset pada saat login
        $this->CI->session->unset_userdata('id_user');
        $this->CI->session->unset_userdata('nama');
        $this->CI->session->unset_userdata('username');
        $this->CI->session->unset_userdata('akses_level');
        //Setelah session dibuang maka redirect ke halaman login
        $this->CI->session->set_flashdata('sukses', 'Anda berhasil logout');
        redirect(base_url('login'), 'refresh');
    }
}
