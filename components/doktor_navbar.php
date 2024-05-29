<nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
    <div class="container-fluid px-5">
        <div class="navbar-brand">
            <img src="resim/fatih-logo.png" width="60" height="60" class="d-inline-block align-top" alt="">
            <span class="fs-4 fw-bold">FatihDental</span>
        </div>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0"> <!-- Hoşgeldin yazısı için -->
                <li class="nav-item">
                    <span class="nav-link active fs-5"> Hoşgeldin <?php echo $_SESSION['user_name'] ?></span>
                </li>
            </ul>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                <li class="nav-item">
                    <span class="nav-link active text-success fs-5">
                        Günlük Toplam Hasta Sayısı:
                        <?php
                        include "./lib/connect.php"; // Veritabanı bağlantısını içe aktar

                        date_default_timezone_set('Europe/Istanbul'); // Zaman dilimini ayarla
                        $bugunun_tarihi = date("Y-m-d"); // Bugünün tarihini al
                        $sql = "SELECT COUNT(*) AS randevu_sayisi FROM hasta_kayit WHERE DATE(tarih) = '$bugunun_tarihi' and  doktor_id =" . $_SESSION['user_id']; // Bugünün toplam hasta sayısını sorgula

                        // Sorguyu çalıştır ve sonucu al
                        $result = $conn->query($sql); // Sorguyu çalıştır

                        if ($result) { // Eğer sorgu başarılıysa
                            // Sonucu al
                            $row = $result->fetch_assoc(); // Sonuçları bir dizi olarak al
                            $randevu_sayisi = $row["randevu_sayisi"]; // Toplam randevu sayısını al
                            echo $randevu_sayisi; // Ekrana yazdır
                        } else {
                            // Hata varsa hata mesajını yazdır
                            echo "Sorgu hatası: " . $conn->error; // Hata mesajını yazdır
                        }

                        // Bağlantıyı kapat
                        $conn->close(); // Veritabanı bağlantısını kapat
                        ?>
                    </span>
                </li>

                <li class="nav-item">
                    <span class="nav-link active text-warning fs-5">
                        Bekleyen Hasta Sayısı:
                        <?php
                        include "./lib/connect.php"; // Veritabanı bağlantısını içe aktar
                        date_default_timezone_set('Europe/Istanbul'); // Zaman dilimini ayarla
                        $bugunun_tarihi = date("Y-m-d"); // Bugünün tarihini al
                        $sql = "SELECT COUNT(*) AS randevu_sayisi FROM hasta_kayit WHERE DATE(tarih) = '$bugunun_tarihi' AND durum = 0 and  doktor_id =" . $_SESSION['user_id']; // Bekleyen hastaların sayısını sorgula

                        // Sorguyu çalıştır ve sonucu al
                        $result = $conn->query($sql); // Sorguyu çalıştır

                        if ($result) { // Eğer sorgu başarılıysa
                            // Sonucu al
                            $row = $result->fetch_assoc(); // Sonuçları bir dizi olarak al
                            $randevu_sayisi = $row["randevu_sayisi"]; // Bekleyen randevu sayısını al
                            echo $randevu_sayisi; // Ekrana yazdır
                        } else {
                            // Hata varsa hata mesajını yazdır
                            echo "Sorgu hatası: " . $conn->error; // Hata mesajını yazdır
                        }

                        // Bağlantıyı kapat
                        $conn->close(); // Veritabanı bağlantısını kapat
                        ?>
                    </span>
                </li>

                <li class="nav-item">
                    <span class="nav-link active text-danger fs-5">
                        Muane Edilen Hasta Sayısı:
                        <?php
                        include "./lib/connect.php"; // Veritabanı bağlantısını içe aktar
                        date_default_timezone_set('Europe/Istanbul'); // Zaman dilimini ayarla
                        $bugunun_tarihi = date("Y-m-d"); // Bugünün tarihini al
                        $sql = "SELECT COUNT(*) AS randevu_sayisi FROM hasta_kayit WHERE DATE(tarih) = '$bugunun_tarihi' AND durum = 1 and  doktor_id =" . $_SESSION['user_id']; // Muayene edilen hastaların sayısını sorgula

                        // Sorguyu çalıştır ve sonucu al
                        $result = $conn->query($sql); // Sorguyu çalıştır

                        if ($result) { // Eğer sorgu başarılıysa
                            // Sonucu al
                            $row = $result->fetch_assoc(); // Sonuçları bir dizi olarak al
                            $randevu_sayisi = $row["randevu_sayisi"]; // Muayene edilen randevu sayısını al
                            echo $randevu_sayisi; // Ekrana yazdır
                        } else {
                            // Hata varsa hata mesajını yazdır
                            echo "Sorgu hatası: " . $conn->error; // Hata mesajını yazdır
                        }

                        // Bağlantıyı kapat
                        $conn->close(); // Veritabanı bağlantısını kapat
                        ?>
                    </span>
                </li>


            </ul>
            <div>
                <a href="./doktor.php" class="btn btn-outline-primary">Hasta Listesi</a>
                <a href="./logout.php" class="btn btn-outline-danger">Çıkşyap</a>
            </div>
        </div>
    </div>
    </div>
</nav>