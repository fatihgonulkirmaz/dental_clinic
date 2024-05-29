<?php

// Veritabanı bağlantısını ve gerekli bileşenleri dahil et
include "./lib/connect.php";
include "./components/head.php";
include "./components/doktor_navbar.php";
?>

<br>

<!-- Hastalar tablosunu oluştur -->
<table class="table table-primary container">
    <thead>
        <tr>
            <th scope="col">TC</th>
            <th scope="col">Hasta Adı</th>
            <th scope="col">Hasta Soyadı</th>
            <th scope="col">Hasta Telefon Numarası</th>
            <th scope="col">Muane Durumu</th>
            <th scope="col">Muane Et</th>
        </tr>
    </thead>
    <tbody>

    <?php
        // Veritabanı bağlantısını tekrar dahil et
        include "./lib/connect.php";

        // Zaman dilimini ayarla ve bugünün tarihini al
        date_default_timezone_set('Europe/Istanbul'); // Türkiye'nin zaman dilimini ayarla
        $bugunun_tarihi = date("Y-m-d"); // Bugünün tarihini al
        $user_id = $_SESSION['user_id']; // Oturumdaki kullanıcı id'sini al

        // Bekleyen hastalar için SQL sorgusu
        $sql = "SELECT id, tc_no, isim, soyisim, telefon FROM hasta_kayit WHERE DATE(tarih) = ? AND durum = 0 AND doktor_id = ?"; // Bekleyen hastaların bilgilerini seç
        $stmt = $conn->prepare($sql); // Sorguyu hazırlama
        $stmt->bind_param("si", $bugunun_tarihi, $user_id); // Parametreleri bağla: bugünün tarihi ve kullanıcı id'si

        // Sorguyu çalıştır ve sonucu al
        $stmt->execute(); // Sorguyu çalıştır
        $result = $stmt->get_result(); // Sonuçları al

        // Eğer bekleyen hasta varsa, tabloya ekle
        if ($result->num_rows > 0) { // Sonuçlarda bekleyen hasta var mı kontrol et
            while ($row = $result->fetch_assoc()) { // Sonuçları satır satır al
                echo '<tr class="table-warning">'; // Tablo satırını başlat, bekleyen hasta için sarı renk
                echo "<th>" . $row["tc_no"] . "</th>"; // Hasta TC numarasını tabloya ekle
                echo "<th>" . $row["isim"] . "</th>"; // Hasta adını tabloya ekle
                echo "<th>" . $row["soyisim"] . "</th>"; // Hasta soyadını tabloya ekle
                echo "<th>" . $row["telefon"] . "</th>"; // Hasta telefon numarasını tabloya ekle
                echo "<th class='text-success'>Bekliyor</th>"; // Muayene durumu: Bekliyor
                echo '<td><a href="./hasta.php?id=' . $row["id"] . '" class="btn btn-success">Muane Et</a></td>'; // "Muayene Et" butonu ekle
                echo "</tr>"; // Tablo satırını kapat
            }
        } else {
            // Eğer bekleyen hasta yoksa, bilgilendirme mesajı göster
            echo '<tr class="table-warning"><td colspan="6" class="text-center fs-5 fw-bold text-secondary">Bugün için bekleyen hasta bulunmamaktadır.</td></tr>'; // Bilgilendirme mesajı
        }

        // SQL sorgusunu kapat
        $stmt->close(); // Sorguyu kapat

        // Muayene edilmiş hastalar için SQL sorgusu
        $sql = "SELECT id, tc_no, isim, soyisim, telefon FROM hasta_kayit WHERE DATE(tarih) = ? AND durum = 1 AND doktor_id = ?"; // Muayene edilmiş hastaların bilgilerini seç
        $stmt = $conn->prepare($sql); // Sorguyu hazırlama
        $stmt->bind_param("si", $bugunun_tarihi, $user_id); // Parametreleri bağla: bugünün tarihi ve kullanıcı id'si
        $stmt->execute(); // Sorguyu çalıştır
        $result = $stmt->get_result(); // Sonuçları al

        // Eğer muayene edilmiş hasta varsa, tabloya ekle
        if ($result->num_rows > 0) { // Sonuçlarda muayene edilmiş hasta var mı kontrol et
            while ($row = $result->fetch_assoc()) { // Sonuçları satır satır al
                echo '<tr class="table-danger">'; // Tablo satırını başlat, muayene edilmiş hasta için kırmızı renk
                echo "<th>" . $row["tc_no"] . "</th>"; // Hasta TC numarasını tabloya ekle
                echo "<th>" . $row["isim"] . "</th>"; // Hasta adını tabloya ekle
                echo "<th>" . $row["soyisim"] . "</th>"; // Hasta soyadını tabloya ekle
                echo "<th>" . $row["telefon"] . "</th>"; // Hasta telefon numarasını tabloya ekle
                echo "<th class='text-secondary'>Muayene Edildi</th>"; // Muayene durumu: Muayene Edildi
                echo '<td><a href="./hasta.php?id=' . $row["id"] . '" class="btn btn-success disabled" aria-disabled="true">Muane Et</a></td>'; // "Muayene Et" butonu (devre dışı)
                echo "</tr>"; // Tablo satırını kapat
            }
        } else {
            // Eğer muayene edilmiş hasta yoksa, bilgilendirme mesajı göster
            echo '<tr class="table-danger"><td colspan="6" class="text-center fs-5 fw-bold text-secondary">Bugün için muayene edilmiş hasta bulunmamaktadır.</td></tr>'; // Bilgilendirme mesajı
        }

        // SQL sorgusunu kapat
        $stmt->close(); // Sorguyu kapat

        // Veritabanı bağlantısını kapat
        $conn->close(); // Veritabanı bağlantısını kapat
        ?>


<!-- JavaScript ve Bootstrap dosyalarını dahil et -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
