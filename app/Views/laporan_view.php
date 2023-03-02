<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-light">
                        Laporan
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-border">
                        <tr>
                            <th>No</th>
                            <th>Tgl.pengaduan</th>
                            <th>Isi Laporan</th>
                            <th>Foto</th>
                          
                        </tr>
                        <?php
                        $no = 0;
                        foreach ($laporan as $row) {
                            $no++;
                            # code...
                        ?>


                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['tgl_pengaduan'] ?></td>
                                <td><?= $row['isi_laporan'] ?></td>
                                <td>
                                    <?php
                                    if ($row['foto'] != "") {
                                    ?>
                                        <img src='/upload/berkas/<?= $row['foto'] ?>' alt="" width="50" height="50">
                                    <?php
                                    }
                                    ?>
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
<?= $this->endSection()?>