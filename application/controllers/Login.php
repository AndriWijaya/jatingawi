<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    //halaman login
    public function index()
    {
        //Validasi
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required',
            array('required'    => 'username harus diisi')
        );

        $this->form_validation->set_rules(
            'password',
            'Password',
            'required',
            array('required'    => 'password harus diisi')
        );

        if ($this->form_validation->run()) {
            $username   = $this->input->post('username');
            $password   = $this->input->post('password');
            //proses ke simple login
            $this->simple_login->login($username, $password);
        }
        //End validasi

        $data = array('title' => 'Login Administrator');
        $this->load->view('login/list', $data, FALSE);
    }

    //Fungsi logout
    public function logout()
    {
        //Ambil fungsi logout dari simple_login
        $this->simple_login->logout();
    }
}
