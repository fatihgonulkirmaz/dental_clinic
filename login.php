<?php
include "./lib/connect.php"; // Veritabanı bağlantısı için gerekli dosya

$email = $_POST['email']; // Formdan gelen email
$password = $_POST['password']; // Formdan gelen şifre

if ($email != '' && $password != '') {
    // SQL sorgusunu hazırlıyoruz, email ve şifre için yer tutucular ile
    $sorgu = $conn->prepare('SELECT k.id, k.ad, k.soyad, k.mail, k.telefon, r.rol 
                             FROM kullanıcılar k 
                             JOIN rol r ON k.rol = r.id 
                             WHERE k.mail = ? AND k.sifre = ?');
    // Şifreyi hash fonksiyonu kullanmadan direkt kontrol ediyoruz
    // Email ve şifre parametrelerini bağlıyoruz
    $sorgu->bind_param('ss', $email, $password);
    // Sorguyu çalıştırıyoruz
    $sorgu->execute();
    // Sonucu alıyoruz
    $result = $sorgu->get_result();

    // Kullanıcı bulunup bulunmadığını kontrol ediyoruz
    if ($result->num_rows > 0) {
        // Kullanıcı verilerini alıyoruz
        $user = $result->fetch_assoc();

        // Oturumu başlatıp kullanıcı bilgilerini saklıyoruz
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['ad'];

        $_SESSION['user_role'] = $user['rol'];

        // Kullanıcıyı dashboard veya kullanıcı alanına yönlendiriyoruz
        header("Location: /yenisite/kontrol.php");
    } else {
        // Kullanıcı bulunamadıysa veya şifre yanlışsa, hata ile giriş sayfasına yönlendir
        header("Location:/yenisite");
    }

    // Sorguyu ve bağlantıyı kapatıyoruz
    $sorgu->close();
    $conn->close();
} else {
    // Email veya şifre boş ise giriş sayfasına yönlendir
    header("Location: /yenisite");
}
