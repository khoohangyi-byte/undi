<?php
include("sambungan.php");

if (isset($_POST["submit"])) {
    $idpengundi = $_POST["idpengundi"];
    $idcalon = $_POST["idcalon"];

    $sudah_undi = false;

    // 检查该用户是否已经投过票 (假设 idcalon 初始值为 'C00' 表示未投票)
    $sql = "select * from pengundi where idpengundi = '$idpengundi'";
    $result = mysqli_query($sambungan, $sql);
    while($pengundi = mysqli_fetch_array($result)) {
        if ($pengundi['idcalon'] != 'C00') {
            $sudah_undi = true;
        }
    }

    if ($sudah_undi == false) {
        $sql = "update pengundi set idcalon = '$idcalon' 
                where idpengundi = '$idpengundi'";
        
        $result = mysqli_query($sambungan, $sql);
        if ($result == true) {
            echo "<script>alert('Berjaya Mengundi Calon')</script>";
        } else {
            echo "<h4>Ralat : $sql<br>" . mysqli_error($sambungan) . "</h4>";
        }
    } else {
        echo "<script>alert('Maaf! Anda sudah mengundi')</script>";
    }
}

echo "<script>window.location='index.php'</script>";
?>