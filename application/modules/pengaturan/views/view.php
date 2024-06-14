<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card-header bg-primary text-white">
      <?=ucwords($title_module)?>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
        <tr>
          <td>Deskripsi Web</td>
          <td><?=$deskripsi_web?></td>
        </tr>
        <tr>
          <td>Alamat gmaps</td>
          <td><?=$alamat_gmaps?></td>
        </tr>
        <tr>
          <td>Visi</td>
          <td><?=$visi?></td>
        </tr>
        <tr>
          <td>Misi</td>
          <td><?=$misi?></td>
        </tr>
        <tr>
          <td>Foto</td>
          <td><?=is_image($foto)?></td>
        </tr>
        <tr>
          <td>Header</td>
          <td><?=is_image($header)?></td>
        </tr>
        <tr>
          <td>Marquee</td>
          <td><?=$marquee?></td>
        </tr>
        <tr>
          <td>Tagline</td>
          <td><?=$tagline?></td>
        </tr>
        <tr>
          <td>Motto</td>
          <td><?=$motto?></td>
        </tr>
        <tr>
          <td>Tujuan</td>
          <td><?=$tujuan?></td>
        </tr>
        </table>

        <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
      </div>
    </div>
  </div>
</div>
