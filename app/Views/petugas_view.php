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
                        Petugas
                    </h3>
                    <a href="" data-toggle="modal" data-target="#fpetugas" data-petugas="add" class="btn btn-danger outline-light"><i class="fas fa-user-plus"></i>Tambah Data</a>
                </div>
                <div class="card-body">
                    <table class="table table-border">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>username</th>
                            <th>Telp</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                        $no = 0;
                        foreach ($petugas as $row) {
                            $data = $row['id_petugas'] . "," . $row['nama_petugas'] . "," . $row['username'] . "," . $row['password'] . "," . $row['telp'] . "," . $row['level'] . "," . base_url('petugas/edit/' . $row['id_petugas']);
                            $no++;
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['nama_petugas'] ?></td>
                                <td><?= $row['username'] ?></td>
                                <td><?= $row['telp'] ?></td>
                                <td><?= $row['level'] ?></td>
                                <td>
                                    <a href="" data-toggle="modal" data-target="#fpetugas" data-petugas="<?= $data ?>" class="btn btn-primary"><i class="fas fa-edit"></i>Edit</a>
                                    <a href="petugas/hapus/<?= $row['id_petugas'] ?>" onclick="return confirm('Yakin Menghapus Data?')"class="btn btn-danger"><i class="fas fa-trash"></i>Hapus</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                </div>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="fpetugas" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Petugas</h3>
                <button type="button" aria-labelledby="close" class="close" data-dismiss="close"></button>
            </div>
            <form action="" id="editpetugas" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama_petugas" id="nama_petugas" value="" class="form-control">
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
                    <div class="form-group">
                        <label for="level">Level
                            <select name="level" id="level" class="form-control" value="">
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                            </select>
                        </label>
                    </div>
                    <div class="form-group" id="ubahpassword">
                        <label for="ubahpassword">Ubah Password</label>
                        <input type="checkbox" name="ubahpassword" aria-label="yakin dihapus?" class="form-control">
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
        $("#fpetugas").on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var data = button.data('petugas');
            if (data != "add") {

                const barisdata = data.split(",");
                $("#nama_petugas").val(barisdata[1]);
                $("#username").val(barisdata[2]);
                $("#password").val(barisdata[3]);
                $("#telp").val(barisdata[4]);
                $("#level").val(barisdata[5]).change();
                $("#editpetugas").attr('action', barisdata[6]);
                $("#ubahpassword").show();
            } else {
                $("#nama_petugas").val("");
                $("#username").val("");
                $("#password").val("");
                $("#telp").val("");
                $("#level").val("");
                $("#editpetugas").attr('action', "petugas");
                $("#ubahpassword").hide();
            }
        });
    })
</script>
<?= $this->endSection() ?>