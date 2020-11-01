<h1 align="center">DAFTAR SURAT MASUK</h1>
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr align="center">
                    <th>No</th>
                    <th>Nama File</th>
                    <th>Ukuran File</th>
                    <th>Tanggal Surat Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $no = null;
                $dir = "uploaded_file/";

                if (isset($daftar_file)) {
                    for ($a = 0; $a < count($daftar_file); $a++) {
                        if ($daftar_file[$a] != '.' && $daftar_file[$a] != '..') {
                            $no++;
                            $file = $daftar_file[$a];
                ?>
                            <tr align="center">
                                <td align="center"><?php echo $no; ?></td>
                                <td><?php echo $file; ?></td>
                                <td align="center"><?php echo number_format(filesize($dir . $daftar_file[$a]) / 1024, 2, ',', '.'); ?> Kb</td>
                                <td><?php echo date("d-M-Y H:i:s", filemtime($dir . $daftar_file[$a])); ?></td>
                                <td align="center">
                                    <a href="<?php echo base_url('/') . $dir . $daftar_file[$a]; ?>"><span class="btn btn-primary">Download</span></a>
                                    <a href="<?php echo base_url() . 'admin/hapuspdf/' . $daftar_file[$a]; ?>"><span class="btn btn-danger">Hapus</span></a>
                                </td>
                            </tr>
            </tbody>
<?php
                        }
                    }
                }
?>
        </table>
    </div>
</div>