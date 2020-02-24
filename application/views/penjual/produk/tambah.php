<?php
//Error upload
if (isset($error)) {
    echo '<p class="alert alert-warning">';
    echo $error;
    echo '</p>';
}

//Notifikasi error
echo validation_errors('<div class="alert alert-warning">', '</div>');

//Form open
echo form_open_multipart(base_url('penjual/produk/tambah'), ' class="form-horizontal"');
?>

<div class="form-group form-group-lg">
    <label class="col-md-2 control-label">Nama Produk</label>
    <div class="col-md-8">
        <input type="text" name="nama_produk" class="form-control" placeholder="Nama Produk" value="<?= set_value('nama_produk') ?>" required>
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Kode Porduk</label>
    <div class="col-md-5">
        <input type="text" name="kode_produk" class="form-control" placeholder="Kode Produk" value="<?= set_value('kode_produk') ?>" required>
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Kategori Produk</label>
    <div class="col-md-5">
        <select name="id_kategori" class="form-control">
            <?php foreach ($kategori as $kategori) { ?>
                <option value="<?= $kategori->id_kategori ?>">
                    <?= $kategori->nama_kategori ?>
                </option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Harga Porduk</label>
    <div class="col-md-5">
        <input type="number" name="harga" class="form-control" placeholder="Harga Produk" value="<?= set_value('harga') ?>" required>
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Stok Porduk</label>
    <div class="col-md-5">
        <input type="number" name="stok" class="form-control" placeholder="Stok Produk" value="<?= set_value('stok') ?>" required>
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label">Berat Porduk</label>
    <div class="col-md-5">
        <input type="text" name="berat" class="form-control" placeholder="Berat Produk" value="<?= set_value('berat') ?>" required>
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Ukuran Produk</label>
    <div class="col-md-5">
        <input type="text" name="ukuran" class="form-control" placeholder="Ukuran Produk" value="<?= set_value('ukuran') ?>" required>
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Keterangan Produk</label>
    <div class="col-md-10">
        <textarea name="keterangan" class="form-control" placeholder="Keterangan Produk" id="editor"><?= set_value('keterangan') ?></textarea>
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Keyword (untuk SEO Google)</label>
    <div class="col-md-10">
        <textarea name="keyword" class="form-control" placeholder="Keyword (untuk SEO Google)"><?= set_value('keyword') ?></textarea>
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Upload Gambar Produk</label>
    <div class="col-md-10">
        <input type="file" name="gambar" class="form-control" required="required">
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Status Produk</label>
    <div class="col-md-10">
        <select name="status_produk" class="form-control">
            <option value="Publish">Publikasikan</option>
            <option value="Draft">Simpan Sebagai Draft</option>
        </select>
    </div>
</div>


<div class="form-group">
    <label class="col-md-2 control-label"></label>
    <div class="col-md-5">
        <button class="btn btn-success btn-lg" name="submit" type="submit">
            <i class="fa fa-save"></i> Simpan
        </button>
        <button class="btn btn-info btn-lg" name="reset" type="reset">
            <i class="fa fa-times"></i> Reset
        </button>
    </div>
</div>

<?= form_close(); ?>