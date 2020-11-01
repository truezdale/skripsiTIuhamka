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
                <h1 class="text-center">DAFTAR RUANGAN LANTAI 4</h1>
                <div class="mb-2">
                    <input type="checkbox" aria-label="Checkbox for following text input" id="keywordRuangan"> Ruangan Dll
                    <input type="checkbox" aria-label="Checkbox for following text input" id="keywordTanggal"> Tanggal
                </div>
                <!-- <div class="input-group" id="tanggal" hidden>
                    <input type="text" class="form-control" name="keyword" id="keyword">
                    <input type="text" name="yangdicari" class="form-control" placeholder="Cari.." id="ruangan">
                    <input type="datetime-local" name="m_booking_start" class="form-control" id="tanggal" hidden>
                    <input type="datetime-local" class="form-control" name="keyword" id="keywordTime">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary">Cari</button>
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Filter Pencarian</span>
                        </button>
                        <div class="dropdown-menu">
                            <button type="button" class="dropdown-item" id="itemTime">Tanggal & Jam</button>
                        </div>
                    </div>
                </div> -->
                <div class="keywordcary" id="ruangan">
                    <form action="<?php echo base_url('user/cariLantai4'); ?>" method="post">
                        <div class="input-group mb-3">
                            <input type="text" name="keyword_a" class="form-control" placeholder="Cari.." autofocus autocomplete="off">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit" id="button-addon2">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="keywordtanggal" id="tanggal">
                    <form action="<?php echo base_url('user/cariTanggal4'); ?>" method="post">
                        <div class="input-group mb-3">
                            <input type="datetime-local" name="keyword_b" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit" id="button-addon2">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
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
                            // $today = date('Y-m-d H:i:s');
                        ?>

                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $tblcontent->m_booking_room_name ?></td>
                                <?php if ($tblcontent->m_booking_start != "0000-00-00 00:00:00") : ?>
                                    <td><?php echo timeIndo($tblcontent->m_booking_start) ?></td>
                                <?php else : ?>
                                    <td></td>
                                <?php endif; ?>
                                <?php if ($tblcontent->m_booking_start != "0000-00-00 00:00:00") : ?>
                                    <td><?php echo timeIndo($tblcontent->m_booking_end) ?></td>
                                <?php else : ?>
                                    <td></td>
                                <?php endif; ?>
                                <td><?php echo $tblcontent->m_booking_agenda ?></td>
                                <td><?php echo $tblcontent->m_booking_PIC ?></td>
                                <td><?php if (date('Y-m-d H:i:s') >= $tblcontent->m_booking_start && date('Y-m-d H:i:s') <= $tblcontent->m_booking_end) : ?>
                                        <button type="submit" class="badge badge-danger">Used</button>
                                    <?php elseif (date('Y-m-d H:i:s') <= $tblcontent->m_booking_start) : ?>
                                        <button type="submit" class="badge badge-warning">Booked</button>
                                    <?php else : ?>
                                        <button type="submit" class="badge badge-primary">Available</button>
                                    <?php endif; ?></td>
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