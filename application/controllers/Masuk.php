<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masuk extends CI_Controller
{
    //load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pelanggan_model');
    }

    //login pelanggan
    public function index()
    {
        //Validasi
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required',
            array('required'    => 'email harus diisi')
        );

        $this->form_validation->set_rules(
            'password',
            'Password',
            'required',
            array('required'    => 'password harus diisi')
        );

        if ($this->form_validation->run()) {
            $email   = $this->input->post('email');
            $password   = $this->input->post('password');
            //proses ke simple pelanggan
            $this->simple_pelanggan->login($email, $password);
        }
        //End validasi
        $data = array(
            'title'             => 'Login Pelanggan',
            'isi'               => 'masuk/list'
        );
        $this->load->view('layout/wrapper', $data, FALSE);
    }

    //logout
    public function logout()
    {
        //ambil fungsi logout dari libraries Simple_pelanggan
        $this->simple_pelanggan->logout(); 
    }
}
