<div class="container px-5 py-5">
  <h2 class="row justify-content-center">Input Jadwal Pertandingan</h2>
  <form action="/pertandingan/create" method="POST">

    <div class="mb-3">
      <label class="form-label">Id Tim 1</label>
      <input class="form-control" type="text" name="tim1" size="20" />
    </div>

    <div class="mb-3">
      <label class="form-label">Id Tim 2</label>
      <input class="form-control" type="text" name="tim2" size="20" />
    </div>

    <div class="mb-3">
      <label class="form-label">Jadwal Pertandingan</label>
      <input class="form-control" type="text" name="jadwalPertandingan" />
    </div>

    <div class="mb-3">
      <label class="form-label">Jumlah Gol Tim 1</label>
      <input class="form-control" type="text" name="jumlahGolTim1" value="0" size="2" />
    </div>

    <div class="mb-3">
      <label class="form-label">Jumlah Gol Tim 2</label>
      <input class="form-control" type="text" name="jumlahGolTim2" value="0" size="2" />
    </div>

    <div class="mb-3">
      <button class="btn btn-primary" type="submit" name="submit" value="Submit">Simpan</button>
      <a class="btn btn-warning" role="button" href="/pertandingan">Kembali </a>
    </div>

  </form>
</div>