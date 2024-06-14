<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card-header bg-primary text-white">
      <?=ucwords($title_module)?>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
        <tr>
          <td>Judul foto</td>
          <td><?=$judul_foto?></td>
        </tr>
        <tr>
          <td>Lokasi foto</td>
          <td><?=is_image($lokasi_foto)?></td>
        </tr>
        <tr>
          <td>Link berkas</td>
          <td><?=$link_berkas?></td>
        </tr>
        <tr>
          <td>Untuk Halaman</td>
          <td><?=$id_halaman?></td>
        </tr>
        </table>

        <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
      </div>
    </div>
  </div>
</div>
