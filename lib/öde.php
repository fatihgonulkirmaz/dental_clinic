<?php
if (isset($_GET['fiyat']) && isset($_GET['hasta_id'])) {
    $fiyat = $_GET['fiyat'];
    $hasta_id = $_GET['hasta_id'];

    // $fiyat ve $hasta_id değişkenlerini burada kullanabilirsiniz
    // Örnek: ödeme işlemlerini gerçekleştirin
    echo "Ödeme fiyatı: " . htmlspecialchars($fiyat) . " TL<br>";
    echo "Hasta ID: " . htmlspecialchars($hasta_id);

    // Diğer işlemleri burada gerçekleştirin
} else {
    echo "Ödeme fiyatı veya Hasta ID belirtilmedi.";
}
