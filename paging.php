<html>
<title>Paging</title>

<body>

<?php
$konek = mysqli_connect("localhost","root","","paging1");
$batas   = 5;
$halaman = @$_GET['halaman'];
if(empty($halaman)){
	$posisi  = 0;
	$halaman = 1;
}
else{ 
  $posisi  = ($halaman-1) * $batas; 
}
$query  = "SELECT * FROM tb_masjid LIMIT $posisi,$batas";
$tampil = mysqli_query($konek, $query);

echo "<table>
      <tr><th>No</th><th>Nama</th><th>Alamat</th></tr>";

$no = $posisi+1;
while ($data=mysqli_fetch_array($tampil)){
  echo "<tr>
          <td>$no</td>
          <td>$data[nama]</td>
          <td>$data[alamat]</td>
        </tr>";
  $no++;
} 
echo "</table>";
$query2     = mysqli_query($konek, "select * from tb_masjid");
$jmldata    = mysqli_num_rows($query2);
$jmlhalaman = ceil($jmldata/$batas);

echo "<br> Halaman : ";

for($i=1;$i<=$jmlhalaman;$i++)
if ($i != $halaman){
	echo " <a href=\"paging.php?halaman=$i\">$i</a> | ";
}
else{ 
	echo " <b>$i</b> | "; 
}
echo "<p>Total tb_masjid : <b>$jmldata</b> orang</p>";
?>
