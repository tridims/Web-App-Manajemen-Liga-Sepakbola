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
    <form action="/tim/create" method="POST">
        <table>
            <!-- di sini diisi semua (kalau semua not null) -->
            <!-- variabel timsep di sini, adalah variabel yang menyimpan record-record yang ada di database
        setelah query dieksekusi -->
            <!-- form ini menggunakan method post, jadi kalau ingin memakai nilainya bisa ditangkap pakai post nanti -->
            <tr>
                <td>Nama Tim: </td>
                <td><input type="text" name="namaTim" size="20" /></td>
            </tr>
            <tr>
                <td>Asal Tim: </td>
                <td><input type="text" name="asal" size="20" /></td>
            </tr>
            <tr>
                <td>Deskripsi Tim: </td>
                <td><input type="text" name="deskripsi" size="200" /></td>
            </tr>
            <tr>
                <td>Stadium: </td>
                <td><input type="text" name="stadium" size="20" /></td>
            </tr>
            <tr>
                <td>Logo: </td>
                <td><input type="file" name="logo" /></td>
            </tr>
            <tr>
                <td>Pelatih: </td>
                <td><input type="text" name="pelatih" size="20" /></td>
            </tr>
            <tr>
                <td>Pemilik: </td>
                <td><input type="text" name="pemilik" size="20" /></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Submit" /></td>
            </tr>
        </table>
    </form>
    <br>
    <a href="/tim">Kembali </a>
    <br>
</body>

</html>