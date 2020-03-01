<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    //load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pelanggan_model');
        $this->load->model('header_transaksi_model');
        $this->load->model('transaksi_model');
        $this->load->model('rekening_model');
        //halaman ini diproteksi dengan simple_pelanggan => cek login
        $this->simple_pelanggan->cek_login();
    }

    //halaman dashboard
    public function index()
    {
        //ambil data login dari session
        $id_pelanggan       = $this->session->userdata('id_pelanggan');
        $header_transaksi   = $this->header_transaksi_model->pelanggan($id_pelanggan);

        $data = array(
            'title'             => 'Halaman Dashboard Pelanggan',
            'header_transaksi'  => $header_transaksi,
            'isi'               => 'dashboard/list'
        );
        $this->load->view('layout/wrapper', $data, FALSE);
    }

    //belanja
    public function belanja()
    {
        //ambil data login dari session
        $id_pelanggan       = $this->session->userdata('id_pelanggan');
        $header_transaksi   = $this->header_transaksi_model->pelanggan($id_pelanggan);

        $data = array(
            'title'             => 'Riwayat Belanja',
            'header_transaksi'  => $header_transaksi,
            'isi'               => 'dashboard/belanja'
        );
        $this->load->view('layout/wrapper', $data, FALSE);
    }

    //Detail
    public function detail($kode_transaksi)
    {
        //ambil data login dari session
        $id_pelanggan       = $this->session->userdata('id_pelanggan');
        $header_transaksi   = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
        $transaksi          = $this->transaksi_model->kode_transaksi($kode_transaksi);

        //pastikan pelanggan hanya bisa mengakses data transaksinya
        if ($header_transaksi->id_pelanggan != $id_pelanggan) {
            $this->session->set_flashdata('warning', 'Anda mencoba mengakses data transaksi orang lain');
            redirect(base_url('masuk'));
        }

        $data = array(
            'title'             => 'Detail Riwayat Belanja',
            'header_transaksi'  => $header_transaksi,
            'transaksi'         => $transaksi,
            'isi'               => 'dashboard/detail'
        );
        $this->load->view('layout/wrapper', $data, FALSE);
    }

    //Profil
    public function profil()
    {
        $id_pelanggan       = $this->session->userdata('id_pelanggan');
        $pelanggan          = $this->pelanggan_model->detail($id_pelanggan);

        //Validasi input
        $valid = $this->form_validation;

        $valid->set_rules(
            'nama_pelanggan',
            'Nama Lengkap',
            'required',
            array('required'        => '%s harus diisi')
        );

        $valid->set_rules(
            'alamat',
            'Alamat Lengkap',
            'required',
            array('required'        => '%s harus diisi')
        );

        $valid->set_rules(
            'telepon',
            'Nomor Telepon',
            'required',
            array('required'        => '%s harus diisi')
        );

        if ($valid->run() == FALSE) {
            //End Validasi
            $data = array(
                'title'             => 'Profil Saya',
                'pelanggan'         => $pelanggan,
                'isi'               => 'dashboard/profil'
            );
            $this->load->view('layout/wrapper', $data, FALSE);

            //Masuk database
        } else {
            $i = $this->input;
            //Jika password lebih 6 karakter, maka password diganti
            if (strlen($i->post('password')) >= 6) {
                $data = array(
                    'id_pelanggan'      => $id_pelanggan,
                    'nama_pelanggan'    => $i->post('nama_pelanggan'),
                    'password'          => SHA1($i->post('password')),
                    'telepon'           => $i->post('telepon'),
                    'alamat'            => $i->post('alamat')
                );
            } else {
                //Jika password kurang dari 6, maka password tidak diganti
                $data = array(
                    'id_pelanggan'      => $id_pelanggan,
                    'nama_pelanggan'    => $i->post('nama_pelanggan'),
                    'telepon'           => $i->post('telepon'),
                    'alamat'            => $i->post('alamat')
                );
            }
            $this->pelanggan_model->edit($data);
            $this->session->set_flashdata('sukses', 'Update Profil Berhasil!');
            redirect(base_url('dashboard/profil'), 'refresh');
        }
        //End masuk database
    }

    //konfirmasi pembayaran
    public function konfirmasi($kode_transaksi)
    {
        $header_transaksi   = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
        $rekening           = $this->rekening_model->listing();

        //Validasi input
        $valid = $this->form_validation;

        $valid->set_rules(
            'nama_bank',
            'Nama Bank',
            'required',
            array('required'        => '%s harus diisi')
        );

        $valid->set_rules(
            'rekening_pembayaran',
            'Nomor Rekening',
            'required',
            array(
                'required'        => '%s harus diisi',
            )
        );
        $valid->set_rules(
            'rekening_pelanggan',
            'Nomor Pemilik Rekening',
            'required',
            array(
                'required'        => '%s harus diisi',
            )
        );
        $valid->set_rules(
            'tanggal_bayar',
            'Tanggal Pembayaran',
            'required',
            array(
                'required'        => '%s harus diisi',
            )
        );
        $valid->set_rules(
            'jumlah_bayar',
            'Jumlah Pembayaran',
            'required',
            array(
                'required'        => '%s harus diisi',
            )
        );

        if ($valid->run()) {
            //set tipe pembayaran
            if($header_transaksi->tipe_pembayaran == 'Lunas'){
                $next_tipe_pembayaran = 'Lunas';
            } else if($header_transaksi->tipe_pembayaran == 'Booking'){
                $next_tipe_pembayaran = 'Booking-DP';
            } else if($header_transaksi->tipe_pembayaran == 'Booking-DP'){
                $next_tipe_pembayaran = 'Booking-Lunas';
            } else {
                $next_tipe_pembayaran = $header_transaksi->tipe_pembayaran;
            }

            //Konfirmasi pembayaran dan upload bukti bayar 
            if (!empty($_FILES['bukti_bayar']['name'])) {
                $config['upload_path']      = './assets/upload/image/'. $kode_transaksi. '/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg';
                $config['max_size']         = '2048';
                $config['max_width']        = '4096';
                $config['max_height']       = '4096';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('bukti_bayar')) {

                    //End Validasi
                    $data               = array(
                        'title'                 => 'Konfirmasi Pembayaran',
                        'header_transaksi'      => $header_transaksi,
                        'rekening'              => $rekening,
                        'error'                 => $this->upload->display_errors(),
                        'isi'                   => 'dashboard/konfirmasi'
                    );
                    $this->load->view('layout/wrapper', $data, FALSE);
                    //Masuk database
                } else {
                    $upload_gambar = array('upload_data' => $this->upload->data());

                    //Create thumbnail gambar
                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/upload/image/' . $kode_transaksi. '/'. $upload_gambar['upload_data']['file_name'];
                    //Lokasi folder thumbnail
                    $config['new_image']        = './assets/upload/image/thumbs/';
                    $config['create_thumb']     = TRUE;
                    $config['maintain_ratio']   = TRUE;
                    $config['width']            = 250; //Pixel
                    $config['height']           = 250; //Pixel
                    $config['thumb_marker']     = '';

                    $this->load->library('image_lib', $config);

                    $this->image_lib->resize();
                    //End create thumbnail

                    $i = $this->input;
                    $data = array(
                        'id_header_transaksi'   => $header_transaksi->id_header_transaksi,
                        'status_bayar'          => 'Konfirmasi',
                        'jumlah_bayar'          => $i->post('jumlah_bayar'),
                        'rekening_pembayaran'   => $i->post('rekening_pembayaran'),
                        'rekening_pelanggan'    => $i->post('rekening_pelanggan'),
                        'bukti_bayar'           => $upload_gambar['upload_data']['file_name'],
                        'id_rekening'           => $i->post('id_rekening'),
                        'tanggal_bayar'         => $i->post('tanggal_bayar'),
                        'tipe_pembayaran'       => $next_tipe_pembayaran,
                        'nama_bank'             => $i->post('nama_bank')

                    );
                    $this->header_transaksi_model->edit($data);
                    $this->session->set_flashdata('sukses', 'Konfirmasi Pembayaran Berhasil!');
                    redirect(base_url('dashboard'), 'refresh');
                }
            } else {
                //Konfirmasi pembayaran tanpa upload bukti bayar
                $i = $this->input;
                $data = array(
                    'id_header_transaksi'   => $header_transaksi->id_header_transaksi,
                    'status_bayar'          => 'Konfirmasi',
                    'jumlah_bayar'          => $i->post('jumlah_bayar'),
                    'rekening_pembayaran'   => $i->post('rekening_pembayaran'),
                    'rekening_pelanggan'    => $i->post('rekening_pelanggan'),
                    // 'bukti_bayar'           => $upload_gambar['upload_data']['file_name'],
                    'id_rekening'           => $i->post('id_rekening'),
                    'tanggal_bayar'         => $i->post('tanggal_bayar'),
                    'tipe_pembayaran'       => $next_tipe_pembayaran,
                    'nama_bank'             => $i->post('nama_bank')

                );
                $this->header_transaksi_model->edit($data);
                $this->session->set_flashdata('sukses', 'Konfirmasi Pembayaran Berhasil!');
                redirect(base_url('dashboard'), 'refresh');
            }
        }
        //End masuk database
        $data               = array(
            'title'                 => 'Konfirmasi Pembayaran',
            'header_transaksi'      => $header_transaksi,
            'rekening'              => $rekening,
            'isi'                   => 'dashboard/konfirmasi'
        );
        $this->load->view('layout/wrapper', $data, FALSE);
    }
}
