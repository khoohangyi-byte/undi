<?php
include("sambungan.php");
include("pengundi_menu.php");
?>

<link rel="stylesheet" href="senarai.css">

<table>
    <caption>SENARAI CALON</caption>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Gambar</th>
        <th>Moto</th>
    </tr>

    <?php
    $sql = "select * from calon";
    $result = mysqli_query($sambungan, $sql);
    while($calon = mysqli_fetch_array($result)) {
        if ($calon['idcalon'] != 'C00') {
            echo "<tr>
                    <td>$calon[idcalon]</td>
                    <td>$calon[namacalon]</td>
                    <td><img width=100 src='imej/$calon[gambar]'></td>
                    <td>$calon[moto]</td>
                  </tr>";
        }
    }
    ?>
</table>