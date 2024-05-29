<?php
include "./components/head.php";
include "./components/sekreter_navbar.php";
include "./lib/connect.php";

// Bugünün tarihini al
date_default_timezone_set('Europe/Istanbul');
$bugunun_tarihi = date("Y-m-d");
?>

<br>

<table class="table table-primary container table-hover">
  <thead>
    <tr>
      <th scope="col">TC</th>
      <th scope="col">Hasta Adı</th>
      <th scope="col">Hasta Soyadı</th>
      <th scope="col">Hasta Telefon Numarası</th>
      <th scope="col">Muane Durumu</th>
      <th scope="col">Doktor Seçimi</th>
      <th scope="col">Ödeme Durumu</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Muayene edilmiş hastalar için sorgu
    $sql = "SELECT hasta_kayit.id, hasta_kayit.tc_no, hasta_kayit.isim, hasta_kayit.soyisim, hasta_kayit.telefon, hasta_kayit.ödeme, kullanıcılar.ad AS doktor_ad 
        FROM hasta_kayit 
        JOIN kullanıcılar ON hasta_kayit.doktor_id = kullanıcılar.id 
        WHERE DATE(hasta_kayit.tarih) = ? AND hasta_kayit.durum = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bugunun_tarihi);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {

        echo '<tr class="table-danger">';
        echo "<th>" . $row["tc_no"] . "</th>";
        echo "<th>" . $row["isim"] . "</th>";
        echo "<th>" . $row["soyisim"] . "</th>";
        echo "<th>" . $row["telefon"] . "</th>";
        echo "<th>Muayene Edildi</th>";
        echo "<th>" . $row["doktor_ad"] . "</th>";
        if ($row["ödeme"] > 0) {
          echo '<th class="text-success"> Ödeme Yapılmıştır </th>';
        } else {
          echo '<th>';
          echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-' . $row["id"] . '">Öde</button>';
          include './components/odeme_bilgisi.php';
          echo '</th>';
        }
        echo "</tr>";
      }
    } else {
      echo '<tr class="table-danger"><td colspan="7" class="text-center fs-5 fw-bold text-secondary">Bugün için muayene edilmiş hasta bulunmamaktadır.</td></tr>';
    }

    $stmt->close();

    // Veritabanı bağlantısını kapat
    $conn->close();
    ?>
  </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>