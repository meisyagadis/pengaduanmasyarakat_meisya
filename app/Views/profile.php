<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- <button class="btn btn-primary" a href="/" >back</button> -->

    <div class="col-md-6">
        <?php
        if (!empty(session()->getFlashdata("success"))) :
        ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata("success") ?>
            </div>
        <?php endif ?>
        <div class="card">
            <div class="card-header mx-10">
                <h5 class="text-center">
                    Profile
                </h5>
            </div>
            <form action="/editprofil" method="post">
                <div class="card-body">
                    <?php
                    if (session('level') == 'masyarakat') {
                        $id = $user[0]['id_masyarakat'];
                        $nama = $user[0]['nama'];
                        $username = $user[0]['username'];
                        $telp = $user[0]['telp'];
                    } else {
                        $id = $user[0]['id_petugas'];
                        $nama = $user[0]['nama_petugas'];
                        $username = $user[0]['username'];
                        $telp = $user[0]['telp'];
                    }
                    ?>
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="nama" value="<?= $nama ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" value="<?= $username ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Telp</label>
                        <input type="number" name="telp" value="<?= $telp ?>" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="">Password Lama <span class="text-danger">Kosongkan Jika Ingin Diganti</span></label>
                        <input type="password" name="password_old" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Password Baru <span class="text-danger">Kosongkan Jika Ingin Diganti</span></label>
                        <input type="password" name="password_new" class="form-control">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update Profil</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?= $this->endSection() ?>