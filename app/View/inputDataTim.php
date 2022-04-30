<div class="container px-5 py-5">

    <h2 class="row justify-content-center">Tambah Tim</h2>
    <form action="/tim/create" method="POST">
        <div class="mb-3">
            <label class="form-label">Nama Tim</label>
            <input type="text" class="form-control" name="namaTim" size="20" />
        </div>

        <div class="mb-3">
            <label class="form-label">Asal Tim</label>
            <input type="text" class="form-control" name="asal" size="20" />
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi Tim</label>
            <input type="text" class="form-control" name="deskripsi" size="200" />
        </div>

        <div class="mb-3">
            <label class="form-label">Stadium</label>
            <input type="text" class="form-control" name="stadium" size="20" />
        </div>

        <div class="mb-3">
            <label class="form-label">Logo</label>
            <input type="file" class="form-control" name="logo" />
        </div>

        <div class="mb-3">
            <label class="form-label">Pelatih</label>
            <input type="text" class="form-control" name="pelatih" size="20" />
        </div>

        <div class="mb-3">
            <label class="form-label">Pemilik</label>
            <input type="text" class="form-control" name="pemilik" size="20" />
        </div>

        <div class="d-grid gap-2 mt-3">
            <button type="submit" class="btn btn-primary" name="submit" value="Submit">Simpan</button>
        </div>
    </form>
    <div class="d-grid gap-2 mt-2">
        <a href="/tim" class="btn btn-warning" role="button">Kembali </a>
    </div>
</div>