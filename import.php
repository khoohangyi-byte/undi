<?php
include("sambungan.php");
include("admin_menu.php");

if (isset($_POST["submit"])) {
$namajadual = $_POST["namajadual"];
$namafail = $_FILES["namafail"]["name"];
$sementara = $_FILES["namafail"]["tmp_name"];
move_uploaded_file($sementara, $namafail);

$fail = fopen($namafail, "r");
while (!feof($fail)) {
$medan = explode(",", fgets($fail));
$berjaya = false;

if (strtolower($namajadual) === "pengundi")
{
$idpengundi = $medan[0];
$password = $medan[1];
$namapengundi = $medan[2];
$idcalon = $medan[3];
$sql = "insert into pengundi values('$idpengundi',
'$password', '$namapengundi', '$idcalon')";
if (mysqli_query($sambungan, $sql))
$berjaya = true;
else
echo "<br><center>Ralat:
$sql<br>".mysqli_error($sambungan)."</center>";
}

if (strtolower($namajadual) === "admin")
{
$idadmin = $medan[0];
$password = $medan[1];
$namaadmin = $medan[2];
$sql = "insert into admin values('$idadmin', '$password',


 '$namaadmin')";
if (mysqli_query($sambungan, $sql))
$berjaya = true;
else
echo "<br><center>Ralat:
$sql<br>".mysqli_error($sambungan)."</center>";
}
}
if ($berjaya == true)
echo "<script>alert('Rekod berjaya di import');</script>";

else
echo "<script>alert('Rekod tidak berjaya di import');</script>";
mysqli_close($sambungan);

}

?>

<link rel="stylesheet" href="borang.css">
<link rel="stylesheet" href="button.css">

<h3>IMPORT

DATA</h3>
<form action="import.php" method="post"
enctype="multipart/form-data">
<table>
<tr>

<td>Jadual</td>
<td>
<select name="namajadual">
<option>Pengundi</option>
<option>Admin</option>
</select>
</td>
</tr>
<tr>

<td>Nama fail</td>
<td><input required type="file" name="namafail" accept=".txt, .csv"></td>

</tr>
</table>
<button class="import" type="submit" name="submit">Import</button>
</form>