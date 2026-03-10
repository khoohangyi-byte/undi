<?php
include("sambungan.php");
include("admin_menu.php");
?>

<link rel="stylesheet" href="senarai.css">
<table>
    <caption>SENARAI NAMA PENGUNDI</caption>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Password</th>
        <th colspan="2">Tindakan</th>
    </tr>

    <?php
    $sql = "select * from pengundi";
    $result = mysqli_query($sambungan, $sql);
    while($pengundi = mysqli_fetch_array($result)) {
        $idpengundi = $pengundi["idpengundi"];
        echo "<tr>
                <td>$pengundi[idpengundi]</td>
                <td class='nama'>$pengundi[namapengundi]</td>
                <td>$pengundi[password]</td>
                <td>
                    <a href='pengundi_update.php?idpengundi=$idpengundi'>
                        <img src='imej/refresh.png'>
                    </a>
                </td>
                <td>
                    <a href='javascript:padam(\"$idpengundi\");'>
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
        window.location = "pengundi_delete.php?idpengundi=" + id;
    }
}
</script>