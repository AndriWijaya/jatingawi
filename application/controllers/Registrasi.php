<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registrasi extends CI_Controller
{
    //load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pelanggan_model');
    }

    //halaman registrasi
    public function index()
    {
        //Validasi input
        $valid = $this->form_validation;

        $valid->set_rules(
            'nama_pelanggan',
            'Nama lengkap',
            'required',
            array('required'        => '%s harus diisi')
        );

        $valid->set_rules(
            'email',
            'Email',
            'required|valid_email|is_unique[pelanggan.email]',
            array(
                'required'        => '%s harus diisi',
                'valid_email'     => '%s tidak valid',
                'is_unique'     => '%s sudah terdaftar'
            )
        );

        $valid->set_rules(
            'password',
            'Password',
            'required',
            array('required'        => '%s harus diisi')
        );

        if ($valid->run() == FALSE) {
            //End Validasi

            $data   = array(
                'title'     => 'Registrasi Pelanggan',
                'isi'       => 'registrasi/list'
            );
            $this->load->view('layout/wrapper', $data, FALSE);

            //Masuk database
        } else {
            $i = $this->input;
            $data = array(
                'status_pelanggan'  => 'Pending',
                'nama_pelanggan'    => $i->post('nama_pelanggan'),
                'email'             => $i->post('email'),
                'password'          => SHA1($i->post('password')),
                'telepon'           => $i->post('telepon'),
                'alamat'            => $i->post('alamat'),
                'tanggal_daftar'    => date('Y-m-d H:i:s')
            );
            $this->pelanggan_model->tambah($data);
            //create session login
            $this->session->set_userdata('email', $i->post('email'));
            $this->session->set_userdata('nama_pelanggan', $i->post('nama_pelanggan'));
            //end session login
            $this->session->set_flashdata('sukses', 'Registrasi berhasil!');
            redirect(base_url('registrasi/sukses'), 'refresh');
        }
        //End masuk database
    }

    //registrasi sukses
    public function sukses()
    {
        $data   = array(
            'title'         => 'Registrasi berhasil',
            'isi'           => 'registrasi/sukses'
        );
        $this->load->view('layout/wrapper', $data, FALSE);
    }

    //register penjual
    public function penjual()
    {
        //Validasi input
        $valid = $this->form_validation;

        $valid->set_rules(
            'nama',
            'Nama lengkap',
            'required',
            array('required'        => '%s harus diisi')
        );

        $valid->set_rules(
            'email',
            'Email',
            'required|valid_email',
            array(
                'required'        => '%s harus diisi',
                'valid_email'     => '%s tidak valid'
            )
        );

        $valid->set_rules(
            'username',
            'Username',
            'required|min_length[6]|max_length[32]|is_unique[users.username]',
            array(
                'required'        => '%s harus diisi',
                'min_length'      => '%s minimal 6 karakter',
                'max_length'      => '%s maksimal 32 karakter',
                'is_unique'       => '%s sudah ada. Buat username baru.'
            )
        );

        $valid->set_rules(
            'password',
            'Password',
            'required',
            array('required'        => '%s harus diisi')
        );

        if ($valid->run() == FALSE) {
            //End Validasi

            $data   = array(
                'title'     => 'Registrasi Penjual',
                'isi'       => 'registrasi/registrasi-penjual'
            );
            $this->load->view('layout/wrapper', $data, FALSE);
            //Masuk database
        } else {
            $i = $this->input;
            $data = array(
                'nama'              => $i->post('nama'),
                'email'             => $i->post('email'),
                'username'          => $i->post('username'),
                'password'          => SHA1($i->post('password')),
                'akses_level'       => 'Penjual'
            );
            $this->user_model->tambah($data);
            $this->session->set_flashdata('sukses', 'Registrasi berhasil!');
            redirect(base_url('registrasi/sukses'), 'refresh');
        }
        //End masuk database
    }
}
