<div class="container px-4 py-5">
  <h2 class="mb-4">Daftar Tim Sepak Bola</h2>
  <table class="table">
    <!-- ini nama nama kolom yang akan ditampilkan, sesuaikan dengan database aja biar mudah -->
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Tim</th>
        <th scope="col">Deskripsi</th>
        <th scope="col">Asal</th>
        <th scope="col">Stadium</th>
        <th scope="col">Logo</th>
        <th scope="col">Pelatih</th>
        <th scope="col">Pemilik</th>
        <!-- ini 2 kolom dijadikan 1, untuk edit dan hapus -->
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // untuk nampilkan isi dari database tabel tim sepak bola
      foreach ($model['daftarTim'] as $tim) {
      ?>
        <tr>
          <th scope="row">
            <?php echo $tim->id ?>
          </th>
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
            echo '<img src="data:image/png;base64,' . base64_encode($tim->logo) . '" class="img-fluid rounded" width="50" />';
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
            <a class="btn btn-primary" role="button" href="/tim/edit?id=<?= $tim->id; ?>">Edit</a>
          </td>
          <!-- nanti pas ditampilkan, akan mengirimkan parameter yang berisi id dari yang dipilih ke index. 
        Idnya nanti bisa digunakan untuk sql delete -->
          <td>
            <a class="btn btn-danger" role="button" href="/tim/hapus?id=<?= $tim->id; ?>">Hapus</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <br>

  <div class="d-grid gap-2">
    <a class="btn btn-primary" href=" /tim/create">Tambah Tim </a>
    <a class="btn btn-primary" href="/">Kembali </a>
  </div>
</div>