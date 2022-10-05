<?php

//update selected line
if (isset($_POST['submit'])) {
  $idjenis = $_POST['idjenis'];
  $jenis = $_POST['jenis'];
  $temp = "p\n";
  $file = fopen("../assets/jenis.txt", "r");
  $data = [];
  while (!feof($file)) {
    $data[] = fgets($file);
  }
  fclose($file);
  $file = fopen("../assets/jenis.txt", "w");
  foreach ($data as $key => $value) {
    $value = explode("|", $value);
    if ($value[0] == $idjenis) {
      $value[1] = $jenis;
      $value[2] = $temp;
    }
    $value = implode("|", $value);
    fwrite($file, $value);
  }
  fclose($file);
  header("Location: jenis.php");
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
  <title>Management Atk</title>
</head>

<body>
  <?php
  $idjenis = $_GET['id'];
  $file = fopen("../assets/jenis.txt", "r");
  while (!feof($file)) {
    $line = fgets($file);
    $data = explode("|", $line);
    if ($data[0] == $idjenis) {
      $idjenis = $data[0];
      $jenis = $data[1];
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
          <label for="" class="form-label">ID Jenis</label>
          <input type="text" class="form-control" id="idjenis" name="idjenis" value="<?php echo $idjenis ?>" readonly>
        </div>
        <div class="col-md-6">
          <label for="" class="form-label">Jenis AtK</label>
          <input type="text" class="form-control" id="jenis" name="jenis" value="<?php echo $jenis ?>">
        </div>
        <input type="submit" name="submit" class="btn btn-primary" style="margin-top:20px ;" value="Save">
      </div>
    </form>
  </div>
</body>

</html>