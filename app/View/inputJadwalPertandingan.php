<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input Jadwal Pertandingan</title>
  <link rel="stylesheet" href="homeStyle.css">
</head>

<body></body>
<form action="/pertandingan/create" method="POST">
  <table>
    <tr>
      <td>Id Tim 1: </td>
      <td><input type="text" name="tim1" size="20" /></td>
    </tr>
    <tr>
      <td>Id Tim 2: </td>
      <td><input type="text" name="tim2" size="20" /></td>
    </tr>
    <tr>
      <td>Jadwal Pertandingan: </td>
      <td><input type="text" name="jadwalPertandingan" /></td>
    </tr>
    <tr>
      <td>Jumlah Gol Tim 1: </td>
      <td><input type="text" name="jumlahGolTim1" size="2" /></td>
    </tr>
    <tr>
      <td>Jumlah Gol Tim 2: </td>
      <td><input type="text" name="jumlahGolTim2" size="2" /></td>
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