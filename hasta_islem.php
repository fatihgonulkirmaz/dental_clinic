<?php

include "./lib/connect.php";

if (isset($_POST['tedavi']) && isset($_GET['id'])) {
    $tedaviler = $_POST['tedavi'];
    $hasta_kayit_id = $_GET['id'];

    echo 'Seçtiğiniz tedaviler: <br/>';
    echo 'Hasta ID: ' . $hasta_kayit_id . '<br/>';

    // Tedavi işlemleri için prepared statement oluştur
    $sql_insert = "INSERT INTO `yapilan_islem` (`hasta_kayit_id`, `tedavi_id`) VALUES (?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);

    if ($stmt_insert === false) {
        die('Statement prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Döngüde her bir tedavi ID'si için kayıt ekle
    foreach ($tedaviler as $tedavi) {
        echo 'Tedavi ID: ' . $tedavi . '<br/>';

        // Parametreleri bağla ve sorguyu çalıştır
        $stmt_insert->bind_param("ii", $hasta_kayit_id, $tedavi);
        if ($stmt_insert->execute() === false) {
            echo 'Hata: ' . htmlspecialchars($stmt_insert->error) . '<br/>';
        } else {
            echo 'Başarıyla eklendi!<br/>';
        }
    }

    // Tedavi işlemleri statement'ını kapat
    $stmt_insert->close();

    // Hasta durumu güncelleme için prepared statement oluştur
    $sql_update = "UPDATE `hasta_kayit` SET `durum` = 1 WHERE `id` = ?";
    $stmt_update = $conn->prepare($sql_update);

    if ($stmt_update === false) {
        die('Statement prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Parametreleri bağla ve sorguyu çalıştır
    $stmt_update->bind_param("i", $hasta_kayit_id);
    if ($stmt_update->execute() === false) {
        echo 'Durum güncelleme hatası: ' . htmlspecialchars($stmt_update->error) . '<br/>';
    } else {
        echo 'Hasta durumu başarıyla güncellendi!<br/>';
        header("Location: /yenisite/doktor.php");
    }

    // Hasta durumu güncelleme statement'ını kapat
    $stmt_update->close();
} else {
    echo 'Hiç Tedavi seçmediniz veya geçerli bir ID parametresi yok.';
}

// Veritabanı bağlantısını kapat
$conn->close();
