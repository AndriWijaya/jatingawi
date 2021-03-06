<?php

//Notifikasi error
echo validation_errors('<div class="alert alert-warning">', '</div>');

//Form open
echo form_open(base_url('penjual/user/'), ' class="form-horizontal"');
?>

<div class="form-group">
    <label class="col-md-2 control-label">Nama pengguna</label>
    <div class="col-md-5">
        <input type="text" name="nama" class="form-control" placeholder="Nama pengguna" value="<?= $user->nama ?>" required>
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Email</label>
    <div class="col-md-5">
        <input type="email" name="email" class="form-control" placeholder="Email pengguna" value="<?= $user->email ?>" required>
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Username</label>
    <div class="col-md-5">
        <input type="text" name="username" class="form-control" placeholder="Nama pengguna" value="<?= $user->username ?>" readonly>
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Password</label>
    <div class="col-md-5">
        <input type="password" name="password" class="form-control" placeholder="Password" value="<?= $user->password ?>" required>
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