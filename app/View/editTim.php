<?php $tim = $model['tim']; ?>

<div class="container px-5 py-5">

  <h2 class="row justify-content-center">Edit Tim</h2>
  <form action="/tim/edit?id=<?= $tim->id; ?>" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Nama Tim:</label>
      <input type="text" class="form-control" name="namaTim" value="<?php echo $tim->namaTim ?>" size="20" />
    </div>
    <div class="mb-3">
      <label class="form-label">Asal Tim:</label>
      <input type="text" class="form-control" name="asal" value="<?php echo $tim->asal ?>" size="20" />
    </div>
    <div class="mb-3">
      <label class="form-label">Deskripsi Tim:</label>
      <textarea type="text" class="form-control" name="deskripsi" size="200"><?php echo $tim->deskripsi ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Stadium:</label>
      <input type="text" class="form-control" name="stadium" value="<?php echo $tim->stadium ?>" size="20" />
    </div>
    <div class="mb-3">
      <label class="form-label">Logo:</label>
      <?php echo '<img src="data:image/png;base64,' . base64_encode($tim->logo) . '"/>'; ?>
      <input type="file" class="form-control" name="logo" id="logo" value="" />
    </div>
    <div class="mb-3">
      <label class="form-label">Pelatih:</label>
      <input type="text" class="form-control" name="pelatih" value="<?php echo $tim->pelatih ?>" size="20" />
    </div>
    <div class="mb-3">
      <label class="form-label">Pemilik:</label>
      <input type="text" class="form-control" name="pemilik" value="<?php echo $tim->pemilik ?>" size="20" />
    </div>

    <div class="d-grid gap-2 mt-3">
      <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
    </div>
  </form>

  <div class="d-grid gap-2 mt-2">
    <a class="btn btn-warning" role="button" href="/tim">Kembali</a>
  </div>
</div>