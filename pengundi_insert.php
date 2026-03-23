<?php
include("sambungan.php");
include("admin_menu.php");

if (isset($_POST["submit"])) {
    $idpengundi = $_POST["idpengundi"];
    $password = $_POST["password"];
    $namapengundi = $_POST["namapengundi"];

    // 'C00' adalah calon yang kosong - menandakan pengundi belum mengundi
    $sql = "insert into pengundi values('$idpengundi', '$password', '$namapengundi', 'C00')";
    $result = mysqli_query($sambungan, $sql);

    if ($result == true) 
        echo "<h4>Berjaya tambah</h4>";
     else 
        echo "<h4>Ralat : $sql<br>".mysqli_error($sambungan)."</h4>";
    
}
?>

<link rel="stylesheet" href="borang.css">
<link rel="stylesheet" href="button.css">

<h3>BORANG TAMBAH PENGUNDI</h3>
<form name="borang" action="pengundi_insert.php" method="post">
    <table>
        <tr>
            <td class="saiz">ID Pengundi</td>
            <td><input type="text" name="idpengundi" placeholder="cth: U065"></td>
        </tr>
        <tr>
            <td class="saiz">Nama Pengundi</td>
            <td><input type="text" name="namapengundi" placeholder="cth: Hajar"></td>
        </tr>
        <tr>
            <td class="saiz">Password</td>
            <td><input type="text" name="password" placeholder="cth: 123"></td>
        </tr>
    </table>
    <button class="tambah" type="submit" name="submit" onclick="return semak()">Tambah</button>
</form>

<br>
<center>
    <p class="saiz">Ubah saiz</p>
    <input type="range" min="14" max="30" value="14" oninput="ubahSaiz(this.value)">
</center>

<script>
function semak() {
    var borang = document.forms["borang"];
    var idpengundi = borang["idpengundi"].value.trim();

    // Semak had bawah dan had atas (ID 必须正好是 4 位字符)
    if (idpengundi.length !== 4) {
        alert("IDPengundi mesti tepat 4 aksara");
        return false;
    }

    // Jika semua ok, submit form
    alert("Berjaya semak!");
    borang.submit();
}

function ubahSaiz(saiz) {
    var elemen = document.getElementsByClassName("saiz");
    for (var i = 0; i < elemen.length; i++) {
        elemen[i].style.fontSize = saiz + "px";
    }
}
</script>