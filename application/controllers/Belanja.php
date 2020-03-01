<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Belanja extends CI_Controller
{
    //load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->model('kategori_model');
        $this->load->model('konfigurasi_model');
        $this->load->model('pelanggan_model');
        $this->load->model('header_transaksi_model');
        $this->load->model('transaksi_model');
        //load helper random string
        $this->load->helper('string');
    }

    //halaman belanja
    public function index()
    {
        $keranjang  = $this->cart->contents();

        $data       = array(
            'title'         => 'Keranjang Belanja',
            'keranjang'     => $keranjang,
            'isi'           => 'belanja/list'
        );
        $this->load->view('layout/wrapper', $data, FALSE);
    }

    //halaman belanja sukses
    public function sukses()
    {
        $data       = array(
            'title'         => 'Belanja berhasil',
            'isi'           => 'belanja/sukses'
        );
        $this->load->view('layout/wrapper', $data, FALSE);
    }

    //checkout
    public function checkout()
    {
        //check sudah login atau belum?
        //minta user registrasi dan atau login terlebih dahulu

        //kondisi sudah login
        if ($this->session->userdata('email')) {
            $email               = $this->session->userdata('email');
            $nama_pelanggan      = $this->session->userdata('nama_pelanggan');
            $pelanggan           = $this->pelanggan_model->sudah_login($email, $nama_pelanggan);

            $keranjang  = $this->cart->contents();

            //Validasi input
            $valid = $this->form_validation;

            $valid->set_rules(
                'nama_pelanggan',
                'Nama lengkap',
                'required',
                array('required'        => '%s harus diisi')
            );

            $valid->set_rules(
                'telepon',
                'Nomor telepon',
                'required',
                array('required'        => '%s harus diisi')
            );

            $valid->set_rules(
                'alamat',
                'Alamat',
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

            if ($valid->run() == FALSE) {
                //End Validasi

                $data       = array(
                    'title'         => 'Checkout',
                    'pelanggan'     => $pelanggan,
                    'keranjang'     => $keranjang,
                    'isi'           => 'belanja/checkout'
                );
                $this->load->view('layout/wrapper', $data, FALSE);
                //Masuk database
            } else {
                $i = $this->input;
                $data = array(
                    'id_pelanggan'      => $pelanggan->id_pelanggan,
                    'nama_pelanggan'    => $i->post('nama_pelanggan'),
                    'email'             => $i->post('email'),
                    'telepon'           => $i->post('telepon'),
                    'alamat'            => $i->post('alamat'),
                    'kode_transaksi'    => $i->post('kode_transaksi'),
                    'tanggal_transaksi' => $i->post('tanggal_transaksi'),
                    'jumlah_transaksi'  => $i->post('jumlah_transaksi'),
                    'status_bayar'      => 'Belum',
                    'tipe_pembayaran'   => 'Lunas',
                    'tanggal_post'      => date('Y-m-d H:i:s')
                );
                //Proses masuk ke header transaksi
                $this->header_transaksi_model->tambah($data);
                //Proses masuk ke tabel transaksi
                foreach ($keranjang as $keranjang) {
                    $id_produk  = $keranjang['id'];
                    $produk     = $this->produk_model->detail($id_produk);

                    $sub_total = $keranjang['price'] * $keranjang['qty'];
                    $data = array(
                        'id_pelanggan'      => $pelanggan->id_pelanggan,
                        'id_user'           => $produk->id_user,
                        'kode_transaksi'    => $i->post('kode_transaksi'),
                        'id_produk'         => $keranjang['id'],
                        'harga'             => $keranjang['price'],
                        'jumlah'            => $keranjang['qty'],
                        'total_harga'       => $sub_total,
                        'tanggal_transaksi' => $i->post('tanggal_transaksi'),
                    );
                    $dataProduk = array(
                        'id_produk'         => $keranjang['id'],
                        'stok'              => ($produk->stok - $keranjang['qty'])
                    );

                    $this->transaksi_model->tambah($data);
                    $this->produk_model->edit($dataProduk);
                }
                //End masuk ke tabel transaksi
                //Setelah masuk tabel transaksi, maka keranjang dikosongkan lagi
                $this->cart->destroy();
                //End pengosongan keranjang
                $this->session->set_flashdata('sukses', 'Checkout berhasil!');
                redirect(base_url('belanja/sukses'), 'refresh');
            }
            //End masuk database
        } else {
            //kondisi belum login
            $this->session->set_flashdata('sukses', 'Silahkan registrasi dan atau login terlebih dahulu!');
            redirect(base_url('registrasi'), 'refresh');
        }
    }

    //booking
    public function booking()
    {
        //check sudah login atau belum?
        //minta user registrasi dan atau login terlebih dahulu

        //kondisi sudah login
        if ($this->session->userdata('email')) {
            $email               = $this->session->userdata('email');
            $nama_pelanggan      = $this->session->userdata('nama_pelanggan');
            $pelanggan           = $this->pelanggan_model->sudah_login($email, $nama_pelanggan);

            $keranjang  = $this->cart->contents();

            //Validasi input
            $valid = $this->form_validation;

            $valid->set_rules(
                'nama_pelanggan',
                'Nama lengkap',
                'required',
                array('required'        => '%s harus diisi')
            );

            $valid->set_rules(
                'telepon',
                'Nomor telepon',
                'required',
                array('required'        => '%s harus diisi')
            );

            $valid->set_rules(
                'alamat',
                'Alamat',
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

            if ($valid->run() == FALSE) {
                //End Validasi

                $data       = array(
                    'title'         => 'Booking',
                    'pelanggan'     => $pelanggan,
                    'keranjang'     => $keranjang,
                    'isi'           => 'belanja/booking'
                );
                $this->load->view('layout/wrapper', $data, FALSE);
                //Masuk database
            } else {
                $i = $this->input;
                $data = array(
                    'id_pelanggan'      => $pelanggan->id_pelanggan,
                    'nama_pelanggan'    => $i->post('nama_pelanggan'),
                    'email'             => $i->post('email'),
                    'telepon'           => $i->post('telepon'),
                    'alamat'            => $i->post('alamat'),
                    'kode_transaksi'    => $i->post('kode_transaksi'),
                    'tanggal_transaksi' => $i->post('tanggal_transaksi'),
                    'jumlah_transaksi'  => $i->post('jumlah_transaksi'),
                    'status_bayar'      => 'Belum',
                    'tipe_pembayaran'   => 'Booking',
                    'tanggal_post'      => date('Y-m-d H:i:s')
                );
                //Proses masuk ke header transaksi
                $this->header_transaksi_model->tambah($data);
                //Proses masuk ke tabel transaksi
                foreach ($keranjang as $keranjang) {
                    $id_produk  = $keranjang['id'];
                    $produk     = $this->produk_model->detail($id_produk);

                    $sub_total = $keranjang['price'] * $keranjang['qty'];
                    $data = array(
                        'id_pelanggan'      => $pelanggan->id_pelanggan,
                        'id_user'           => $produk->id_user,
                        'kode_transaksi'    => $i->post('kode_transaksi'),
                        'id_produk'         => $keranjang['id'],
                        'harga'             => $keranjang['price'],
                        'jumlah'            => $keranjang['qty'],
                        'total_harga'       => $sub_total,
                        'tanggal_transaksi' => $i->post('tanggal_transaksi'),
                    );

                    $dataProduk = array(
                        'id_produk'         => $keranjang['id'],
                        'stok'              => ($produk->stok - $keranjang['qty'])
                    );

                    $this->transaksi_model->tambah($data);
                    $this->produk_model->edit($dataProduk);
                }
                //End masuk ke tabel transaksi
                //Setelah masuk tabel transaksi, maka keranjang dikosongkan lagi
                $this->cart->destroy();
                //End pengosongan keranjang
                $this->session->set_flashdata('sukses', 'Booking berhasil!');
                redirect(base_url('belanja/sukses'), 'refresh');
            }
            //End masuk database
        } else {
            //kondisi belum login
            $this->session->set_flashdata('sukses', 'Silahkan registrasi dan atau login terlebih dahulu!');
            redirect(base_url('registrasi'), 'refresh');
        }
    }

    //tambahkan ke keranjang belanja
    public function add()
    {
        if ($this->session->userdata('email')) {
            $email               = $this->session->userdata('email');
            $nama_pelanggan      = $this->session->userdata('nama_pelanggan');
            $pelanggan           = $this->pelanggan_model->sudah_login($email, $nama_pelanggan);

            //ambil data dari form
            $id                = $this->input->post('id');
            $qty               = $this->input->post('qty');
            $price             = $this->input->post('price');
            $name              = $this->input->post('name');
            $redirect_page     = $this->input->post('redirect_page');

            //cek apa stok > pesanan
            $produk = $this->produk_model->detail($id);
            if ($qty <= $produk->stok) {
                //proses memasukkan ke keranjang belanja
                $data = array(
                    'id'        => $id,
                    'qty'       => $qty,
                    'price'     => $price,
                    'name'      => $name
                );
                $this->cart->insert($data);
            } else {
                $this->session->set_flashdata('gagal', 'Gagal menambahkan pada keranjang belanja. Pastikan stok barang mencukupi');    
            }
            
            //redirect page
            redirect($redirect_page, 'refresh');
        } else {
            //kondisi belum login
            $this->session->set_flashdata('sukses', 'Silahkan registrasi dan atau login terlebih dahulu!');
            redirect(base_url('registrasi'), 'refresh');
        }
    }
    public function update_cart($rowid)
    {
        //jika ada data rowid
        if ($rowid) {
            //get id produk by rowid
            $item = $this->cart->get_item($rowid);
            //cek apa stok > pesanan
            $produk = $this->produk_model->detail($item['id']);
            if ($this->input->post('qty') <= $produk->stok) {
                $data = array(
                    'rowid'     => $rowid,
                    'qty'       => $this->input->post('qty')
                );
                $this->cart->update($data);
                $this->session->set_flashdata('sukses', 'Data keranjang telah diupdate!');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal mengubah jumlah produk. Pastikan stok barang mencukupi');    
            }
            redirect(base_url('belanja'), 'refresh');
        } else {
            //jika tidak ada rowid
            redirect(base_url('belanja'), 'refresh');
        }
    }

    //hapus semua isi keranjang belanja
    public function hapus($rowid = '')
    {
        if ($rowid) {
            //hapus per item
            $this->cart->remove($rowid);
            $this->session->set_flashdata('sukses', 'Data keranjang belanja telah dihapus!');
            redirect(base_url('belanja'), 'refresh');
        } else {
            //hapus semua
            $this->cart->destroy();
            $this->session->set_flashdata('sukses', 'Data keranjang belanja telah dihapus!');
            redirect(base_url('belanja'), 'refresh');
        }
    }
}
