<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card-header bg-primary text-white">
      <?=ucwords($title_module)?>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
        <tr>
          <td>Judul sambutan</td>
          <td><?=$judul_sambutan?></td>
        </tr>
        <tr>
          <td>Ketua RW</td>
          <td><?=$nama_rw?></td>
        </tr>
        <tr>
          <td>Foto Diri</td>
          <td><?=is_image($foto_diri)?></td>
        </tr>
        <tr>
          <td>Sambutan</td>
          <td><?=$sambutan_teks?></td>
        </tr>
        </table>

        <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
      </div>
    </div>
  </div>
</div>
