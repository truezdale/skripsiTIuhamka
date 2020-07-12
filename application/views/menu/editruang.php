<!DOCTYPE html>
<html>

<body class="hold-transition sidebar-mini" onload="wsConnect();" onunload="wsa.disconnect();">
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="<?php echo site_url('admin/lantai1') ?>">Home</a></li>
                                <li class="breadcrumb-item active">Edit Ruangan</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"></h3>
                            </div>
                            <?php foreach ($data5 as $edit) { ?>
                                <form method="POST" action="<?= base_url('admin/editruangproses'); ?>">
                                    <div class="card-body">
                                        <div class="col-sm-8">
                                            <input type="hidden" name="m_booking_id" class="form-control" value="<?php echo $edit->m_booking_id ?>">
                                        </div>
                                        <div class="col-sm-8">
                                            <?php
                                            if ($edit->lantai == 1) {
                                                $datadropdown = array(
                                                    'Ruang Dosen', 'Ruang Dekan', 'Ruang Sidang'
                                                );
                                            } elseif ($edit->lantai == 2) {
                                                $datadropdown = array(
                                                    'FT TI1', 'FT TI2', 'FT TI3'
                                                );
                                            } elseif ($edit->lantai == 3) {
                                                $datadropdown = array(
                                                    '301', '302', '303', '304', '305'
                                                );
                                            } else {
                                                $datadropdown = array(
                                                    '401', '402', '403', '404', '405', '406'
                                                );
                                            }
                                            ?>
                                            <label for="cars">Pilih Ruangan</label>
                                            <select name="m_booking_name" id="m_booking_name" class="form-control">
                                                <?php foreach ($datadropdown as $row) : ?>
                                                    <option value="<?php echo $row ?>"><?php echo $row ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-8">
                                            <label for="exampleInputEmail1">Jam Mulai</label>
                                            <input type="datetime-local" name="m_booking_start" class="form-control" value="<?php echo date("Y-m-d\TH:i:s", strtotime($edit->m_booking_start)); ?>">
                                        </div>
                                        <div class="col-sm-8">
                                            <label for="exampleInputPassword1">Jam Selesai</label>
                                            <input type="datetime-local" name="m_booking_end" class="form-control" value="<?php echo date("Y-m-d\TH:i:s", strtotime($edit->m_booking_end)); ?>">
                                        </div>
                                        <div class="col-sm-8">
                                            <label for="exampleInputEmail1">Agenda</label>
                                            <input type="text" name="m_booking_agenda" class="form-control" value="<?php echo $edit->m_booking_agenda ?>">
                                        </div>
                                        <div class="col-sm-8">
                                            <label for="exampleInputPassword1">Penanggung Jawab</label>
                                            <input type="text" name="m_booking_PIC" class="form-control" value="<?php echo $edit->m_booking_PIC ?>">
                                        </div>
                                        <div class="col-sm-8">
                                            <label for="exampleInputPassword1">Lantai</label>
                                            <input type="dropdown" name="lantai" class="form-control" value="<?php echo $edit->lantai ?>">
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                                    </div>
                                </form>
                            <?php } ?>
                        </div>
                    </div><!-- /.container-fluid -->

            </section>
        </div>
    </div>
    </div>
    <!-- /.container-fluid -->


</body>

</html>