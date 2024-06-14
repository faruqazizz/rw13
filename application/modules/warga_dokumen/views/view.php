<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card-header bg-primary text-white">
      <?=ucwords($title_module)?>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
        <tr>
          <td>Warga</td>
          <td><?=$id_warga?></td>
        </tr>
        <tr>
          <td>Syarat Dokumen</td>
          <td><?=$id_syarat_dokumen?></td>
        </tr>
        <tr>
          <td>Lokasi Dokumen</td>
          <td><a href="http://localhost/rw13/_temp/uploads/img/<?=$lokasi_dokumen?>" target="_blank"><?=$lokasi_dokumen?></a></td>
        </tr>
		
        <tr>
          <td>Datecreated</td>
          <td><?=$datecreated != "" ? date('d-m-Y H:i',strtotime($datecreated)):""?></td>
        </tr>
        <tr>
          <td>Datemodified</td>
          <td><?=$datemodified != "" ? date('d-m-Y H:i',strtotime($datemodified)):""?></td>
        </tr>
        </table>

        <a href="<?= 'javascript:window.history.go(-1);'?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
      </div>
    </div>
  </div>
</div>
