<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card-header bg-primary text-white">
      <?=ucwords($title_module)?>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
        <tr>
          <td>Nama Menu</td>
          <td><?=$nama_menu?></td>
        </tr>
        <tr>
          <td>Tautan menu</td>
          <td><?=$tautan_menu?></td>
        </tr>
        <tr>
          <td>Halaman Menu</td>
          <td><?=$id_halaman?></td>
        </tr>
        </table>

        <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
      </div>
    </div>
  </div>
</div>
