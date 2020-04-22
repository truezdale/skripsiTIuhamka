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
                                <li class="breadcrumb-item active">Booking Room</li>
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
                            <form method="POST" action="<?= base_url('admin/prosesruang') ?>">
                                <div class="card-body">
                                    <div class="col-sm-8">
                                        <label for="exampleInputPassword1">Ruangan</label>
                                        <input type="text" name="m_booking_room_name" class="form-control">
                                    </div>
                                    <div class="col-sm-5">
                                        <label for="exampleInputEmail1">Jam Mulai</label>
                                        <input type="datetime-local" name="m_booking_start" class="form-control">
                                    </div>
                                    <div class="col-sm-5">
                                        <label for="exampleInputPassword1">Jam Selesai</label>
                                        <input type="datetime-local" name="m_booking_end" class="form-control">
                                    </div>
                                    <div class="col-sm-8">
                                        <label for="exampleInputEmail1">Agenda</label>
                                        <input type="text" name="m_booking_agenda" class="form-control">
                                    </div>
                                    <div class="col-sm-8">
                                        <label for="exampleInputPassword1">Penanggung Jawab</label>
                                        <input type="text" name="m_booking_PIC" class="form-control">
                                    </div>
                                    <div class="col-sm-8">
                                        <label for="exampleInputPassword1">Lantai</label>
                                        <input type="text" name="lantai" class="form-control">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div><!-- /.container-fluid -->

                </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    </section>
</body>

</html>