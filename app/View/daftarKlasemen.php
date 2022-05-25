<div class="container px-5 py-5">
  <h2 class="row justify-content-center">Rangking Klasemen</h2>
  <table class="table mt-5">
    <thead>
      <tr>
        <th scope="col">Rank</th>
        <th scope="col">Tim</th>
        <th scope="col">Skor</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $n = 0;
      foreach ($model['klasemen'] as $klasemen) {
      ?>
        <?= $n != 0 ? '<tr>' : '<tr class="table-success">' ?>
        <th>
          <?php $n++;
          echo $n ?>
        </th>
        <td>
          <?php
          echo '<img src="data:image/png;base64,' . base64_encode($klasemen->logo) . '" class="img-fluid rounded" width="50" />';
          ?>&nbsp;&nbsp;<?= $n != 1 ? $klasemen->namaTim : $klasemen->namaTim . ' (Current Winner)' ?>
        </td>
        <td>
          <?php echo $klasemen->getTotalPoint() ?>
        </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <div class="d-grid">
    <a class="btn btn-primary" role="button" href="/">Kembali </a>
  </div>

</div>