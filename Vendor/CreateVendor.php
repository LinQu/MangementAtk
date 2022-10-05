<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/style.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  <!-- jquery -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Management Vendor</title>
</head>

<body>
  <header>
    <ul>
      <li><a href="../Jenis/jenis.php">Jenis Atk</a></li>
      <li><a href="../Vendor/vendor.php">Vendor</a></li>
      <li><a href="../index.php">Atk</a></li>
    </ul>
  </header>

  <div class="box">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="row g-3">
        <div class="col-md-6">
          <label for="" class="form-label">ID Vendor</label>
          <input type="text" class="form-control" id="idvendor" name="idvendor" value="<?php echo idotomatis() ?>" readonly>
        </div>
        <div class="col-md-6">
          <label for="" class="form-label">Nama Vendor</label>
          <input type="text" class="form-control" id="nama" name="nama">
        </div>

      </div>
      <div class="row g-3">
        <div class="col-md-6">
          <label for="" class="form-label">Alamat Vendor</label>
          <textarea class="form-control" id="alamatvendor" name="alamat" rows="3"></textarea>
        </div>
        <div class="col-md-6">
          <label for="" class="form-label">No Telepon</label>
          <input type="text" class="form-control" id="notelp" name="notelp">
        </div>
      </div>
      <div class="col-md-6">
        <label for="" class="form-label">Email Vendor</label>
        <input type="text" class="form-control" id="email" name="email">
      </div>
      <input type="submit" name="submit" class="btn btn-primary" style="margin-top:20px ;" value="Save">
  </div>
  </form>
  </div>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
  $idvendor = $_POST['idvendor'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $notelp = $_POST['notelp'];
  $email = $_POST['email'] . "\n";

  $file = fopen("../assets/vendor.txt", "a");
  fwrite($file, $idvendor . "|" . $nama . "|" . $alamat . "|" . $notelp . "|" . $email);
  fclose($file);
  header("Location: vendor.php");
}

function idotomatis()
{
  $file = fopen("../assets/vendor.txt", "r");
  $id = 0;
  if ($file) {
    while (($line = fgets($file)) !== false) {
      $data = explode("|", $line);
      $id = $data[0];
    }
    $id = $id + 1;
    echo $id;
  } else {
    echo "1";
  }
}
