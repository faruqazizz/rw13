<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card-header bg-primary text-white">
      <?=ucwords($title_module)?>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
        <tr>
          <td>Kategori</td>
          <td><?=$id_kategori?></td>
        </tr>
        <tr>
          <td>Nama Galeri</td>
          <td><?=$nama_galeri?></td>
        </tr>
        <tr>
          <td>Deskripsi kegiatan</td>
          <td><?=$deskripsi_kegiatan?></td>
        </tr>
        <tr>
          <td>Cover</td>
          <td><?=is_image($cover)?></td>
        </tr>
        <tr>
          <td>Status galeri</td>
          <td><?=$status_galeri?></td>
        </tr>
        </table>

        <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
      </div>
    </div>
  </div>
</div>
