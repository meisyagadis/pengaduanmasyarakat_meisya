<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="fw-bold text-light">
                        Masyarakat
                    </h3>
                    <a href="" data-toggle="modal" data-target="#fmasyarakat" data-masyarakat="add" class="btn btn-danger"><i class="fas fa-user-plus"></i>Tambah Data</a>
                </div>
                <div class="card-body">
                    <table class="table table-border">
                        <tr>
                            <th>No</th>
                            <th>Nik</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Telp</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                        $no = 0;
                        foreach ($masyarakat as $row) {
                            $data = $row['id_masyarakat'] . "," . $row['nik'] . "," . $row['nama'] . "," . $row['username'] . "," . $row['password'] . "," . $row['telp'] . "," . base_url('masyarakat/edit/' . $row['id_masyarakat']);
                            $no++;
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['nik'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['username'] ?></td>
                                <td><?= $row['telp'] ?></td>
                                <td>
                                    <a href="" data-toggle="modal" data-target="#fmasyarakat" data-masyarakat="<?= $data ?>" class="btn btn-primary"><i class="fas fa-edit"></i>Edit</a>
                                    <a href="masyarakat/hapus/<?= $row['id_masyarakat'] ?>" onclick="return confirm('yakin hapus data?')" class="btn btn-danger"><i class="fas fa-trash"></i>Hapus</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="fmasyarakat" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Masyarakat</h3>
                <button type="button" aria-labelledby="close" class="close"></button>
            </div>
            <form action="" id="editmasyarakat" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nik">Nik</label>
                        <input type="number" name="nik" id="nik" value="" class="form-control">
                    </div>
                    <div clarss="fom-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">password</label>
                        <input type="password" name="password" id="password" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="telp">telp</label>
                        <input type="telp" name="telp" id="telp" value="" class="form-control">
                    </div>
                    <div class="form-group" id="ubahpassword">
                        <label for="">Ubah Password</label>
                        <input type="checkbox" name="ubahpassword" aria-label="yakin dihapus?" value="" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" name="close" data-dismiss="close" class="btn btn-secondary">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php if (!empty(session()->getFlashdata("message"))) : ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata("message") ?>
            </div>
        <?php endif ?>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $("#fmasyarakat").on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var data = button.data('masyarakat');
            //alert('asa');
            if (data != "add") {
                const barisdata = data.split(",");
                $("#nik").val(barisdata[1]);
                $("#nama").val(barisdata[2]);
                $("#username").val(barisdata[3]);
                $("#password").val(barisdata[4]);
                $("#telp").val(barisdata[5]);
                $("#editmasyarakat").attr('action', barisdata[6]);
                $("#ubahpassword").show();
            } else {
                $("#nik").val("");
                $("#nama").val("");
                $("#username").val("");
                $("#password").val("");
                $("#telp").val("");
                $("#editmasyarakat").attr('action', "masyarakat");
                $("#ubahpassword").hide();
            }
        });
    })
</script>
<?= $this->endSection() ?>