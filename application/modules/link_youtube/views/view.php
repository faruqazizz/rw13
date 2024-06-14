<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card-header bg-primary text-white">
      <?=ucwords($title_module)?>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
        <tr>
          <td>Judul Video</td>
          <td><?=$nama_berkas?></td>
        </tr>
        <tr>
          <td>Link Video</td>
          <td><?=$lokasi_berkas?></td>
        </tr>
        <tr>
          <td>Status</td>
          <td><?=$id_stts?></td>
        </tr>
        <tr>
          <td>Tanggal dibuat</td>
          <td><?=$tanggal_dibuat != "" ? date('d-m-Y H:i',strtotime($tanggal_dibuat)):""?></td>
        </tr>
        </table>

        <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
      </div>
    </div>
  </div>
</div>
