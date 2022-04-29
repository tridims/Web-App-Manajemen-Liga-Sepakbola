<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="homeStyle.css">
</head>

<body>
  <h2>Daftar Klasemen</h2>
  <table border="1" cellpadding="7">
    <tbody>
      <tr>
        <!-- hanya menampilkan klasemen saja -->
        <!-- kami masih belum tahu darimana datanya, jadi masih nama kolomnya aja -->
        <td>no</td>
        <td>Nama Tim</td>
        <td>Skor</td>
      </tr>
    </tbody>
    <?php
    $n = 0;
    // echo var_dump($model['klasemen']);
    foreach ($model['klasemen'] as $klasemen) {
    ?>
      <tr>
        <td>
          <?php
          $n++;
          echo $n ?>
        </td>
        <td>
          <?php echo $klasemen->namaTim ?>
        </td>
        <td>
          <?php echo $klasemen->getTotalPoin() ?>
        </td>
      </tr>
    <?php } ?>
  </table>
  <br />
  <p>Juara = <?php echo $model['juara']->namaTim ?></p>
  <!-- tombol untuk kembali ke home tadi -->

  <br>
  <a href="/">Kembali </a>
  <br>
</body>

</html>