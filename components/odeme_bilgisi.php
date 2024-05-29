<?php
$hasta_kayit_id = $row["id"];
$sql_yapilan_islem = "SELECT yapilan_islem.id, yapilan_islem.tedavi_id, tedavi.islem, tedavi.aciklama, tedavi.fiyat 
                      FROM yapilan_islem 
                      JOIN tedavi ON yapilan_islem.tedavi_id = tedavi.id 
                      WHERE yapilan_islem.hasta_kayit_id = ?";
$stmt_yapilan_islem = $conn->prepare($sql_yapilan_islem);
$stmt_yapilan_islem->bind_param("i", $hasta_kayit_id);
$stmt_yapilan_islem->execute();
$result_yapilan_islem = $stmt_yapilan_islem->get_result();
$toplam_fiyat = 0;
?>

<div class="modal fade " id="modal-<?php echo $row["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class=" modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead class="table-success">
                        <tr>
                            <th scope="col">İşlem</th>
                            <th scope="col">Açıklama</th>
                            <th scope="col">Fiyat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($islem_row = $result_yapilan_islem->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $islem_row["islem"]; ?></td>
                                <td><?php echo $islem_row["aciklama"]; ?></td>
                                <td><?php echo $islem_row["fiyat"];
                                    $toplam_fiyat += $islem_row["fiyat"]; ?></td>

                            </tr>
                        <?php endwhile; ?>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <span>Toplam Fiyat: <?php echo $toplam_fiyat ?></span>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                <a href='./lib/öde.php?fiyat="' .<?php echo $toplam_fiyat ?>.'" type="button" class="btn btn-primary">Ödeme Yap</a>

            </div>

        </div>
    </div>
</div>

<?php
$stmt_yapilan_islem->close();
?>