<!DOCTYPE html>
<html>

<body>
    <div class="container">
        <?php
        defined('BASEPATH') or exit('No direct script access allowed');
        ?>
        <h2>Unggah Surat Peminjaman</h2>
        <p>Unggah Surat Peminjaman dengan format : NamaLengkap-NamaKelembagaan</p>
        <!-- <div class="flash-data" data-alert="<?php echo $this->session->flashdata('warning'); ?>"></div> -->
        <?php echo $this->session->flashdata('warning'); ?>
        <form method="POST" action="<?php echo base_url(); ?>user/do_upload" enctype="multipart/form-data">
            <div class="form-group">
                <label>Pilih File</label>
                <input type="file" name="file_nya">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-upload"><span class="glyphicon glyphicon-cloud-upload"></span> Upload</button>
            </div>

        </form>
    </div>
</body>



</html>