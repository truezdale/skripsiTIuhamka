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
              <li class="breadcrumb-item"><a href="<?php echo site_url('Room/Room/room') ?>">Home</a></li>
              <li class="breadcrumb-item active">Booking Room</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-sm-8">
          <div class="card card-primary">
             <?php foreach ($data as $row) { ?>
                <div class="card-header">
                  <h3 class="card-title"><?php echo $row->m_booking_room_name; ?></h3>
                </div>
                <form  method="POST" action="<?php echo base_url('Room/Room/booking_room_proses/').$row->m_booking_id;?>">
                  <div class="card-body">
                    <div class="col-sm-4">
                      <label for="exampleInputEmail1">Jam Mulai</label>
                      <input type="datetime-local" name="m_booking_start" class="form-control">
                    </div>
                     <div class="col-sm-4">
                      <label for="exampleInputPassword1">Jam Selesai</label>
                      <input type="datetime-local" name="m_booking_end" class="form-control">
                    </div>
                     <div class="col-sm-8">
                      <label for="exampleInputEmail1">Agenda</label>
                      <input type="text" name="m_booking_agenda" class="form-control">
                    </div>
                     <div class="col-sm-8">
                      <label for="exampleInputPassword1">PIC</label>
                      <input type="text" name="m_booking_PIC" class="form-control">
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
      <div class="col-sm-4">
        <div class="card card-primary">
           <?php foreach ($data as $row) { ?>
              <div class="card-header">
                <h3 class="card-title">Previous User</h3>
              </div>
                <div class="card-body">
                  <div class="col-sm-12">
                    <table style="width: 100%;">
                    <tr>
                    <td><b>Jam Mulai</b></td>
                    <td> : </td>
                    <td><?php echo $row->m_booking_start; ?></td>
                    </tr>
                    <tr>
                    <td><b>Jam Selesai</b></td>
                    <td> : </td>
                    <td><?php echo $row->m_booking_end; ?></td>
                    </tr>
                    <tr>
                    <td><b>Agenda</b></td>
                    <td> : </td>
                    <td><?php echo $row->m_booking_agenda; ?></td>
                    </tr>
                    <tr>
                    <td><b>PIC</b></td>
                    <td> : </td>
                    <td><?php echo $row->m_booking_PIC; ?></td>
                    </tr>
                    </table>
                </div>
            <?php } ?>
            </div>
      </div>
    </div>
    </div>
    <!-- /.container-fluid -->
  </section>
</body>
</html>
