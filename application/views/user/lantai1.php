<!-- Begin Page Content -->
<html>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item active">Status Ruangan</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

    <div class="card-title">
        <h>Keterangan :</h>
        <button class="btn btn-primary">Available</button>
        <button class="btn btn-danger">Used</button>
        <button class="btn btn-warning">Booked</button>
    </div>

    <div class="navbar-form navbar-right col-sm-6">

    </div>

    <div class="row">
        <div class="col-md-12">
            <section>
                <h1 class="text-center">DAFTAR JADWAL KELAS LANTAI 1</h1>
                <?php echo form_open() ?>
                <div class="input-group mb-3">
                    <input type="text" name="yangdicari" class="form-control" placeholder="Cari..">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit" id="button-addon2">Cari</button>
                    </div>
                </div>
                <?php echo form_close() ?>
                <!-- <input type="text" name="yangdicari" id="">
        <input type="submit" value="Cari"> -->

                <!-- <div class="tbl-header"> -->
                <table class="table table-bordered table-hover">
                    <thead class="table-primary">
                        <tr align="center">
                            <th>No</th>
                            <th>Nama Ruangan</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Agenda</th>
                            <th>Penanggung Jawab</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        <?php if (empty($roomuser)) : ?>
                            <tr>
                                <td colspan="7">
                                    <div class="alert alert-danger" role="alert">
                                        Data Tidak Ditemukan!
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php
                        $no = 1;
                        foreach ($roomuser as $tblcontent) :
                            $today = date('Y-m-d H:i:s');
                        ?>

                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $tblcontent->m_booking_room_name ?></td>
                                <?php if ($tblcontent->m_booking_start != "0000-00-00 00:00:00") { ?>
                                    <td><?php echo $tblcontent->m_booking_start ?></td>
                                <?php } else { ?>
                                    <td></td>
                                <?php } ?>
                                <?php if ($tblcontent->m_booking_start != "0000-00-00 00:00:00") { ?>
                                    <td><?php echo $tblcontent->m_booking_end ?></td>
                                <?php } else { ?>
                                    <td></td>
                                <?php } ?>
                                <td><?php echo $tblcontent->m_booking_agenda ?></td>
                                <td><?php echo $tblcontent->m_booking_PIC ?></td>
                                <td><?php if ($today >= $tblcontent->m_booking_start && $today <= $tblcontent->m_booking_end) { ?>
                                        <button type="submit" class="badge badge-danger">Used</button>
                                    <?php } elseif ($today <= $tblcontent->m_booking_start) { ?>
                                        <button type="submit" class="badge badge-warning">Booked</button>
                                    <?php } else { ?>
                                        <button type="submit" class="badge badge-primary">Available</button>
                                    <?php } ?></td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- </div> -->
            </section>
        </div>
    </div>
</div>

</html>