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
    $page =  new Pages(); // Create object for Product Class 
   
   if (isset($_GET['deletedmusic'])) {
     $id = $_GET['deletedmusic'];
     $deletedMusic = $page->delItemById("tbl_sesfrekans", "id", "ad", $id);
  }  

  ?>

    
    <div class="container" style="margin-bottom: 100px;">
      <?php 
            if (isset($deletedMusic)) {
                 echo '<h4 style="text-align:left;"><b style="color:forestgreen;">'.$deletedMusic.'</b></h4>';
             }
                 ?>
     
  <!-- Content here -->
      <div class="col" style="width: 80%; float: left;">
        <div id="editForm" data-parsley-validate class="form-horizontal form-label-left">
          <legend class="kontrolLegend">Müzik Dosya - Sil</legend>
            <div class="x_content">
              <div class="table-responsive" style="background-color:#b2b7b83d;border-top: 1px solid #a7515c; border-bottom: 3px solid #a7515c;">
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                      <th width="80"  class="column-title text-center">No</th>
                      <th width="250" class="column-title text-center">Dosya</th>
                      <th width="120" class="column-title text-center">Başlık</th>
                      <th width="80" class="column-title text-center">link</th>
                    </tr>
                  </thead>

                  <tbody>

                    <?php 
                    
                    $page = new Pages();
                    $takenMusic = $page->getAllTable("tbl_sesfrekans");
                    if($takenMusic)
                    {
                      $i=0;
                      while($result=$takenMusic->fetch_assoc())
                      {
                        $i++;
                   
                      ?>


                      <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><video controls width="200" height="20" src="<?php echo $result['ad']; ?>" /></td>
                        <td class="text-center"><?php echo $result['sesad']; ?></td>
                        <td class="text-center"><?php echo $result['link']; ?></td>
                       
                        <td width="20%" class="text-center"><a onclick="return confirm('Are you sure to delete')"
                        href="?deletedmusic=<?php echo $result['id']; ?>"><button type="submit" style="width:60px; height:40px;border-radius:50%; font-weight:500; background-color: #a7515c !important;" class="btn btn-danger btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Sil</button></a>
                      </td>

                      </tr>
                      <?php 
                           }
                      }
                  ?>
                      </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>
          <div class="col" style="width: 20%; float: left; text-align: center;top: 79px;">
          <form id="ekleForm" style="border-bottom: 3px solid #a7515c;border-top: 1px solid #a7515c;">
             <fieldset>
              <legend class="mysqlLegend" style="font-size: 24px;">Ses Frekans Analizi</legend>
                <div class="butonListe">
                 
                  
                  <ul style="list-style-type: none; padding-left: 0;">
                    <li><button type="submit" style="width: 100px !important;" class="btn btn-primary"><a href="index.php">Anasayfa</a></button></li>
                    <li><button type="submit" class="btn btn-primary"><a href="ekle.php">Ekle</a></button></li>
                    <li><button type="submit" class="btn btn-primary"><a href="edit.php">Güncelle</a></button></li>
                </ul>
                </div>
            </fieldset>    
          </form>
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