<?php
include("sambungan.php");
include("pengundi_menu.php");

if(isset($_POST["submit"])) {
    $idpengundi = $_POST["idpengundi"];
    $password = $_POST["password"];
    $namapengundi = $_POST["namapengundi"];

    //C00 adalah calon yang kosong - menandakan pengundi belum mengundi
    $sql = "insert into pengundi values('$idpengundi', '$password', '$namapengundi', 'C00')";
    $result = mysqli_query($sambungan, $sql);

    if ($result) {
        echo "<script>alert('Berjaya signup')</script>";
        echo "<script>window.location='index.php'</script>";
    } else {
        echo "<script>alert('Tidak berjaya signup')</script>";
        echo "<h4>Ralat : $sql<br>".mysqli_error($sambungan)."</h4>";
    }
}
?>

<link rel="stylesheet" href="borang.css">
<link rel="stylesheet" href="button.css">

<body>
    <h3>SIGN UP</h3>
    <form name="borang" action="signup.php" method="post">
        <table>
            <tr>
                <td class="saiz">ID Pengundi</td>
                <td><input type="text" name="idpengundi" placeholder="cth: U065"></td>
            </tr>
            <tr>
                <td class="saiz">Nama Pengundi</td>
                <td><input required type="text" name="namapengundi" placeholder="Cth: Fatimah"></td>
            </tr>
            <tr>
                <td class="saiz">Password</td>
                <td><input required type="password" name="password" placeholder="Cth: 12345"></td>
            </tr>
        </table>
        <button class="tambah" type="submit" name="submit" onclick="return semak()">Daftar</button>
        <button class="batal" type="button" onclick="window.location='index.php'">Batal</button>
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

        // Semak had bawah dan had atas
        if (idpengundi.length !== 4) {
            alert("IDPengundi mesti tepat 4 aksara");
            return false;
        }
        
        // Jika semua ok, submit form
        borang.submit();
    }

    function ubahSaiz(saiz) {
        var elemen = document.getElementsByClassName("saiz");
        for (var i = 0; i < elemen.length; i++) {
            elemen[i].style.fontSize = saiz + "px";
        }
    }
    </script>
</body>