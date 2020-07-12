<?php
$connect = mysqli_connect("localhost", "root", "", "");
?>
<!DOCTYPE html>
<html>

<head>
    <title>index</title>
</head>

<body>
    <center>
        <form method="get">
            <input type="date" name="date1">
            <input type="date" name="date2">
            <input type="submit" name="filter" value="filter">
            <a href="index.php">reset</a>
        </form>
        <br><br><br>
        <table border="1">
            <tr>
                <th>tanggal</th>
                <th>nama</th>
                <th>jumlah</th>
            </tr>
            <?php

            if (isset($_GET['date1']) and empty($_GET['date2'])) {
                $date1 = $_GET['date1'];
                $s = mysqli_query($connect, "select * from barang_masuk where tanggal = '" . $date1 . "'");
            } elseif (isset($_GET['date1']) and isset($_GET['date2'])) {
                $date1 = $_GET['date1'];
                $date2 = $_GET['date2'];
                $s = mysqli_query($connect, "SELECT * FROM barang_masuk 
						WHERE tanggal BETWEEN  '" . $date1 . "' AND '" . $date2 . "' order by tanggal desc");
            } else {
                $s = mysqli_query($connect, "select * from barang_masuk order by tanggal desc");
            }
            while ($r = mysqli_fetch_array($s)) {
            ?>
                <tr>
                    <td><?php echo ($r['tanggal']); ?></td>
                    <td><?php echo ($r['nama']); ?></td>
                    <td><?php echo ($r['jumlah']); ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </center>
</body>

</html>