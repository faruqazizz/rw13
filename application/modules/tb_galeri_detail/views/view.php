<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card-header bg-primary text-white">
      <?=ucwords($title_module)?>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
        <tr>
          <td>Id galeri</td>
          <td><?=$id_galeri?></td>
        </tr>
        <tr>
          <td>File</td>
          <td><?=is_image($file)?></td>
        </tr>
        </table>

        <a href="<?=url('tb_galeri_detail/index/'.$idgaleri)?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
      </div>
    </div>
  </div>
</div>
