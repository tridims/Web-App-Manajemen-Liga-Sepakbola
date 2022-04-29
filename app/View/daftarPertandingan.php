<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Pertandingan</title>
  <link rel="stylesheet" href="homeStyle.css">
</head>

<body>
  <!-- Kode yang menampilkan nama - nama kolom sesuai dengan database -->
  <h2>Daftar Pertandingan Sepak Bola</h2>
  <table border="1" cellpadding="7">
    <tbody>
      <tr></tr>
      <th>No</th>
      <th>Tim Home</th>
      <th>Tim Away</th>
      <th>Jadwal Pertandingan</th>
      <th>Jumlah Gol Tim Home</th>
      <th>Jumlah Gol Tim Away</th>
      <th colspan="2">Action</th>
      </tr>
    </tbody>
    <?php
    // untuk menampilkan isi dari database
    // while ($pertandingan = mysqli_fetch_array($pert)) {
    foreach ($model['daftarPertandingan'] as $pertandingan) {
    ?>
      <tr>
        <td>
          <?php echo $pertandingan->id ?>
        </td>
        <td>
          <?php echo $pertandingan->tim1->namaTim ?>
        </td>
        <td>
          <?php echo $pertandingan->tim2->namaTim ?>
        </td>
        <td>
          <?php echo $pertandingan->jadwalMain ?>
        </td>
        <td>
          <?php echo $pertandingan->jumlahGolTim1 ?>
        </td>
        <td>
          <?php echo $pertandingan->jumlahGolTim2 ?>
        </td>

        <td>
          <a href="/pertandingan/edit?id=<?= $pertandingan->id; ?>">Edit</a>
        </td>

        <td>
          <a href="/pertandingan/hapus?id=<?= $pertandingan->id; ?>">Hapus</a>
        </td>
      </tr>
    <?php } ?>
  </table>
  <br>

  <!-- 
  tombol untuk input data jadwal pertandingan -->
  <a href="/pertandingan/create">Input Jadwal Pertandingan</a>
  <!-- <form action="/pertandingan/create" method="get">
    <input type="submit" value="Input Jadwal Pertandingan" name="viewInputJadwalPertandingan">
  </form> -->
  <br>
  <!-- tombol untuk kembali kehalaman home -->
  <a href="/">Kembali</a>
  <!-- <form action="/" method="get">
    <input type="submit" value="Kembali" name="kembaliKeHome">
  </form> -->
</body>

</html>