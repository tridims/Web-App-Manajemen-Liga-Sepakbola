<!DOCTYPE html>
<html lang="en">
<?php $pert = $model['daftarPertandingan']; ?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Jadwal Pertandingan</title>
  <link rel="stylesheet" href="homeStyle.css">
</head>

<body>
  <form action="" method="POST">
    <table>
      <tr>
        <td>Id Tim 1: </td>
        <td><input type="text" name="tim1" value=<?php echo $pert->tim1->id ?> size="20" /></td>
      </tr>
      <tr>
        <td>Id Tim 2: </td>
        <td><input type="text" name="tim2" value=<?php echo $pert->tim2->id ?> size="20" /></td>
      </tr>
      <tr>
        <td>Jadwal Pertandingan: </td>
        <td><input type="text" name="jadwalPertandingan" value="<?php echo $pert->jadwalMain ?>" /></td>
      </tr>
      <tr>
        <td>Jumlah Gol Tim 1: </td>
        <td><input type="text" name="jumlahGolTim1" size="2" value="<?php echo $pert->jumlahGolTim1 ?>" size="2" /></td>
      </tr>
      <tr>
        <td>Jumlah Gol Tim 2: </td>
        <td><input type="text" name="jumlahGolTim2" value="<?php echo $pert->jumlahGolTim2 ?>" size="2" /></td>
      </tr>
      <tr>
        <td><input type="submit" name="submit" value="Submit" /></td>
      </tr>
    </table>
  </form>
  <br>
  <a href="/pertandingan">Kembali </a>
</body>

</html>