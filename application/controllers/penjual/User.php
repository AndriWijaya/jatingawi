<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    //Load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        //Proteksi halaman
        $this->simple_login->cek_login();
    }

    //Data user
    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        $user = $this->user_model->detail($id_user);
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
            'password',
            'Password',
            'required',
            array('required'        => '%s harus diisi')
        );

        if ($valid->run() == FALSE) {
            //End Validasi

            $data = array(
                'title'     => 'Edit Pengguna',
                'user'      => $user,
                'isi'       => 'penjual/user/edit'
            );
            $this->load->view('penjual/layout/wrapper', $data, FALSE);
            //Masuk database
        } else {
            $i = $this->input;
            $data = array(
                'id_user'           => $id_user,
                'nama'              => $i->post('nama'),
                'email'             => $i->post('email'),
                'username'          => $i->post('username'),
                'password'          => SHA1($i->post('password'))
            );
            $this->user_model->edit($data);
            $this->session->set_flashdata('sukses', 'Data telah diubah!');
            redirect(base_url('penjual/user'), 'refresh');
        }
        //End masuk database
    }

    //Tambah user
    public function tambah()
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

            $data = array(
                'title'     => 'Tambah Pengguna',
                'isi'       => 'penjual/user/tambah'
            );
            $this->load->view('penjual/layout/wrapper', $data, FALSE);
            //Masuk database
        } else {
            $i = $this->input;
            $data = array(
                'nama'              => $i->post('nama'),
                'email'             => $i->post('email'),
                'username'          => $i->post('username'),
                'password'          => SHA1($i->post('password')),
                'akses_level'       => $i->post('akses_level')
            );
            $this->user_model->tambah($data);
            $this->session->set_flashdata('sukses', 'Data telah ditambahkan!');
            redirect(base_url('penjual/user'), 'refresh');
        }
        //End masuk database
    }
}
