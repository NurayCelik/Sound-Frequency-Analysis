<?php 
$filepath= realpath(dirname(__FILE__));
include_once($filepath.'/../sql/Database.php'); ?>

<?php
class Pages{

	private $db;  // I crate Property for Database Class

 
    public function __construct(){

       $this->db   = new Database(); // I crate Object for Database Class
     
	}
  public function deletemp3Id($id,$tableName,$tableId,$column){
      $query = "SELECT * FROM $tableName WHERE $tableId ='$id' ";
       $getData = $this->db->select($query);
         if ($getData) {
           while ($delMp3 = $getData->fetch_assoc()) {
            
           $dellink = $delMp3[$column];
            @unlink($dellink);
          }
            }
     }

  public function delItemById($table, $columnId, $column, $id){
       $query = "SELECT * FROM $table WHERE $columnId = '$id' ";
       $getData = $this->db->select($query);
         if ($getData) {
           while ($delImg = $getData->fetch_assoc()) {
           $dellink = $delImg[$column];
                  @unlink($dellink);
            }
          }
       
               $delquery = "DELETE FROM $table WHERE $columnId = '$id' ";
                $deldata = $this->db->delete($delquery);
            if ($deldata) {
              $msg = "<span class='success'>İsteğiniz Başarılı Silindi.</span> ";
            return $msg;
            }else {
              $msg = "<span class='error'>İsteğiniz Silinmedi!</span> ";
                 return $msg;
              } 
    }

public function getAllTable($table){ 
        $query = "SELECT * FROM $table";
         $result = $this->db->select($query);
         return $result; 
       }
        public function getDatabase($table,$tableId){
         $query = "SELECT * FROM $table order by $tableId";
         $result = $this->db->select($query);
         return $result;
     }

public function sesInsert($data, $file){

      $sesAd    =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['kayitAd'])));
      $link    =   mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['link'])));
      
      $permited = array('mp3','MP3','mp4','MP4','wma');

       $file_name = basename($file['dosyaAd']['name']);
       $file_size = $file['dosyaAd']['size'];
       $file_temp = $file['dosyaAd']['tmp_name'];
       $file_type = $file['dosyaAd']['type'];

       $div = explode('.', $file_name);
       $file_ext = strtolower(end($div));
       $unique_video = substr(md5(time()), 0, 10).'.'.$file_ext;
       $inserted_video= "ses-video/".$unique_video;
      
      if ($sesAd == "" || $link == "") {
          $msg = "<span class='error'>Alanlar Boş Olamaz!</span> ";
              return $msg;
         }else{
           
          if ($file_size > 134217728 ) {
            echo "<span class='error'>128 MB den büyük video yükleyemezsiniz!</span>".$file['video']['error'];
           }elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'> Sadece şu uzantılı dosyaları yükleyebilirsiniz: ".implode(',', $permited)."</span>".$file['video']['error'];
            } 
            
            else{
           
            move_uploaded_file($file_temp, $inserted_video);
            
            $query = "INSERT INTO tbl_sesfrekans(ad, sesad, link) 
            VALUES('$inserted_video','$sesAd','$link')";  
   
            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
               header("refresh:2; url=http://localhost/BitirmeProjesi2/index.php");
            $msg = "<span class='success' style='text-align:center'>Video Başarılı Eklendi.</span> ";
            return $msg; // return message 
          }else {
            $msg = "<span class='error'>Video Eklenmedi!</span> ";
             } 

     }


    }

}
public function musicUpdate($data, $file, $id){
 
      $sesad     =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['sesad'])));
      $link      =  mysqli_real_escape_string($this->db->link, $data['link']);
      $permited  = array('mp3','MP3','mp4','MP4','wma');
      $file_name = basename($file['dosyaAd']['name']);
      $file_size = $file['dosyaAd']['size'];
      $file_temp = $file['dosyaAd']['tmp_name'];
      $file_type = $file['dosyaAd']['type'];
   
       $div = explode('.', $file_name);
       $file_ext = strtolower(end($div));
       $unique_music = substr(md5(time()), 0, 10).'.'.$file_ext;
       $uploaded_music = "ses-video/".$unique_music;
      
        if ($sesad == "" || $link == "") {
            $msg = "<span class='error'>Alanlar Boş Olamaz!</span> ";
                return $msg;
           }else{
 
    
     if (!empty($file_name)) {
     if ($file_size > 134217728) {
      echo "<span class='error'>128 MB den büyük video yükleyemezsiniz!</span>";
     }elseif (in_array($file_ext, $permited) === false) {
      echo "<span class='error'> Sadece şu uzantılı dosyaları yükleyebilirsiniz : ".implode(',', $permited)."</span>";
      } else{
               $columnName='ad';
               $tName='tbl_sesfrekans';
               $columnId='id';
              $this->deletemp3Id($id,$tName,$columnId,$columnName);

          move_uploaded_file($file_temp, $uploaded_music);
          $query = "UPDATE tbl_sesfrekans
          SET 
          ad     = '$uploaded_music',
          sesad  = '$sesad',
          link   = '$link'
          WHERE id = '$id' ";
      
          $updated_row = $this->db->update($query);
          if ($updated_row) {
          $msg = "<span class='success'>Güncelleme Başarılı.</span> ";
          header("refresh:3; url=index.php");
          return $msg;
        }else {
          $msg = "<span class='error'>Güncelleme Başarısız!</span> ";
          return $msg;
        } 
     }
 
      } else{
          $query = "UPDATE tbl_sesfrekans
          SET 
          sesad   = '$sesad',
          link    = '$link'
         
          WHERE id = '$id' ";
 
          $updated_row = $this->db->update($query);
          if ($updated_row) {
           $msg = "<span class='success'>Güncelleme Başarılı.</span> ";
          header("refresh:3; url=index.php");
          return $msg;
        }else {
          $msg = "<span class='error'>Güncelleme Başarısız!</span> ";
          return $msg; // return This Message 
        } 
 
        }
    }
 
  }
}

?>