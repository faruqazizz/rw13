<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card-header bg-primary text-white">
      <?=ucwords($title_module)?>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
        <tr>
          <td>Nama surat</td>
          <td><?=$nama_surat?></td>
        </tr>
        <tr>
          <td>Contoh Dokumen</td>
          <td><a href="http://localhost/rw13/_temp/uploads/img/<?=$contoh_dokumen?>" target="_blank"><?=$contoh_dokumen?></a></td>
        </tr>
		
        <tr>
          <td>Date created</td>
          <td><?=$date_created != "" ? date('d-m-Y H:i',strtotime($date_created)):""?></td>
        </tr>
        </table>

        <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
      </div>
    </div>
  </div>
</div>