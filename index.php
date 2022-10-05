<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/style.css    ">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  <!-- jquery -->
  <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
  <title>Management Toko Atk</title>
</head>

<body>
  <header>
    <ul>
      <li><a href="./Jenis/jenis.php">Jenis Atk</a></li>
      <li><a href="./Vendor/vendor.php">Vendor</a></li>
      <li><a href="index.php">Atk</a></li>
    </ul>
  </header>

  <div class="box">
    <a href="Atk/CreateAtk.php"><button type="button" class="btn btn-success" style="margin-bottom: 20px;">Add Data</button></a>
    <table id="table" class="display" style="width:100%">
      <thead>
        <tr>
          <th>Id Atk</th>
          <th>Nama Atk</th>
          <th>Jenis Atk</th>
          <th>Vendor</th>
          <th>Stok</th>
          <th>Action</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $handle = fopen("assets/data.txt", "r");
        if ($handle) {
          while (($line = fgets($handle)) !== false) {
            $data = explode("|", $line);
            echo '
            <tr>
              <td>' . $data[0] . '</td>
              <td>' . $data[1] . '</td> 
              <td>' . $data[2] . '</td>
              <td>' . $data[3] . '</td>
              <td>' . $data[4] . '</td>
              <td><a href="Atk/UpdateAtk.php?id=' . $data[0] . '">Edit</a> | <a href="?id=' . $data[0] . '">Delete</a></td>
           </tr>';
          }
          fclose($handle);
        } else {
          echo "Error: File not found";
        }
        ?>
      </tbody>
    </table>
  </div>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#table').DataTable();
    });
  </script>
</body>

</html>

<?php

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  deletedata($id);
}

function deletedata($id)
{
  $file = fopen("assets/data.txt", "r");
  $temp = fopen("assets/temp.txt", "w");
  while (!feof($file)) {
    $line = fgets($file);
    $data = explode("|", $line);
    if ($data[0] != $id) {
      fwrite($temp, $line);
    }
  }
  fclose($file);
  fclose($temp);
  unlink("assets/data.txt");
  rename("assets/temp.txt", "assets/data.txt");
  header("Location: index.php");
}


?>