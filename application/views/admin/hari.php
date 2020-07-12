<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item active">Booking Room</li>&nbsp /&nbsp;
                    <a href="<?= base_url('admin/tambahruangan') ?>">
                        <li class="breadcrumb-item primary">Tambah Ruangan</li>
                    </a>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <div class="row">
        <div class="card-title">
            <h>Keterangan :</h>
            <button class="btn btn-primary">Available</button>
            <button class="btn btn-danger">Used</button>
            <button class="btn btn-warning">Booked</button>
        </div>
        &nbsp; &nbsp; &nbsp;
        <div class="card-title">
            <?php $senin = "Wednesday" ?>
            <a href="<?= base_url('admin/sortirhari/' . $senin) ?>">
                <a href="<?= base_url('admin/sortirhari/' . $selasa) ?>">
                    <a href="<?= base_url('admin/sortirhari/' . $rabu) ?>">
                        <a href="<?= base_url('admin/sortirhari/' . $kamis) ?>">
                            <a href="<?= base_url('admin/sortirhari/' . $jumat) ?>">
                                <a href="<?= base_url('admin/sortirhari/' . $sabtu) ?>">

                                    <button class="btn btn-primary">Senin</button></a>
                                <button class="btn btn-primary">Selasa</button>
                                <button class="btn btn-primary">Rabu</button>
                                <button class="btn btn-primary">Kamis</button>
                                <button class="btn btn-primary">Jumat</button>
                                <button class="btn btn-primary">Sabtu</button>
        </div>
    </div>

    <div class="row">

        <?php
        foreach ($room as $row) {
            $date = date_default_timezone_set('Asia/Jakarta');
            $today = date('Y-m-d H:i:s');
        ?>


            <!-- Earnings (Monthly) Card Example -->

            <div class="col-xl-3 col-md-6 mb-4">
                <?php if ($today >= $row->m_booking_start && $today <= $row->m_booking_end) { ?>
                    <div class="card border-left-danger shadow h-100 py-2">
                    <?php } elseif ($today <= $row->m_booking_start) { ?>
                        <div class="card border-left-warning shadow h-100 py-10">
                        <?php } else { ?>
                            <div class="card border-left-primary shadow h-100 py-2">
                            <?php } ?>
                            <a href="<?php echo base_url('admin/addbooking/') . $row->m_booking_id ?>">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo $row->m_booking_room_name ?></div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo 'Mulai&nbsp&nbsp&nbsp&nbsp: ' . $row->m_booking_start ?></div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo 'Selesai : ' . $row->m_booking_end ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row->m_booking_PIC . ' (' . $row->m_booking_agenda . ')' ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            </a>

                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                    <?php } ?>
                    </div>
            </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->