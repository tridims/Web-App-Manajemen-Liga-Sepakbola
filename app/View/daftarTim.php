<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Tim</title>
</head>

<body>

  <h2>Daftar Tim Sepak Bola</h2>
  <table border="1" cellpadding="7">
    <tbody>
      <tr>
        <td>No</td>
        <td>Nama Tim</td>
        <td>Deskripsi</td>
        <td>Asal</td>
        <td>Stadium</td>
        <td>Pelatih</td>
        <td>Pemilik</td>
        <td>Logo</td>
      </tr>
    </tbody>
    <?php
    while ($tim = mysqli_fetch_array($proker)) {
    ?>
      <tr>
        <td>
          <?php echo $tim['no'] ?>
        </td>
        <td>
          <?php echo $tim['namaTim'] ?>
        </td>
        <td>
          <?php echo $tim['deskripsi'] ?>
        </td>
        <td>
          <?php echo $tim['asal'] ?>
        </td>
        <td>
          <?php echo $tim['stadium'] ?>
        </td>
        <td>
          <?php echo $tim['pelatih'] ?>
        </td>
        <td>
          <?php echo $tim['pemilik'] ?>
        </td>
        <td>
          <?php echo $tim['logo'] ?>
        </td>
      </tr>
    <?php } ?>
  </table>
  <br>
</body>

</html>