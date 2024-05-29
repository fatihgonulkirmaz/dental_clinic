<?php include "connect.php";

// Formdan gelen verileri al
$tc_no = $_POST['tc_no'];
$isim = $_POST['isim'];
$soyisim = $_POST['soyisim'];
$tarih = $_POST['tarih'];
$email = $_POST['email'];
$telefon = $_POST['telefon'];
$doktor_id = $_POST['doktor_id'];

// Veritabanına ekleme işlemi
$sql = "INSERT INTO `hasta_kayit`(tc_no, isim, soyisim, tarih, email, telefon, doktor_id) VALUES
 ('$tc_no','$isim','$soyisim','$tarih','$email','$telefon','$doktor_id')";
if (mysqli_query($conn, $sql)) {
    // Başarılı ekleme bildirimi
    setcookie("durum", true,  time()+60);
    // Yönlendirme
    header("Location: /yenisite");
    die();
} else {
    // Hata durumunda
    echo "Hata: " . $sql . "<br>" . mysqli_error($conn);
}

// Veritabanı bağlantısını kapat
mysqli_close($conn);
?>
