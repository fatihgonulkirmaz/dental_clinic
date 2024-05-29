<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/yenisite">
      <img src="resim/fatih-logo.png" width="60" height="60" class="d-inline-block align-top" alt="">
      FatihDental
    </a>



    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon "></span>

    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav mr-auto ">
        <li class="nav-item active ">
          <a class="btn btn-dark" href="/yenisite">Anasayfa </a>
        </li>

        <li class="nav-item dropdown">
          <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Kurumsal
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="hakkımızda.php">Hakkımızda</a></li>
            <li><a class="dropdown-item" href="ekibimiz.php">Ekibimiz</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Doktorlarımız
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="fatihgonulkirmaz.php">Prof.Dr. Fatih Gönülkırmaz</a></li>
            <li><a class="dropdown-item" href="oznuraltın.php">Dt. Öznur Altın</a></li>
            <li><a class="dropdown-item" href="mehmetyuregir.php">Dr.Mehmet Yüreğir</a></li>

          </ul>
        </li>

        <li class="nav-item dropdown">
          <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Hizmetler
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="ağızdişçene.php">Ağız, Diş ve Çene Cerrahisi</a></li>
            <li><a class="dropdown-item" href="ÇocukDiş Hekimliği(Pedodonti).php">Çocuk Diş Hekimliği (Pedodonti)</a></li>
            <li><a class="dropdown-item" href="Ortodonti.php">Ortodonti</a></li>
            <li><a class="dropdown-item" href="EstetikDişHekimliği.php">Estetik Diş Hekimliği</a></li>
            <li><a class="dropdown-item" href="DişetiHastalıkları.php">Dişeti Hastalıkları (Periodontoloji)</a></li>
            <li><a class="dropdown-item" href="KanalTedavisi.php">Kanal Tedavisi (Endodonti)</a></li>

            <li class="nav-item">
              <a class="btn btn-dark" href="iletişim.php">İletişim</a>

            </li>
          </ul>
        <li class="nav-item">
          <a class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#randevu_kayit_formu">Randevu Kayıt</a>
          <?php include "./components/randevu_form.php" ?>
        </li>


    </div>
    <?php


    if (isset($_SESSION["user_id"])) {
      // Kullanıcı oturum açmışsa, herhangi bir şey yapmadan devam eder
      echo '<a href="./kontrol.php" class="btn btn-outline-success">Yetkili Sayfası</a>';
    } else {
      // Kullanıcı oturum açmamışsa, giriş yap butonunu gösterir
      echo '<button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Giriş Yap
          </button>';
    }
    ?>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Yetkili Girişi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form method="post" action="./login.php">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
              </div>

              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary w-100">Giriş</button>
              </div>

            </form>
          </div>

        </div>
      </div>
    </div>

</nav>