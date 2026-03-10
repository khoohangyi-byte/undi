<?php
include("sambungan.php");
include("admin_menu.php");
?>

<link rel="stylesheet" href="senarai.css">
<table>
    <caption>SENARAI NAMA ADMIN</caption>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Password</th>
        <th colspan="2">Tindakan</th>
    </tr>

    <?php
    $sql = "select * from admin";
    $result = mysqli_query($sambungan, $sql);
    while($admin = mysqli_fetch_array($result)) {
        $idadmin = $admin["idadmin"];
        echo "<tr> 
                <td>$admin[idadmin]</td>
                <td class='nama'>$admin[namaadmin]</td>
                <td>$admin[password]</td>
                <td>
                    <a href='admin_update.php?idadmin=$admin[idadmin]'>
                        <img src='imej/refresh.png'>
                    </a>
                </td>
                <td>
                    <a href='javascript:padam(\"$idadmin\");'>
                        <img src='imej/delete.png'>
                    </a>
                </td>
              </tr>";
    }
    ?>
</table>

<script>
function padam(id) {
    if (confirm("Adakah anda ingin padam") == true) {
        window.location = "admin_delete.php?idadmin=" + id;
    }
}
</script>