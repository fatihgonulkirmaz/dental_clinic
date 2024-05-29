<?php include "components/head.php" ?>
 <?php include "components/navpar.php" ?>
 <?php include "components/slider.php" ?>
 <?php include "./lib/connect.php" ?>



 <div class="d-flex align-items-center mt-4">
     <!-- resim ve yazıyı yannyana koymak için kullandık -->

     <div class="container">
         <h1 class="text-center font-weight-bold">FatihDental Ağız ve Diş Sağlığı Polikliniği</h1>
         <h4 class="text-center font-weight-light mb-6">Çocuk Diş Hekimliği, Ortodonti, Periodontoloji, Restoratif Diş Hekimliği, Endodonti, Ağız-Diş-Çene Cerrahisi, İmplant Tedavisi, Estetik Diş Hekimliği, Diş Beyazlatma, Gülüş Tasarımı ve Protez alanlarında hizmet veren polikliniğimiz, tecrübeli ve uzman hekimlerimizle sizlere ayrıcalıklı tedavi hizmeti sunmaktadır.</h4>
     </div>

     <img src="resim/slider1.jpeg" class="rounded float-md-right mt-3 mr-5 " weight="300" height="300" alt="...">

 </div>

 <div class="bg-dark mt-4 ">
     <div class="container py-5 ">
         <div class="row text-white text-center">


             <h1>Randevu Oluşturun</h1>
             <p class="text-warning fs-5">Yandaki formu kullanarak ya da aşağıdaki telefon numarası ile bize ulaşabilir ve randevu oluşturabilirsiniz.</p>



             <h5 class="m-2 ">RANDEVU OLUŞTURMAK İSTER MİSİNİZ?</h5>

             <h3 class="fw-bold">0312 232 11 35</h3>
             <h3 class="fw-bold">0552 222 03 47</h3>



             <div><!-- Randevu oluştur button -->
                 <button type="button" class="btn btn-outline-warning mt-3" data-bs-toggle="modal" data-bs-target="#randevu_kayit_formu">
                     Randevu Kayıt
                 </button>
                 <?php include "./components/randevu_form.php" ?>
             </div>



         </div>
     </div>
 </div>

 <div class="d-flex align-items-center mt-5">
     <div class="container">
         <div class="row">
             <div class="col-8 text-dark">
                 <h1>Kurumsal</h1>
                 <p>FatihDental Ağız ve Diş Sağlığı Polikliniği, diş hekimleri Fatih Gönülkırmaz, Öznur Altın ve Mehmet Yüreğir tarafından kurulmuş bir aile kliniği olup,
                     1993 yılından beri mesleğimizin tüm branşlarında uzman diş hekimleri ile hizmet vermektedir.
                     Başkent Ankara’mızın Kızılay semtinden çıktığımız bu yolda Mamak bölgesinde de hizmet vermekten büyük gurur duymaktayız.
                     Polikliniğimiz; diş hekimliği uygulamalarının tüm yeniliklerinin takip edildiği, dijital teknolojilerin kullanıldığı,
                     hastalara tedavileri hakkında detaylı bilgilerin verildiği, çocuklarımızın tedavilerine isteyerek gittikleri ortamların sunulduğu, deneyimli ve akademik kadro ile çalışmaktadır.
                     Güçlü ilkeleri, sıcak ve samimi ortamı ile her geçen gün sizlerle büyüyerek yolumuza devam etmekteyiz.</p>


             </div>
         </div>
     </div>
 </div>

 <?php include "components/footer.php" ?>

 <?php include "components/script.php" ?>