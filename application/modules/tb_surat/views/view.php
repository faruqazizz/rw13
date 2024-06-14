<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card-header bg-primary text-white">
      <?=ucwords($title_module)?>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
        <tr>
          <td>Jenis surat</td>
          <td><?=$id_jenis_surat?></td>
        </tr>
        <tr>
          <td>Warga</td>
          <td><?=$id_warga?></td>
        </tr>
        <tr>
          <td>Nomor surat</td>
          <td><?=$nomor_surat?></td>
        </tr>
        <tr>
          <td>Nomor surat RW</td>
          <td><?=$no_surat_rw?></td>
        </tr>
        <tr>
          <td>Tgl ajuan</td>
          <td><?=$tgl_ajuan != "" ? date('d-m-Y H:i',strtotime($tgl_ajuan)):""?></td>
        </tr>
        <tr>
          <td>Keperluan</td>
          <td><?=$keperluan?></td>
        </tr>
        <tr>
          <td>Status surat</td>
          <td><?=$id_status_surat?></td>
        </tr>
      <tr>
        <td>Tgl keputusan</td>
        <td><?=$tgl_keputusan != "" ? date('d-m-Y',strtotime($tgl_keputusan)):""?></td>
      </tr>
        <tr>
          <td>Validator</td>
          <td><?= strtoupper($id_group)?></td>
        </tr>
        <tr>
          <td>Catatan Revisi</td>
          <td><?=$revisi?></td>
        </tr>
        <tr>
          <td>Tanggal Diperbarui</td>
          <td><?=$date_updated != "" ? date('d-m-Y H:i',strtotime($date_updated)):""?></td>
        </tr>
        </table>

        <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
      </div>
    </div>
  </div>
</div>
