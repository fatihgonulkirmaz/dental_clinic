<?php

include "./components/head.php";
include "./components/doktor_navbar.php";
include "./lib/connect.php";
// Get the patient ID from the URL
$patient_id =  $_GET['id'];

if ($patient_id) {
    $sql = "SELECT id, tc_no, isim, soyisim, tarih, email, telefon, doktor_id, adres, durum FROM hasta_kayit WHERE id = $patient_id;";
    $sonuc = $conn->query($sql);

    if ($sonuc) {
        // Sonucu al
        $row = $sonuc->fetch_assoc();
        $Hasta_adı = $row["isim"];
        $Hasta_soyisim = $row["soyisim"];
        $Hasta_telefon = $row["telefon"];
        $Hasta_tc = $row["tc_no"];
    } else {
        echo "Sorgu başarısız: " . $conn->error;
    }
} else {
    echo "Geçersiz hasta ID.";
}

// Bağlantıyı kapat
$conn->close();
?>


<section class="px-4 w-100 h-100">
    <h1 class="text-center text-danger fw-bold">Hasta Muayene Formu</h1>

    <form action="" method="post">

        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">TC</th>
                    <th scope="col">Hasta Adı</th>
                    <th scope="col">Hasta Soyadı</th>
                    <th scope="col">Hasta Telefon Numarası</th>
                    <th scope="col">Muane Durumu</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php

                    echo '<tr class="table-warning">';
                    echo "<th>" . $Hasta_tc . "</th>";
                    echo "<th>" . $Hasta_adı . "</th>";
                    echo "<th>" . $Hasta_soyisim . "</th>";
                    echo "<th>" . $Hasta_telefon . "</th>";
                    echo "<th class='text-success'>Muane Ediliyor</th>";
                    echo "</tr>";
                    ?>
                </tr>
            </tbody>
        </table>


    </form>
</section>

<section class="px-4 w-100 h-100">
    <h1 class="text-center text-danger fw-bold"></h1>

    <form action="hasta_islem.php?id=<?php echo $patient_id ?>" method="post">

        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">İşlem</th>
                    <th scope="col">Açıklama</th>
                    <th scope="col">Fiyat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "./lib/connect.php";
                $sql = "SELECT * FROM `tedavi` WHERE 1";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();




                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr">';
                        echo '<td> <input type="checkbox" name="tedavi[]" value="' . $row["id"] . '" id=""> </td>';
                        echo "<td>" . $row["islem"] . "</td>";
                        echo "<td>" . $row["aciklama"] . "</td>";
                        echo "<td>" . $row["fiyat"] . "</td>";


                        echo "</tr>";
                    }
                } else {
                    echo '<tr class="table-warning"><td colspan="6"  class="text-center fs-5 fw-bold text-secondary">Bugün için bekleyen hasta bulunmamaktadır.</td></tr>';
                }

                ?>

            </tbody>
        </table>
        <input type="submit" class="btn btn-outline-success" value="Muane Tamamla">
    </form>
</section>