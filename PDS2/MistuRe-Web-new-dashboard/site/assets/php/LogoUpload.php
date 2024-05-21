<?php 

class LogoUpload {
  public static function uploadLogo($buffer) {
    $uploadOk = 1;
    $error = "";
  
    if ($buffer["size"] > 500000) {
      $error = $error ."Arquivo muito grande! (Limite de 500KB)" . "<br>";
      $uploadOk = 0;
    }
    $imageFileType = strtolower(pathinfo(basename($buffer["name"]),PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" &&
       $imageFileType != "jpeg") {
      $error = $error ."Formato Inválido! (Apenas arquivos JPG, JPEG ou PNG são permitidos!)" . "<br>";
      $uploadOk = 0;
    }
    else {
      $check = getimagesize($buffer["tmp_name"]);
      if($check === false) {
        $error = $error ."O arquivo não é uma imagem!" . "<br>";
        $uploadOk = 0;
      }
    }
    
    date_default_timezone_set('America/Sao_Paulo');
    $unixtime = strtotime(gmdate('Y-m-d H:i:s \G\M\T'));
    $year = date('Y', $unixtime);
    $month = date('m', $unixtime);
    $day = date('d', $unixtime);
    $hours = date('H', $unixtime);
    $minutes = date('i', $unixtime);
    $seconds = date('s', $unixtime);
  
    $files_directory = __DIR__."/../../temp/img/";
    $file_name = basename($buffer["name"]);
    $file_prefix = "{$year}-{$month}-{$day}_{$hours}-{$minutes}-{$seconds}";
    $new_file_name = $file_prefix ."_" .$file_name;
    $file_url = $files_directory .$new_file_name;
  
    if(!$uploadOk) {
      $res["ok"] = false;
      $res["msg"] = $error;
      return $res;
    }
    else if(!move_uploaded_file($buffer["tmp_name"], $file_url)) {
      $res["ok"] = false;
      $res["msg"] = "Falha ao realizar upload do arquivo " . htmlspecialchars( basename( $buffer["name"])) ." !";
      return $res;
    }
  
    return array(
      "ok" => true,
      "fileName" => $new_file_name
    );
  }

  public static function deleteLogo(String $url):bool {
    $path = __DIR__."/../../temp/img/".$url;
    if(file_exists($path)) {
      return unlink($path);
    }
    else {
      return false;
    }
  }
}
