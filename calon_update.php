<?php

/* fail calon_update.php perlu dipanggil
dari fail calon_senarai.php */

include("sambungan.php");
include("admin_menu.php");

if (isset($_POST["submit"])) {
$idcalon = $_POST["idcalon"];
$namacalon = $_POST["namacalon"];
$moto = $_POST["moto"];

$namafail = $idcalon.".png";
$sementara = $_FILES["namafail"]["tmp_name"];
move_uploaded_file($sementara, "imej/".basename($namafail));

$sql = "update calon set
namacalon = '$namacalon', gambar = '$namafail', moto = '$moto'
where idcalon = '$idcalon'";
$result = mysqli_query($sambungan, $sql);
if ($result == true)
echo "<h4>Berjaya kemaskini</h4>";


else
echo "<h4>Ralat : $sql<br>".mysqli_error($sambungan)."</h4>";
}

// idcalon dari fail calon_senarai.php
if (isset($_GET["idcalon"]))
$idcalon = $_GET["idcalon"];

$sql = "select * from calon where idcalon = '$idcalon'
";
$result = mysqli_query($sambungan, $sql);
while($calon = mysqli_fetch_array($result)) {
$namacalon = $calon["namacalon"];
$namafail = $idcalon.".png";
$moto = $calon["moto"];
}

?>

<link rel="stylesheet" href="borang.css">
<link rel="stylesheet" href="button.css">

<h3>KEMASKINI CALON</h3>
<form action="calon_update.php" method="post" enctype="multipart/form-data">
<table>

<tr>
<td>ID Calon</td>
<td><input type="text" name="idcalon" value="<?php echo $idcalon; ?>"></td>

</tr>
<tr>

<td>Nama Calon</td>
<td><input type="text" name="namacalon" value="<?php echo
$namacalon; ?>"></td>
</tr>
<tr>
<td class="warna">Gambar 350x320</td>
<td><input type="file" name="namafail"
accept=".png, .jpg">
<?php echo "<img width=100 src='imej/".$namafail."'>";?>
</td>
</tr>
<tr>



<td>Moto</td>
<td><input type="text" name="moto" value="<?php echo $moto; ?>"></td>

</tr>
</table>
<button class="update" type="submit" name="submit">Update</button>
</form>
