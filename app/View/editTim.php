<?php $tim = $model['tim']; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input Data Tim</title>
  <link rel="stylesheet" href="homeStyle.css">
</head>

<body>
  <form action="/tim/edit?id=<?= $tim->id; ?>" method="POST">
    <!-- sama seperti yang insert, di sini diisi semua (kalau semua not null) -->
    <!-- variabel timsep di sini, adalah variabel yang menyimpan record-record yang ada di database
        setelah query dieksekusi -->
    <!-- form ini menggunakan method post, jadi kalau ingin menginput ke database bisa pakai post nanti -->
    <table>
      <tr>
        <td>Nama Tim: </td>
        <td><input type="text" name="namaTim" value="<?php echo $tim->namaTim ?>" size="20" /></td>
      </tr>
      <tr>
        <td>Asal Tim: </td>
        <td><input type="text" name="asal" value="<?php echo $tim->asal ?>" size="20" /></td>
      </tr>
      <tr>
        <td>Deskripsi Tim: </td>
        <td><input type="text" name="deskripsi" value="<?php echo $tim->deskripsi ?>" size="200" /></td>
      </tr>
      <tr>
        <td>Stadium: </td>
        <td><input type="text" name="stadium" value="<?php echo $tim->stadium ?>" size="20" /></td>
      </tr>
      <tr>
        <td>Logo: </td>
        <td><input type="file" name="logo" value="<?php echo '<img src="data:image/png;base64,' . base64_encode($tim->logo) . '"/>'; ?>" /></td>
      </tr>
      <tr>
        <td>Pelatih: </td>
        <td><input type="text" name="pelatih" value="<?php echo $tim->pelatih ?>" size="20" /></td>
      </tr>
      <tr>
        <td>Pemilik: </td>
        <td><input type="text" name="pemilik" value="<?php echo $tim->pemilik ?>" size="20" /></td>
      </tr>
      <tr>
        <td><input type="submit" name="submit" value="Submit" /></td>
      </tr>
    </table>
  </form>
  <br>
  <!-- ini tombol kembali ke daftar tim -->
  <!-- <form action="daftarTim.php">
    <input type="submit" value="Kembali" name="kembaliKeDaftarTim">
  </form> -->

  <a href="/tim">Kembali </a>
  <br>
</body>

</html>
<?php

// ini akan dieksekusi ketika tombol submit ditekan, akan membuat objek baru dari kelas controller
// setelah itu melaksanakan fungsi update untuk mengupdate

// kalau menggunakan mvc pakai ini
// if (isset($_POST['submit'])) {
//   $main = new c_tim();
//   $main->update();
// } 
?>