<?php
  require_once("./connection.php");
  $method = $_SERVER["REQUEST_METHOD"];

  switch ($method) {
    case 'POST':
      parse_str(file_get_contents("php://input"), $putVars);
      $adi = $putVars["adi"];
      $soyadi = $putVars["soyadi"];
      $personelTipi = $putVars["personelTipi"];
      $query = mysqli_query($northstarCon,"INSERT INTO personeller(adi, soyadi, personelTipId)
      VALUES('".$adi."', '".$soyadi."', '".$personelTipi."')");
      if ($query == true) {
        echo 1;
      }else{
        echo 2;
      }
      break;
    case 'PUT':
      parse_str(file_get_contents("php://input"), $putVars);
      $id = $putVars["id"];
      $adi = $putVars["adi"];
      $soyadi = $putVars["soyadi"];
      $personelTipi = $putVars["personelTipi"];
      $query = mysqli_query($northstarCon, "update personeller set adi = '".$adi."', soyadi = '".$soyadi."',
      personelTipId = '".$personelTipi."' where id = '".$id."' ");
      if ($query == true) {
        echo 1;
      }else{
        echo 2;
      }
      break;
    case 'DELETE':
      parse_str(file_get_contents("php://input"), $putVars);
      $id = $putVars["id"];
      $query = mysqli_query($northstarCon, "delete from personeller where id = '".$id."' " );
      if ($query == true) {
        echo 1;
      }else{
        echo 2;
      }
      break;
  }
?>
