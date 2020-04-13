<?php
$date = date_default_timezone_set('Asia/Jakarta');
$today = date('Y-m-d H:i:s'); 
$conn = new mysqli('localhost', 'root', '', 'belajar');
if ($conn->connect_error) {
	die("Connection error: " . $conn->connect_error);
}
$query = $conn->query("SELECT * FROM siswa order by mulai desc limit 1");
$hasil = mysqli_fetch_assoc($query);

if ($query->num_rows > 0) {
	echo $today.'<br>'; 

	if ($today >= $hasil['mulai'] && $today <= $hasil['selesai']) {		
		?>	
		<div class="card">
			<div class="box">
				<h2><?php echo $hasil['nama']; ?><br><span><?php echo $hasil['kelas']; ?></span></h2>
				<p><?php echo 'Sedang ada <b>'.$hasil['kelas'].'</b> Dari <b>'.$hasil['mulai']. '</b> s/d <b>'.$hasil['selesai'].'</b>'; ?></p>
			</div>
		</div>
		<?php
	}else{
		?>
		<table border="1">
			<tr>
				<th>nama</th>
				<th>mulai</th>
				<th>selesai</th>
			</tr>
			<?php 
			$result = $conn->query("SELECT * FROM siswa");
			while ($row = $result->fetch_assoc()) { ?>
				<tr>
					<td><?php echo $row['nama']; ?></td>
					<td><?php echo $row['mulai']; ?></td>
					<td><?php echo $row['selesai']; ?></td>
				</tr>
				<?php
			}
			?>
		</table>
		<?php
	}
}
?>

