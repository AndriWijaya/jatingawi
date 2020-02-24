<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title><?= $title ?></title>
    <style type="text/css" media="print">
        body {
            font-family: Arial;
            font-size: 12px;
        }

        .cetak {
            width: 19cm;
            height: 27cm;
            padding: 1cm;
        }

        table {
            border: solid thin #000;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #F5F5F5;
            font-weight: bold;
        }

        h1 {
            text-align: center;
            font-size: 18px;
            text-transform: uppercase;
        }
    </style>
    <style type="text/css" media="screen">
        body {
            font-family: Arial;
            font-size: 12px;
        }

        .cetak {
            width: 19cm;
            height: 27cm;
            padding: 1cm;
        }

        table {
            border: solid thin #000;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #F5F5F5;
            font-weight: bold;
        }

        h1 {
            text-align: center;
            font-size: 18px;
            text-transform: uppercase;
        }
    </style>
</head>

<body onload="print()">
    <div class="cetak">
        <h1>DETAIL TRANSAKSI <?= $site->namaweb ?></h1>
        <table class="table table-bordered table-responsive" width="100%">
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
                    <td>: <?= number_format($header_transaksi->jumlah_transaksi, '0', ',', '.') ?></td>
                </tr>
                <tr>
                    <td>Status Bayar</td>
                    <td>: <?= $header_transaksi->status_bayar ?></td>
                </tr>
                <tr>
                    <td>Bukti Bayar</td>
                    <td>: <?php if ($header_transaksi->bukti_bayar == "") {
                                echo 'Tidak ada';
                            } else { ?>
                            <img src="<?= base_url('assets/upload/image/' . $header_transaksi->bukti_bayar) ?>" class="img img-thumbnail" width="200">
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Bayar</td>
                    <td>: <?= date('d-m-Y', strtotime($header_transaksi->tanggal_bayar)) ?></td>
                </tr>
                <tr>
                    <td>Jumlah Bayar</td>
                    <td>: Rp. <?= number_format($header_transaksi->jumlah_bayar, '0', ',', '.') ?></td>
                </tr>
                <tr>
                    <td>Pembayaran Dari</td>
                    <td>: <?= $header_transaksi->nama_bank ?> - No. rekening <?= $header_transaksi->rekening_pembayaran ?> - a.n <?= $header_transaksi->rekening_pelanggan ?></td>
                </tr>
                <tr>
                    <td>Pembayaran ke Rekening</td>
                    <td>: <?= $header_transaksi->bank ?> - No. rekening <?= $header_transaksi->nomor_rekening ?> - a.n <?= $header_transaksi->nama_pemilik ?></td>
                </tr>
            </tbody>
        </table>

        <hr>

        <table class="table table-bordered table-responsive" width="100%">
            <thead>
                <tr class="bg-success text-sm">
                    <th class="text-center">NO</th>
                    <th class="text-center">KODE</th>
                    <th class="text-center">NAMA PRODUK</th>
                    <th class="text-center">HARGA</th>
                    <th class="text-center">JUMLAH</th>
                    <th class="text-center">SUB TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?PHP $i = 1;
                foreach ($transaksi as $transaksi) { ?>
                    <tr>
                        <td class="text-center"><?= $i ?></td>
                        <td class="text-center"><?= $transaksi->kode_produk ?></td>
                        <td class="text-center"><?= $transaksi->nama_produk ?></td>
                        <td class="text-center">Rp <?= number_format($transaksi->harga, '0', ',', '.') ?></td>
                        <td class="text-center"><?= $transaksi->jumlah ?></td>
                        <td class="text-center">Rp <?= number_format($transaksi->total_harga, '0', ',', '.') ?></td>
                    </tr>
                <?php $i++;
                } ?>
            </tbody>
        </table>
    </div>
</body>

</html>