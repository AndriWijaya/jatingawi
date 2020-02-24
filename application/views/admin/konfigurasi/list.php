<?php
//Notifikasi
if ($this->session->flashdata('sukses')) {
    echo '<p class="alert alert-success">';
    echo $this->session->flashdata('sukses');
    echo '</div>';
}
?>

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
echo form_open_multipart(base_url('admin/konfigurasi'), ' class="form-horizontal"');
?>

<div class="form-group form-group-lg">
    <label class="col-md-3 control-label">Nama Website</label>
    <div class="col-md-8">
        <input type="text" name="namaweb" class="form-control" placeholder="Nama Website" value="<?= $konfigurasi->namaweb ?>" required>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Tagline</label>
    <div class="col-md-8">
        <input type="text" name="tagline" class="form-control" placeholder="Tagline" value="<?= $konfigurasi->tagline ?>" required>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Email</label>
    <div class="col-md-8">
        <input type="email" name="email" class="form-control" placeholder="Email" value="<?= $konfigurasi->email ?>" required>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Website</label>
    <div class="col-md-8">
        <input type="text" name="website" class="form-control" placeholder="Website" value="<?= $konfigurasi->website ?>" required>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Alamat Facebook</label>
    <div class="col-md-8">
        <input type="text" name="facebook" class="form-control" placeholder="Alamat Facebook" value="<?= $konfigurasi->facebook ?>" required>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Alamat Instagram</label>
    <div class="col-md-8">
        <input type="text" name="instagram" class="form-control" placeholder="Alamat Instagram" value="<?= $konfigurasi->instagram ?>" required>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Telepon</label>
    <div class="col-md-8">
        <input type="text" name="telepon" class="form-control" placeholder="Telepon" value="<?= $konfigurasi->telepon ?>" required>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Alamat Toko</label>
    <div class="col-md-9">
        <textarea name="alamat" class="form-control" placeholder="Alamat Toko"><?= $konfigurasi->alamat ?></textarea>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Keyword (untuk SEO Google)</label>
    <div class="col-md-9">
        <textarea name="keywords" class="form-control" placeholder="Keyword (untuk SEO Google)"><?= $konfigurasi->keywords ?></textarea>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Kode Metatext</label>
    <div class="col-md-9">
        <textarea name="metatext" class="form-control" placeholder="Kode Metatext"><?= $konfigurasi->metatext ?></textarea>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label">Deskripsi Website</label>
    <div class="col-md-9">
        <textarea name="deskripsi" class="form-control" placeholder="Deskripsi Website"><?= $konfigurasi->deskripsi ?></textarea>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label">Rekening Pembayaran</label>
    <div class="col-md-9">
        <textarea name="rekening_pembayaran" class="form-control" placeholder="Rekening Pembayaran"><?= $konfigurasi->rekening_pembayaran ?></textarea>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label"></label>
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