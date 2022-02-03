<?php
  require_once("./connection.php");
  $query = mysqli_query($northstarCon, "select * from personel_tipleri");
  $datas = array();
  while($row = mysqli_fetch_assoc($query)){
    $datas[] = $row;
  }

  $personelId = $_GET["id"];
  $personelQuery = mysqli_query($northstarCon, "SELECT personeller.id, personeller.adi, personeller.soyadi, personel_tipleri.id as personelTipId
  FROM `personeller` inner join personel_tipleri on personeller.personelTipId = personel_tipleri.id where personeller.id= '".$personelId."' ");
  $personel = mysqli_fetch_object($personelQuery);
?>
<!DOCTYPE html>
<html lang="tr">
<?php include("./header.php"); ?>

<script>
  function personelGuncelle(){
    var url = "./personelConnection.php"
    var errorMsg = document.getElementById("errorMsg");
    var adi = document.getElementById("adi").value;
    var soyadi = document.getElementById("soyadi").value;
    var personelTipi = document.getElementById("personelTipi").value;
    var id = <?php echo $personelId; ?>;

    if (adi == "" || soyadi == "" || personelTipi == 0) {
      errorMsg.innerHTML = "Lütfen boş alan bırakmayınız";
    }else{
      errorMsg.innerHTML = "";

      $.ajax({
        type:"PUT",
        url: url,
        data:{
          id: id,
          adi:adi,
          soyadi:soyadi,
          personelTipi:personelTipi
        }
      }).done(function(response){
        if (response == 1) {
          url = "./personelList.php"
          window.location.replace(url);
        }else{
          errorMsg.innerHTML = "İşlem başarısız";
        }
      })
    }

  }

  function load(){
    var adi = document.getElementById("adi");
    var soyadi = document.getElementById("soyadi");

    adi.setAttribute("value", "<?php echo $personel->adi ?>");
    soyadi.setAttribute("value", "<?php echo $personel->soyadi ?>");
    $('select').find('option[value=<?php echo $personel->personelTipId ?>]').attr('selected','selected');

  }
  window.onload = load;
</script>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php include("./navbar.php"); ?>
    <?php include("./sidebar.php"); ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Personel Ekle</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="personelList.php">Personeller</a></li>
                <li class="breadcrumb-item active">Personel Ekle</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- form start -->
      <form>
        <div class="card-body">
          <div class="form-group">
            <label for="adi">Adı</label>
            <input type="text" class="form-control" id="adi" placeholder="Adı">
          </div>
          <div class="form-group">
            <label for="soyadi">Soyadı</label>
            <input type="text" class="form-control" id="soyadi" placeholder="Soyadı">
          </div>
          <div class="form-group">
            <label for="soyadi">Personel Tipi</label>
            <select class="custom-select form-control-border" id="personelTipi" aria-label="Personel Tipi">
              <option selected value="0">Lütfen bir seçim yapınız</option>
              <?php foreach ($datas as $key => $value) {?>
                <option value="<?php echo $value["id"] ?>"><?php echo $value["personelTip"] ?></option>
              <?php }?>
            </select>
          </div>
        </div>

        <div class="card-footer">
          <button type="button" class="btn btn-primary" onclick="personelGuncelle()">Güncelle</button>
        </div>
      </form>
      <label class="text-warning" id="errorMsg"></label>
    </div>
  </div>
  <?php include("./footer.php"); ?>
</body>
<?php include("./scripts.php"); ?>

</html>
