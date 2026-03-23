<?php
include("sambungan.php");
include("pengundi_menu.php");

echo "<link rel='stylesheet' href='button.css'>";
echo "<main>";

$sql = "select * from calon";
$result = mysqli_query($sambungan, $sql);

if (isset($_SESSION["idpengguna"])) {
    $idpengundi = $_SESSION["idpengguna"];
    echo "<form method='post' action='pengundi_undi.php'>";
    echo "<div class=gambar>";
    
    while($calon = mysqli_fetch_array($result)) {
        if ($calon['idcalon'] != 'C00') {
            echo "<figure>
                    <img class='home' src='imej/$calon[gambar]'>
                    <figcaption>
                        <input type=hidden name=idpengundi value=$idpengundi>
                        <input type=radio name=idcalon value=$calon[idcalon]>
                    </figcaption>
                  </figure>";
        }
    }
    echo "</div>";

    $sudah_mengundi = false;

    $sql = "select * from pengundi 
            join calon on pengundi.idcalon = calon.idcalon";

    $result = mysqli_query($sambungan, $sql);
    while($undian = mysqli_fetch_array($result)) {
        if ($undian['idpengundi'] == $idpengundi && $undian['idcalon'] != "C00") {
            $namacalon = $undian['namacalon'];
            $sudah_mengundi = true;
            break;
        }
    }

    if ($sudah_mengundi == true) 
        echo "<center>
                <p class='arahan'>Status : Anda telah mengundi $namacalon</p>
              </center>
              </form>";
     else 
        echo "<center>
                <p class='arahan'>Status : belum mengundi, Pilih calon yang sesuai dan klik butang undi</p>
                <button class='tambah' type='submit' name='submit'>Undi</button>
              </center>
              </form>";
    }
 else {
    echo "<div class=gambar>";
    while ($calon = mysqli_fetch_array($result)) {
        if ($calon['idcalon'] != 'C00') 
            echo "<figure><img class='home' src='imej/$calon[gambar]'></figure>";
        }
    
    echo "</div>";
}
echo "</main>";
?>