<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST">
        <table>
            <tr>
                <td>Nama Tim: </td>
                <td><input type="text" name="inputNamaTim" size="30" /></td>
            </tr>
            <tr>
                <td>Deskripsi Tim: </td>
                <td><input type="text" name="inputDeskripsiTim" size="30" /></td>
            </tr>
            <tr>
                <td>Asal Tim: </td>
                <td><input type="text" name="inputAsalTim" size="30" /></td>
            </tr>
            <tr>
                <td>Stadium: </td>
                <td><input type="text" name="inputStadiumTim" size="30" /></td>
            </tr>
            <tr>
                <td>Pelatih: </td>
                <td><input type="text" name="inputPelatihTim" size="30" /></td>
            </tr>
            <tr>
                <td>Pemilik: </td>
                <td><input type="text" name="inputPemilikTim" size="30" /></td>
            </tr>
            <tr>
                <td>Logo: </td>
                <td><input type="text" name="inputLogoTim" size="30" /></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Submit" /></td>
            </tr>
        </table>
    </form>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    // $main = new c_programKerja();
    // $main->insert();
} ?>

</html>