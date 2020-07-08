<!DOCTYPE html>
<html lang="tr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap-4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.1/css/bootstrap.css">
     <link rel="stylesheet" type="text/css" href="bootstrap-4.1/css/sesFrekans.css">
    <script type="text/javascript" href="bootstrap-4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Ses Frekans Analizi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  </head>
  <body>
   <header style="width: 100%; height: 200px; margin-bottom: 100px; background-image: url('image/iste.jpg');">
      <div class="container-fluid" >
       <div class="headerBilgi"><pre>
        İskenderun Teknik Üniversitesi 
        Mühendislik ve Doğa Bilimleri Fakültesi
        Bilgisayar Mühendisliği Bölümü
       </pre></div>
      </div>  
    </header>
     <div class="clearfix"></div>

    <?php
    include_once("sql/Database.php");
    include "classes/Pages.php";
    $page = new Pages();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ekle']) ) { 
    
    $insertedVideo = $page->sesInsert($_POST, $_FILES);
        
    }
    ?>
    
    <div class="container" style="margin-bottom: 100px;">
      <?php 
                    if (isset($insertedVideo)) {
                         echo '<h4><b style="color:forestgreen;text-align:left;">'.$insertedVideo.'</b></h4>';
                     }
                 ?>
  <!-- Content here -->
      <div class="col" style="float: left; width: 70%;">
        <form action="" method="POST" enctype="multipart/form-data" style="border-bottom: 3px solid #a7515c; border-top: 1px solid #a7515c;" class="ekleform" id="ekleForm" data-parsley-validate class="form-horizontal form-label-left">
          <legend class="kontrolLegend">Müzik Dosya - Ekle</legend>
                <div class="form-group">
                    <label class="control-label col" for="first-name">Ses / Video Seç<span class="required">*</span>
                    </label>
                    <div class="col"><?php
                    echo "<script type=text/javascript>";
                    echo "alert('128 MB den büyük müzik yükleyemezsiniz! Dosya yükleme işlemi biraz zaman alabilir!')";
                      echo "</script>"; ?>
                      <input type="file" id="first-name" required="required" name="dosyaAd"  class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col" for="first-name">Ses/ Video Ad<span class="required">*</span>
                    </label>
                    <div class="col">
                      <input type="text" id="first-name" required="required" name="kayitAd" placeholder="Ad..." class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col" for="first-name">Ses / Video Link<span class="required">*</span>
                    </label>
                    <div class="col">
                      <input type="text" id="first-name" name="link" placeholder="Link..." class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  
                  <div align="right" class="col">
                    <button type="submit" name="ekle" class="btn btn-primary kaydet" id="kaydet">Kaydet</button>
                  </div>
                
                </form>
        </div>

        <div class="col" style="width: 30%; float: left; text-align: center">
          <form id="ekleForm" style="border-bottom: 3px solid #a7515c;border-top: 1px solid #a7515c;" >
             <fieldset>
              <legend class="mysqlLegend">Ses Frekans Analizi</legend>
                <div class="butonListe">
                 
                  
                  <ul style="list-style-type: none; padding-left: 0;">
                    <li><button type="submit" style="width: 100px !important;" class="btn btn-primary"><a href="index.php">Anasayfa</a></button></li>
                    <li><button type="submit" class="btn btn-primary"><a href="edit.php">Güncelle</a></button></li>
                    <li><button type="submit" class="btn btn-primary"><a href="clear.php">Sil</a></button></li>
                </ul>
                </div>
            </fieldset>    
          </form>
        </div>

    </div>
    <div class="clearfix"></div>
    <footer style="width: 100%; height: 200px; margin-top: 200px; background-image: url('image/iste.png');">
      <div class="container-fluid" >
         <div class= "footerDiv">
         Copyright © 2020 İSTE. Tüm Hakları Saklıdır & by Nuray Çelik
        </div>
      </div>  
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>