<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-md-2 col-lg-3 p-b-50">
                <div class="leftbar p-r-20 p-r-0-sm">
                    <!--  -->
                    <?php include('menu.php') ?>
                </div>
            </div>

            <div class="col-sm-7 col-md-10 col-lg-9 p-b-50">
                <h1><?= $title ?></h1>
                <hr>

                <?php
                //Jika ada transaksi, tampilkan tabel riwayatnya
                if ($header_transaksi) { ?>

                    <table class="table table-responsive" width="100%">
                        <thead>
                            <tr>
                                <th width="20%">KODE TRANSAKSI</th>
                                <th>: <?= $header_transaksi->kode_transaksi ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tanggal</td>
                                <td>: <?= date('d-m-Y', strtotime($header_transaksi->tanggal_transaksi)) ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Total</td>
                                <td>: Rp <?= number_format($header_transaksi->jumlah_transaksi, '0', ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td>Status Bayar</td>
                                <td>: <?= $header_transaksi->status_bayar ?></td>
                            </tr>
                            <tr>
                                <td>Bukti Bayar</td>
                                <td>: <?php if ($header_transaksi->bukti_bayar != "") { ?>
                                        <img src="<?= base_url('assets/upload/image/' . $header_transaksi->bukti_bayar) ?>" class="img img-thumbnail" width="200">
                                    <?php } else {
                                            echo "Belum ada bukti bayar";
                                        } ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php
                        //Error upload
                        if (isset($error)) {
                            echo '<p class="alert alert-warning">' . $error . '</p>';
                        }

                        //Notifikasi error
                        echo validation_errors('<p class="alert alert-warning">', '</p>');

                        echo form_open_multipart(base_url('dashboard/konfirmasi/' . $header_transaksi->kode_transaksi));

                        ?>
                    <br>
                    <table class="table table-responsive table-bordered">
                        <tbody>
                            <tr>
                                <td width="30%">Pembayaran ke Rekening</td>
                                <td>
                                    <select name="id_rekening" class="form-control">
                                        <?php foreach ($rekening as $rekening) { ?>
                                            <option value="<?= $rekening->id_rekening ?>" <?php if ($header_transaksi->id_rekening == $rekening->id_rekening) {
                                                                                                        echo "selected";
                                                                                                    } ?>>
                                                <?= $rekening->nama_bank ?> (NO. Rekening: <?= $rekening->nama_pemilik ?>)
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Pembayaran</td>
                                <td>
                                    <input type="text" name="tanggal_bayar" class="form-control-lg" placeholder="dd-mm-yy" value="<?php if (isset($_POST['tanggal_bayar'])) {
                                                                                                                                            echo set_value('tanggal_bayar');
                                                                                                                                        } elseif ($header_transaksi->tanggal_bayar != "") {
                                                                                                                                            echo $header_transaksi->tanggal_bayar;
                                                                                                                                        } else {
                                                                                                                                            echo date('d-m-Y');
                                                                                                                                        } ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Jumlah Pembayaran</td>
                                <td>
                                    <input type="number" name="jumlah_bayar" class="form-control-lg" placeholder="Jumlah Pembayaran" value="<?php if (isset($_POST['jumlah_bayar'])) {
                                                                                                                                                    echo set_value('jumlah_bayar');
                                                                                                                                                } elseif ($header_transaksi->jumlah_bayar != "") {
                                                                                                                                                    echo $header_transaksi->jumlah_bayar;
                                                                                                                                                } else {
                                                                                                                                                    echo $header_transaksi->jumlah_transaksi;
                                                                                                                                                } ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Dari Bank</td>
                                <td>
                                    <input type="text" name="nama_bank" class="form-control-lg" placeholder="Nama Bank" value="<?= $header_transaksi->nama_bank ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Nomor Rekening</td>
                                <td>
                                    <input type="text" name="rekening_pembayaran" class="form-control-lg" placeholder="Nomor Rekening" value="<?= $header_transaksi->rekening_pembayaran ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Pemilik Rekening</td>
                                <td>
                                    <input type="text" name="rekening_pelanggan" class="form-control-lg" placeholder="Nama Pemilik Rekening" value="<?= $header_transaksi->rekening_pelanggan ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Upload Bukti Pembayaran</td>
                                <td>
                                    <input type="file" name="bukti_bayar" class="form-control-lg" placeholder="Upload Bukti Pembayaran">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-success btn-lg" type="submit" name="submit"><i class="fa fa-upload"></i> Submit</button> &nbsp;
                                        <button class="btn btn-info btn-lg" type="reset" name="reset"><i class="fa fa-times"></i> Reset</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                <?php
                    //Form close
                    echo form_close();

                    //Jika tidak ada tampilkan notifikasi
                } else { ?>
                    <p class="alert alert-warning">
                        <i class="fa fa-warning"></i> Belum ada data riwayat belanja
                    </p>

                <?php } ?>
            </div>
        </div>
    </div>
</section>