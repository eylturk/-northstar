<?php
  $northstarCon = mysqli_connect("localhost","root","","northstar");
  mysqli_set_charset($northstarCon, "utf8");
  if (!$northstarCon) {
    echo "Bağlantı yok";
  }
?>
