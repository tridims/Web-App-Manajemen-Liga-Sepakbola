<?php $pert = $model['daftarPertandingan'] ?>
<div class="container px-5 py-5">
  <h2 class="row justify-content-center">Edit Pertandingan</h2>
  <form action="" method="POST">
    <div class="mb-3">
      <label class="form-label">Id Tim 1</label>
      <input type="text" class="form-control" name="tim1" value='<?php echo $pert->tim1->id ?>' size="20" />
    </div>
    <div class="mb-3">
      <label class="form-label">Id Tim 2</label>
      <input type="text" class="form-control" name="tim2" value='<?php echo $pert->tim2->id ?>' size="20" />
    </div>
    <div class="mb-3">
      <label class="form-label">Jadwal Pertandingan</label>
      <input type="text" class="form-control" name="jadwalPertandingan" value="<?php echo $pert->jadwalMain ?>" />
    </div>
    <div class="mb-3">
      <label class="form-label">Jumlah Gol Tim 1</label>
      <input type="text" class="form-control" name="jumlahGolTim1" size="2" value="<?php echo $pert->jumlahGolTim1 ?>" size="2" />
    </div>
    <div class="mb-3">
      <label class="form-label">Jumlah Gol Tim 2</label>
      <input type="text" class="form-control" name="jumlahGolTim2" value="<?php echo $pert->jumlahGolTim2 ?>" size="2" />
    </div>

    <div class="d-grid gap-2 mt-3">
      <button type="submit" class="btn btn-primary" name="submit" value="Submit">Simpan</button>
    </div>
  </form>

  <div class="d-grid gap-2 mt-3">
    <a class="btn btn-warning" role="button" href="/pertandingan">Kembali </a>
  </div>
</div>