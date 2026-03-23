<?php
include("sambungan.php");
include("admin_menu.php");

?>

<link rel="stylesheet" href="senarai.css">
<link rel="stylesheet" href="button.css">

<main>
<div id="printarea">
<?php
if (isset($_POST['submit'])) {
$pilih = $_POST['pilih'];

$sql = "select calon.idcalon, namacalon, count(*)
as jum_ikut_calon from pengundi
join calon on pengundi.idcalon = calon.idcalon
group by idcalon order by jum_ikut_calon desc";

$result = mysqli_query($sambungan, $sql);

if ($pilih == 1) {
echo "<table>
<tr>

<th>ID</th>
<th>Nama</th>
<th>Jumlah undi</th>
</tr>";

while($undian = mysqli_fetch_array($result))
{
if ($undian['idcalon'] != 'C00') {
echo "<tr> <td>$undian[idcalon]</td>
<td>$undian[namacalon]</td>
<td>$undian[jum_ikut_calon]</td>
</tr>";

}
}


echo "<caption><img src='imej/tajuk.png' width=400><br>
SENARAI CALON MENGIKUT BILANGAN UNDI</caption></table>";

}

if ($pilih == 2) {

$sql_undi = "select * from pengundi where idcalon != 'C00'
";
$result_undi = mysqli_query($sambungan, $sql_undi);
$jum_semua_undi = mysqli_num_rows($result_undi);

echo "<table>
<tr>
<th>ID</th>
<th>Nama</th>
<th>Carta</th>
<th>Peratus</th>
</tr>";

while ($undian = mysqli_fetch_array($result)) {

$peratus_belum_format =
$undian['jum_ikut_calon']/$jum_semua_undi*100;
$peratus = number_format($peratus_belum_format, 1);
if ($undian['idcalon'] != 'C00')
{
echo "<tr> <td>$undian[idcalon]</td>
<td>$undian[namacalon]</td>
<td><progress value=$peratus max=100></progress></td>

<td>$peratus%</td>
</tr>";

}
}
echo

"<caption><img src='imej/tajuk.png' width=400><br>
SENARAI CALON MENGIKUT PERATUS UNDI</caption></table>";

}
}

?>

</div>
<center><button class="cetak" onclick="printPageArea()">Cetak</button></center>
</main>

<script>
function printPageArea(){
var printContent = document.getElementById("printarea").innerHTML;
var originalContent = document.body.innerHTML;
document.body.innerHTML = printContent;
window.print();
document.body.innerHTML = originalContent;

}

</script>