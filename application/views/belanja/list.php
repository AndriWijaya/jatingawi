<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
    <div class="container">
        <!-- Cart item -->
        <div class="container-table-cart pos-relative">
            <div class="wrap-table-shopping-cart bgwhite">

                <h1><?= $title ?></h1>
                <div class="clearfix"></div>
                <br><br>

                <?php if ($this->session->flashdata('sukses')) {
                    echo '<div class="alert alert-warning">';
                    echo $this->session->flashdata('sukses');
                    echo '</div>';
                } 
                if ($this->session->flashdata('gagal')) {
                    echo '<p class="alert alert-danger">';
                    echo $this->session->flashdata('gagal');
                    echo '</div>';
                } ?>

                <table class="table table-shopping-cart">
                    <tr class="table-head bg-light">
                        <th>Gambar</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Sub Total</th>
                        <th>Action</th>
                    </tr>

                    <?php
                    //looping data keranjang belanja
                    foreach ($keranjang as $keranjang) {
                        //ambil data produk
                        $id_produk  = $keranjang['id'];
                        $produk     = $this->produk_model->detail($id_produk);

                        //form update keranjang
                        echo form_open(base_url('belanja/update_cart/' . $keranjang['rowid']));
                        ?>
                        <tr class="table-row">
                            <td>
                                <div class="cart-img-product b-rad-4 o-f-hidden">
                                    <img src="<?= base_url('assets/upload/image/thumbs/' . $produk->gambar) ?>" alt="<?= $keranjang['name'] ?>">
                                </div>
                            </td>
                            <td><?= $keranjang['name'] ?></td>
                            <td>Rp <?= number_format($keranjang['price'], '0', ',', '.') ?></td>
                            <td>
                                <div class="flex-w bo5 of-hidden w-size17">
                                    <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                        <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                    </button>

                                    <input class="size8 m-text18 t-center num-product" type="number" name="qty" value="<?= $keranjang['qty'] ?>">

                                    <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                        <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </td>
                            <td>Rp
                                <?php
                                    $sub_total = $keranjang['price'] * $keranjang['qty'];
                                    echo number_format($sub_total, '0', ',', '.');
                                    ?>
                            </td>
                            <td>
                                <button type="submit" name="update" class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i> Update
                                </button>

                                <a href="<?= base_url('belanja/hapus/' . $keranjang['rowid']) ?>" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash-o"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php
                        //form close
                        echo form_close();
                        //end looping keranjang belanja
                    }
                    ?>
                    <tr class="table-row text-strong bg-light" style="font-weight: bold">
                        <td colspan="5" class="column-1 text-uppercase">Total Belanja:</td>
                        <td colspan="1" class="text-bold">Rp <?= number_format($this->cart->total(), '0', ',', '.') ?></td>
                    </tr>
                </table>
                <br>
                <p class="pull-left">
                    <a href="<?= base_url('belanja/hapus') ?>" class="btn btn-danger btn-lg">
                        <i class="fa fa-trash-o"></i> Bersihkan Keranjang Belanja
                    </a>
                </p>
                <p class="pull-right">
                    <a href="<?= base_url('belanja/booking') ?>" class="btn btn-warning btn-lg">
                        <i class="fa fa-shopping-bag"></i> Booking
                    </a>

                    <a href="<?= base_url('belanja/checkout') ?>" class="btn btn-success btn-lg">
                        <i class="fa fa-shopping-cart"></i> Checkout
                    </a>
                </p>
            </div>
        </div>

        <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
            <div class="flex-w flex-m w-full-sm">
            </div>
            <div class="size10 trans-0-4 m-t-10 m-b-10">
            </div>
        </div>
    </div>
</section>