<div class="container px-4 py-5">
  <h2>Daftar Pertandingan Sepak Bola</h2>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Tim Home</th>
        <th scope="col">Tim Away</th>
        <th scope="col">Jadwal Pertandingan</th>
        <th scope="col">Jumlah Gol Tim Home</th>
        <th scope="col">Jumlah Gol Tim Away</th>
        <th scope="col" colspan="2">Action</th>
      </tr>
    </thead>

    </tbody>
    <?php
    $n = 1;
    foreach ($model['daftarPertandingan'] as $pertandingan) { ?>
      <tr>
        <th scope="row">
          <?php echo $n ?>
        </th>
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
          <a class="btn btn-primary" role="button" href="/pertandingan/edit?id=<?= $pertandingan->id; ?>">Edit</a>
        </td>

        <td>
          <a class="btn btn-danger" role="button" href="/pertandingan/hapus?id=<?= $pertandingan->id; ?>">Hapus</a>
        </td>
      </tr>
    <?php $n++;
    } ?>
    </tbody>
  </table>
  <br>

  <a class="btn btn-primary" role="button" href="/pertandingan/create">Input Jadwal Pertandingan</a>
  <a class="btn btn-warning" role="button" href="/">Kembali</a>

</div>