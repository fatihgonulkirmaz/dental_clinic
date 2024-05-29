<!-- Modal -->
<div class="modal fade" id="randevu_kayit_formu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-dark text-center" id="exampleModalLabel">Randevu Kayıt</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="bg-white px-2 py-3 rounded-3" method="post" action="./lib/randevu_kayit.php">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label"></label>
                        <input name="tc_no" type="number" id="disabledTextInput" class="form-control" placeholder="TC Kimlik Numarası" required>
                        <div id="emailHelp" class="form-text">Bu Alanın Doldurulması Zorunludur!</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label"></label>
                        <input name="isim" type="text" id="disabledTextInput" class="form-control" placeholder="İsim">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label"></label>
                        <input name="soyisim" type="text" id="disabledTextInput" class="form-control" placeholder="Soyisim">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Randevu Tarihi</label>
                        <input name="tarih" type="date" id="disabledTextInput" class="form-control" placeholder="Tarih">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label"></label>
                        <input name="email" type="text" id="disabledTextInput" class="form-control" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label"></label>
                        <input name="telefon" type="text" id="disabledTextInput" class="form-control" placeholder="Telefon">
                    </div>


                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="doktor_id">
                            <option selected>Doktor Seçimi</option>
                            <?php
                            include "./lib/connect.php";
                            $sql = 'SELECT k.* FROM kullanıcılar k INNER JOIN rol r ON k.rol = r.id WHERE r.rol LIKE "%doktor%";';
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['id'] .  '">' . $row['ad'] . " " . $row['soyad']  . "</option>";
                                }
                            }

                            ?>


                        </select>
                    </div>


                    <button type="submit" class="btn btn-warning mt-3">Gönder</button>
                </form>
            </div>

        </div>
    </div>
</div>