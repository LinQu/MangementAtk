<?php

//menimpa data
if (isset($_POST['submit'])) {
  $id = $_POST['idatk'];
  $nama = $_POST['nama'];
  $jenis = $_POST['jenis'];
  $vendor = $_POST['vendor'];
  $stok = $_POST['stok'];
  $file = fopen("../assets/data.txt", "r");
  $data = "";
  while (!feof($file)) {
    $line = fgets($file);
    $line = explode("|", $line);
    if ($line[0] == $id) {
      $line[1] = $nama;
      $line[2] = $jenis;
      $line[3] = $vendor;
      $line[4] = $stok . PHP_EOL;
    }
    $data .= $line[0] . "|" . $line[1] . "|" . $line[2] . "|" . $line[3] . "|" . $line[4];
  }
  //delete |
  $data = substr($data, 0, -1);
  fclose($file);
  $file = fopen("../assets/data.txt", "w");
  fwrite($file, $data);
  fclose($file);
  header("Location: ../index.php");
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
  $idatk = $_GET['id'];
  $file = fopen("../assets/data.txt", "r");
  while (!feof($file)) {
    $line = fgets($file);
    $data = explode("|", $line);
    if ($data[0] == $idatk) {
      $idatk = $data[0];
      $nama = $data[1];
      $jenis = $data[2];
      $vendor = $data[3];
      $stok = $data[4];
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
          <label for="" class="form-label">ID ATK</label>
          <input type="text" class="form-control" id="idatk" name="idatk" value="<?php echo $idatk ?>" readonly>
        </div>
        <div class="col-md-6">
          <label for="" class="form-label">Nama Barang</label>
          <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
        </div>

      </div>
      <div class="row g-3">
        <div class="col-md-6">
          <label for="" class="form-label">Jenis</label>
          <select id="jenis" class="form-select" name="jenis">
            <option selected><?php echo $jenis ?></option>
            <?php
            $file = fopen("../assets/jenis.txt", "r");
            while (!feof($file)) {
              $data = fgets($file);
              $data = explode("|", $data);
              echo "<option value='$data[1]'>$data[1]</option>";
            }
            fclose($file);
            ?>
          </select>
        </div>
        <div class="col-md-6">
          <label for="" class="form-label">Vendor</label>
          <select id="vendor" class="form-select" name="vendor">
            <option selected><?php echo $vendor ?></option>
            <?php
            $file = fopen("../assets/vendor.txt", "r");
            while (!feof($file)) {
              $data = fgets($file);
              $data = explode("|", $data);
              echo "<option value='$data[1]'>$data[1]</option>";
            }
            fclose($file);
            ?>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <label for="" class="form-label">Jumlah Stok</label>
        <input type="text" class="form-control" id="stok" name="stok" value="<?php echo $stok ?>">
      </div>
      <input type="submit" name="submit" class="btn btn-primary" style="margin-top:20px ;" value="Save">
  </div>
  </form>
  </div>
</body>

</html>