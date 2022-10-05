<?php

//menimpa data
if (isset($_POST['submit'])) {
  $idvendor = $_POST['idvendor'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $notelp = $_POST['notelp'];
  $email = $_POST['email'];
  $file = fopen("../assets/vendor.txt", "r");
  $data = "";
  while (!feof($file)) {
    $line = fgets($file);
    $line = explode("|", $line);
    if ($line[0] == $idvendor) {
      $line[1] = $nama;
      $line[2] = $alamat;
      $line[3] = $notelp;
      $line[4] = $email . PHP_EOL;
    }
    if (!isset($line[1])) {
      break;
    }
    $data .= $line[0] . "|" . $line[1] . "|" . $line[2] . "|" . $line[3] . "|" . $line[4];
  }
  //delete |
  $data = substr($data, 0, -1);
  fclose($file);
  $file = fopen("../assets/vendor.txt", "w");
  fwrite($file, $data);
  fclose($file);
  header("Location: vendor.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/style.css    ">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  <!-- jquery -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Management Toko Atk</title>
</head>

<body>
  <?php
  $idvendor = $_GET['id'];
  $file = fopen("../assets/vendor.txt", "r");
  while (!feof($file)) {
    $line = fgets($file);
    $data = explode("|", $line);
    if ($data[0] == $idvendor) {
      $idvendor = $data[0];
      $nama = $data[1];
      $alamat = $data[2];
      $notelp = $data[3];
      $email = $data[4];
    }
  } ?>
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
          <input type="text" class="form-control" id="idvendor" name="idvendor" value="<?php echo $idvendor ?>" readonly>
        </div>
        <div class="col-md-6">
          <label for="" class="form-label">Nama Vendor</label>
          <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
        </div>

      </div>
      <div class="row g-3">
        <div class="col-md-6">
          <label for="" class="form-label">Alamat Vendor</label>
          <textarea class="form-control" id="alamatvendor" name="alamat" rows="3"><?php echo $alamat ?></textarea>
        </div>
        <div class="col-md-6">
          <label for="" class="form-label">No Telepon</label>
          <input type="text" class="form-control" id="notelp" name="notelp" value="<?php echo $notelp ?>">
        </div>
      </div>
      <div class="col-md-6">
        <label for="" class="form-label">Email Vendor</label>
        <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>">
      </div>
      <input type="submit" name="submit" class="btn btn-primary" style="margin-top:20px ;" value="Save">
  </div>
  </form>
  </div>
</body>

</html>