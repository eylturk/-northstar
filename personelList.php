<?php
require_once("./connection.php");
$query = mysqli_query($northstarCon, "SELECT personeller.id, personeller.adi, personeller.soyadi, personel_tipleri.personelTip
  FROM `personeller` inner join personel_tipleri on personeller.personelTipId = personel_tipleri.id");
$datas = array();
while ($row = mysqli_fetch_assoc($query)) {
  $datas[] = $row;
}

?>
<!DOCTYPE html>
<html lang="tr">
<?php include("./header.php"); ?>

<script>
  function sendTo(param) {
    window.location.replace(param);
  }

  function personelSil(personelId){
    var url = "./personelConnection.php";
    if (personelId == "") {
      alert("Hata oluştu");
    }else{
      $.ajax({
        type:"DELETE",
        url:url,
        data:{
          id:personelId
        }
      }).done(function(response){
        if (response == 1) {
          window.location.reload();
        }else{
          alert("İşlem başarısız");
        }
      })
    }
  }
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
              <h1 class="m-0">Personeller</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Ana Sayfa</a></li>
                <li class="breadcrumb-item active">Personeller</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-lg btn-success me-md-2" onclick="sendTo('./personelEkle.php');">Ekle</button>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Adı</th>
                        <th>Soyadı</th>
                        <th>Personel Tipi</th>
                        <th>Güncelle</th>
                        <th>Sil</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php foreach ($datas as $key => $value) { ?>
                        <tr>
                          <td> <?php echo $value["adi"] ?> </td>
                          <td><?php echo $value["soyadi"] ?></td>
                          <td><?php echo $value["personelTip"] ?></td>
                          <td><button class="btn btn-primary" onclick="sendTo('./personelGuncelle.php?id=' + <?php echo $value['id'] ?>)">Güncelle</button></td>
                          <td><button class="btn btn-danger" onclick="personelSil(<?php echo $value['id'] ?>)">Sil</button></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <?php include("./footer.php"); ?>
</body>
<?php include("./scripts.php"); ?>
</html>
