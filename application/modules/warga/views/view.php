<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card-header bg-primary text-white">
      <?=ucwords($title_module)?>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
        <tr>
          <td>No KK</td>
          <td><?=$no_kk?></td>
        </tr>
        <tr>
          <td>No KTP</td>
          <td><?=$no_ktp?></td>
        </tr>
        <tr>
          <td>Nama Lengkap</td>
          <td><?=$nama_lengkap?></td>
        </tr>
        <tr>
          <td>Tempat Lahir</td>
          <td><?=$tempat_lahir?></td>
        </tr>
      <tr>
        <td>Tgl Lahir</td>
        <td><?=$tgl_lahir != "" ? date('d-m-Y',strtotime($tgl_lahir)):""?></td>
      </tr>
        <tr>
          <td>Nomor Handphone</td>
          <td><?=$hp?></td>
        </tr>
        <tr>
          <td>Jenis kelamin</td>
          <td><?=$jenis_kelamin?></td>
        </tr>
        <tr>
          <td>Agama</td>
          <td><?=$agama?></td>
        </tr>
        <tr>
          <td>Pendidikan Terakhir</td>
          <td><?=$pendidikan_terakhir?></td>
        </tr>
        <tr>
          <td>Profesi</td>
          <td><?=$id_profesi?></td>
        </tr>
        <tr>
          <td>RT</td>
          <td><?=$id_group?></td>
        </tr>
        <tr>
          <td>Alamat (No Rumah)</td>
          <td><?=$alamat?></td>
        </tr>
        <tr>
          <td>Foto Profil</td>
          <td><?=is_image($foto_profil)?></td>
        </tr>
        <tr>
          <td>Tandatangan Digital</td>
          <td><?=is_image($ttd_digital)?></td>
        </tr>
        <tr>
          <td>Link Berkas</td>
          <td><?=$link_drive?></td>
        </tr>
        <tr>
          <td>Status</td>
          <td><?=$status_warga?></td>
        </tr>
        <tr>
          <td>Tgl dibuat</td>
          <td><?=$tgl_dibuat != "" ? date('d-m-Y H:i',strtotime($tgl_dibuat)):""?></td>
        </tr>
        </table>

        <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
      </div>
    </div>
  </div>
</div>
