<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Tim</title>
  <link rel="stylesheet" href="homeStyle.css">
</head>

<body>
  <h2>Daftar Tim Sepak Bola</h2>
  <table border="1" cellpadding="7">
    <!-- ini nama nama kolom yang akan ditampilkan, sesuaikan dengan database aja biar mudah -->
    <tbody>
      <tr>
        <td>No</td>
        <td>Nama Tim</td>
        <td>Deskripsi</td>
        <td>Asal</td>
        <td>Stadium</td>
        <td>Logo</td>
        <td>Pelatih</td>
        <td>Pemilik</td>
        <!-- ini 2 kolom dijadikan 1, untuk edit dan hapus -->
        <td colspan="2">Action</td>
      </tr>
    </tbody>
    <?php
    // untuk nampilkan isi dari database tabel tim sepak bola
    // 
    foreach ($model['daftarTim'] as $tim) {
    ?>
      <tr>
        <td>
          <?php echo $tim->id ?>
        </td>
        <td>
          <?php echo $tim->namaTim ?>
        </td>
        <td>
          <?php echo $tim->deskripsi ?>
        </td>
        <td>
          <?php echo $tim->asal ?>
        </td>
        <td>
          <?php echo $tim->stadium ?>
        </td>
        <td>
          <!-- ini untuk nampilkan logo -->
          <?php
          echo '<img src="data:image/png;base64,' . base64_encode($tim->logo) . '"/>';
          ?>
        </td>
        <td>
          <?php echo $tim->pelatih ?>
        </td>
        <td>
          <?php echo $tim->pemilik ?>
        </td>
        <!-- edit -->
        <td>
          <a href="/tim/edit?id=<?= $tim->id; ?>">Edit</a>
        </td>
        <!-- nanti pas ditampilkan, akan mengirimkan parameter yang berisi id dari yang dipilih ke index. 
        Idnya nanti bisa digunakan untuk sql delete -->
        <td>
          <a href="/tim/hapus?id=<?= $tim->id; ?>">Hapus</a>
        </td>
        <!-- <td>
          <form action="/tim/hapus?id=<?= $tim->id; ?>" method="get">
            <input type="submit" value="Hapus" name="hapusDataTim">
          </form>
        </td> -->
      </tr>
    <?php } ?>
  </table>
  <br>
  <a href="/tim/create">Tambah Tim </a>
  <br>
  <a href="/">Kembali </a>
  <!-- ini tombol tombol untuk menuju ke input data dan kembali ke home -->
  <!-- <form action="inputDataTim.php">
    <input type="submit" value="Input Data Tim" name="viewInputDataTim">
  </form> -->
  <!-- <form action="Home.php">
    <input type="submit" value="Kembali" name="kembaliKeHome">
  </form> -->
</body>

</html>