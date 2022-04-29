<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Pertandingan</title>
</head>

<body>

  <h2>Daftar Pertandingan Sepak Bola</h2>
  <table border="1" cellpadding="7">
    <tbody>
      <tr>
        <td>No</td>
        <td>Tim Home</td>
        <td>Tim Away</td>
        <td>Jadwal Pertandingan</td>
        <td>Jumlah Gol Tim Home</td>
        <td>Jumlah Gol Tim Away</td>
      </tr>
    </tbody>
    <?php
    while ($pertandingan = mysqli_fetch_array($proker)) {
    ?>
      <tr>
        <td>
          <?php echo $pertandingan['no'] ?>
        </td>
        <td>
          <?php echo $pertandingan['tim1'] ?>
        </td>
        <td>
          <?php echo $pertandingan['tim2'] ?>
        </td>
        <td>
          <?php echo $pertandingan['jadwalPertandingan'] ?>
        </td>
        <td>
          <?php echo $pertandingan['jumlahGolTim1'] ?>
        </td>
        <td>
          <?php echo $pertandingan['jumlahGolTim2'] ?>
        </td>

      </tr>
    <?php } ?>
  </table>
  <br>
</body>

</html>