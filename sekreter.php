<?php
include "./components/head.php";
include "./components/sekreter_navbar.php";
include "./lib/connect.php";

?>

<table class="table table-primary container table-hover">
    <thead>
        <tr>
            <th scope="col">TC</th>
            <th scope="col">Hasta Adı</th>
            <th scope="col">Hasta Soyadı</th>
            <th scope="col">Hasta Telefon Numarası</th>
            <th scope="col">Muane Durumu</th>
            <th scope="col">Doktor Seçimi</th>
        </tr>
    </thead>
    <tbody>

        <?php
        include "./lib/connect.php";

        // Bugünün tarihini al
        date_default_timezone_set('Europe/Istanbul');
        $bugunun_tarihi = date("Y-m-d");

        // Bekleyen hastalar için sorgu
        $sql = "SELECT hasta_kayit.id, hasta_kayit.tc_no, hasta_kayit.isim, hasta_kayit.soyisim, hasta_kayit.telefon, kullanıcılar.ad AS doktor_ad 
              FROM hasta_kayit 
              JOIN kullanıcılar ON hasta_kayit.doktor_id = kullanıcılar.id 
              WHERE DATE(hasta_kayit.tarih) = ? AND hasta_kayit.durum = 0";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $bugunun_tarihi);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr class="table-warning ">';
                echo "<th>" . $row["tc_no"] . "</th>";
                echo "<th>" . $row["isim"] . "</th>";
                echo "<th>" . $row["soyisim"] . "</th>";
                echo "<th>" . $row["telefon"] . "</th>";
                echo "<th class='text-success'>Bekliyor</th>";
                echo "<th>" . $row["doktor_ad"] . "</th>";
                echo "</tr>";
            }
        } else {
            echo '<tr class="table-warning"><td colspan="6" class="text-center fs-5 fw-bold text-secondary">Bugün için bekleyen hasta bulunmamaktadır.</td></tr>';
        }

        $stmt->close();

        // Muayene edilmiş hastalar için sorgu
        $sql = "SELECT hasta_kayit.id, hasta_kayit.tc_no, hasta_kayit.isim, hasta_kayit.soyisim, hasta_kayit.telefon, kullanıcılar.ad AS doktor_ad 
        FROM hasta_kayit 
        JOIN kullanıcılar ON hasta_kayit.doktor_id = kullanıcılar.id 
        WHERE DATE(hasta_kayit.tarih) = ? AND hasta_kayit.durum = 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $bugunun_tarihi,);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr class="table-danger">';
                echo "<th>" . $row["tc_no"] . "</th>";
                echo "<th>" . $row["isim"] . "</th>";
                echo "<th>" . $row["soyisim"] . "</th>";
                echo "<th>" . $row["telefon"] . "</th>";
                echo "<th class='text-secondary'>Muayene Edildi</th>";
                echo "<th>" . $row["doktor_ad"] . "</th>";
                echo "</tr>";
            }
        } else {
            echo '<tr class="table-danger"><td colspan="6" class="text-center fs-5 fw-bold text-secondary">Bugün için muayene edilmiş hasta bulunmamaktadır.</td></tr>';
        }

        $stmt->close();

        // Veritabanı bağlantısını kapat
        $conn->close();
        ?>

    </tbody>
</table>