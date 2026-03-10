<?php
include("sambungan.php");

$idpengundi = $_GET["idpengundi"];

$sql = "delete from pengundi where idpengundi = '$idpengundi'";
$result = mysqli_query($sambungan, $sql);

echo "<script>window.location='pengundi_senarai.php'</script>";
?>