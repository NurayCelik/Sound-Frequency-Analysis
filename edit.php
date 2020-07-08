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
echo "<script type=text/javascript>";
echo "alert('128 MB den büyük müzik dosyası yükleyemezsiniz! Dosya yükleme işlemi biraz zaman alabilir!')";
echo "</script>"; 
?>
    <?php 
   include_once("sql/Database.php");
   include "classes/Pages.php";
    $page =  new Pages(); // Create object for Product Class 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle']) ) {
       $id= $_POST['idvalue'];
       $updatedMusic = $page->musicUpdate($_POST, $_FILES,$id); // This method is for update data 
    }
    ?>

    
    <div class="container" style="margin-bottom: 100px;">
      <?php 
            if (isset($updatedMusic)) {
                 echo '<h4 style="color:forestgreen; text-align:left;""><b>'.$updatedMusic.'</b></h4>';
             }
                 ?>
       
  <!-- Content here -->
 
      <div class="col" style="width: 70%; float: left;"> 
        <h3 style="padding-left:0px;padding-bottom: 10px;font-weight: 700;opacity: .9;text-align: center;" >Müzik Dosya - Düzenle</h3>
           <?php
            $i = 1;
               $takenMp3 = $page->getAllTable("tbl_sesfrekans");  // in our product class i create one method with id 
                 if ($takenMp3) {
                    while ($value = $takenMp3->fetch_assoc()) { 
                        # code...

                ?> 
                <form action="" method="POST" style="border-bottom: 3px solid #a7515c;border-top: 1px solid #a7515c;" enctype="multipart/form-data" id="editForm" data-parsley-validate class="form-horizontal form-label-left">
                 <div class="form-group">
                    <label class="control-label col" for="first-name"><b><?php echo $i; ?>-  Mevcut Müzik</b><span class="required">*</span>
                    </label>
                    <div class="col">
                      <video controls width="300" height="50" src="<?php echo $value['ad']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col" for="first-name">Müzik Seç<span class="required">*</span>
                    </label>
                    <div class="col">
                      <input type="file" id="first-name"  name="dosyaAd"  class="form-control col">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Müzik Ad<span class="required">*</span>
                    </label>
                    <div class="col">
                      <input type="text" id="first-name" required="required" name="sesad" value="<?php echo $value['sesad']; ?>" class="form-control col">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Müzik Link<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" name="link" value="<?php echo $value['link']; ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                 
                  <div align="right" class="col">
                    <input type="hidden" name="idvalue" value="<?php echo $value['id'];?>" />
                    <input type="submit" name="guncelle" id="kaydet" value="Güncelle" class="btn btn-primary kaydet" />
                  </div> 

                </form>
                
                <?php

                        $i++;
                         }
                                    
                     }
                       
                ?>

        </div>
        <div class="col" style="width: 30%; float: left; text-align: center;top: 51px;">
          <form id="ekleForm" style="border-bottom: 3px solid #a7515c;border-top: 1px solid #a7515c;">
             <fieldset>
              <legend class="mysqlLegend" style="font-size: 24px;">Ses Frekans Analizi</legend>
                <div class="butonListe">
                 
                  
                  <ul style="list-style-type: none; padding-left: 0;">
                    <li><button type="submit" style="width: 100px !important;" class="btn btn-primary"><a href="index.php">Anasayfa</a></button></li>
                    <li><button type="submit" class="btn btn-primary"><a href="ekle.php">Ekle</a></button></li>
                    <li><button type="submit" class="btn btn-primary"><a href="clear.php">Sil</a></button></li>
                </ul>
                </div>
            </fieldset>    
          </form>
        </div>
      </div>
       <div class="col" style="width: 10%;float: left"></div>
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