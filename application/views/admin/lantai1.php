<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

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
                                    <li class="breadcrumb-item active">Booking Room</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h>Keterangan :</h>
                                            <button class="btn btn-success">Available</button>
                                            <button class="btn btn-danger">Used</button>
                                            <button class="btn btn-warning">Booked</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <?php
                                            foreach ($room as $row) {
                                                $date = date_default_timezone_set('Asia/Jakarta');
                                                $today = date('Y-m-d H:i:s');
                                            ?>
                                                <div class="col-md-4 col-sm-6 col-12">
                                                    <a href="<?php echo base_url('admin/addbooking/') . $row->m_booking_id ?>">
                                                        <div class="info-box">
                                                            <?php if ($today >= $row->m_booking_start && $today <= $row->m_booking_end) { ?>
                                                                <span class="info-box-icon bg-danger"><i class="fa fa-bookmark" placeholder="sdf"></i></span>
                                                            <?php } elseif ($today <= $row->m_booking_start) { ?>
                                                                <span class="info-box-icon bg-warning"><i class="fa fa-bookmark"></i></span>
                                                            <?php } else { ?>
                                                                <span class="info-box-icon bg-success"><i class="fa fa-bookmark"></i></span>
                                                            <?php } ?>
                                                            <div class="info-box-content">
                                                                <span class="info-box-text" style="color:black"><?php echo $row->m_booking_room_name ?></span>
                                                                <span class="info-box-number" style="color:black"><?php echo $row->m_booking_PIC . ' (' . $row->m_booking_agenda . ')' ?></span>
                                                                <span class="info-box-text" style="color:black"><?php echo 'Mulai&nbsp&nbsp&nbsp&nbsp: ' . $row->m_booking_start ?></span>
                                                                <span class="info-box-text" style="color:black"><?php echo 'Selesai : ' . $row->m_booking_end ?></span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
            </div>
        </div>
    </body>

    </html>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->