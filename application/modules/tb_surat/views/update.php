<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <form action="<?=$action?>" id="form" autocomplete="off">
          
                <div class="form-group">
                <label>Jenis surat</label>
						<?php if($id_status_surat == 2 ||$id_status_surat == 4 ||$id_status_surat == 5 ){ ?>
						<div style="pointer-events: none; background-color: #e9ecef;">
						<?=is_select("tb_jenis_surat","id_jenis_surat","id","nama_surat","$id_jenis_surat");?>
						<?php } else{ ?>
						<div <?= profile('id_group') > 3 || profile('id_group') == 2 ? 'style="pointer-events: none; background-color: #e9ecef;"' : '' ?>>
						<?=is_select("tb_jenis_surat","id_jenis_surat","id","nama_surat","$id_jenis_surat");?>
						<?php } ?>
					</div>
                </div>
                      
                <div class="form-group <?= profile('id_group') == 3 ? 'd-none' : '' ?>">
                <label>Warga</label>
                <div <?= profile('id_group') >= 3 || profile('id_group') == 2 ? 'style="pointer-events: none; background-color: #e9ecef;"' : '' ?>>
                  <?=is_select_dua("warga","id_warga","id","no_ktp","nama_lengkap","$id_warga");?>
                </div>
                <div class="text-center">
                  <a href="<?php echo url("warga_dokumen/lihat/".enc_url($id_warga)) ?>" target="_blank" class="btn btn-info my-2">Lihat Lampiran</a>
                </div>
                                          </div>
                                          
                                          <div class="form-group">
                                <label>Keperluan</label>
                                                            <textarea class="form-control form-control-sm" placeholder="Keperluan" name="keperluan" id="keperluan" rows="3" cols="80" <?= profile('id_group') > 3 || profile('id_group') == 2 ? 'style="pointer-events: none; background-color: #e9ecef;"' : '' ?>><?=$keperluan?></textarea>
                                                          </div>

                          <div class="form-group <?= profile('id_group') == 3 ? 'd-none' : '' ?>">
                <label>Nomor surat</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Nomor surat" name="nomor_surat" id="nomor_surat" value="<?=$nomor_surat?>">
                                          </div>
                          
              <div class="form-group <?= profile('id_group') > 2 ? 'd-none' : '' ?>">
                <label>Nomor surat RW</label>
                <input type="text" class="form-control form-control-sm" placeholder="Nomor surat RW" name="no_surat_rw" id="no_surat_rw" value="<?=$no_surat_rw?>">
              </div>
                      
<div class="form-group">
  <label>Status surat</label>
  <div <?= profile('id_group') == 3 ? 'style="pointer-events: none; background-color: #e9ecef;"' : '' ?>>
    <?php
    if (sess('groupnya') == 1 || sess('groupnya') == 3) {
      echo is_select("tb_status_surat", "id_status_surat", "id", "nama_status", $id_status_surat);
    } elseif (sess('groupnya') == 2) {
      // $table, $id_name, $id_field, $name_field, $value, $tanda,$idnya
      echo is_combo("tb_status_surat", "id_status_surat", "id", "nama_status", $id_status_surat, "between 4 and ","5");
    } else {
      echo is_combo("tb_status_surat","id_status_surat","id","nama_status", $id_status_surat, "between 2 and ","3");
    }
    ?>
  </div>
</div>


                      
                                          <div class="form-group">
                <label>Revisi</label>
                                            <textarea <?= profile('id_group') == 3 ? 'style="pointer-events: none; background-color: #e9ecef;"' : '' ?> class="form-control form-control-sm" placeholder="Belum ada revisi" name="revisi" id="revisi" rows="3" cols="80"><?=$revisi?></textarea>
                                            <span class="text-small"><i>* Tambahkan catatan revisi jika ada yang perlu diperbaiki.</i></span>
                                          </div>

                          <div class="form-group <?= profile('id_group') >= 3 ? 'd-none' : '' ?>">
                <label>Tgl keputusan</label>
                                            <input type="date" class="form-control form-control-sm" placeholder="Tgl keputusan" name="tgl_keputusan" id="tgl_keputusan" value="<?= date('Y-m-d')?>" max="<?=date('Y-m-d')?>">
                                          </div>
                      
                          <div class="form-group <?= profile('id_group') >= 3 ? 'd-none' : '' ?>">
                <label>Validator</label>
                <div style="pointer-events: none; background-color: #e9ecef;">
                  <?=is_combo("auth_group","id_group","id","group",$id_group,">=","4")?>
                </div>
                                          </div>                 
                          
          <input type="hidden" name="submit" value="update">

          <div class="text-right">
            <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger"><?=cclang("cancel")?></a>
            <button type="submit" id="submit" class="btn btn-sm btn-primary"><?=cclang("update")?></button>
          </div>
        </form>
        <?php if($id_status_surat == 1){ ?>
          <a href="<?= $idnya ?>" id="Hapus Ajuan" class="btn btn-warning btn-sm" title="Hapus Ajuan"><i class="ti-trash"></i> Hapus Ajuan</a>
        <?php } ?>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $("#form").submit(function(e) {
    e.preventDefault();
    var me = $(this);
    $("#submit").prop('disabled', true).html('Loading...');
    $(".form-group").find('.text-danger').remove();
    $.ajax({
      url: me.attr('action'),
      type: 'post',
      data: new FormData(this),
      contentType: false,
      cache: false,
      dataType: 'JSON',
      processData: false,
      success: function(json) {
        if (json.success == true) {
          location.href = json.redirect;
          return;
        } else {
          $("#submit").prop('disabled', false)
            .html('<?=cclang("save")?>');
          $.each(json.alert, function(key, value) {
            var element = $('#' + key);
            $(element)
              .closest('.form-group')
              .find('.text-danger').remove();
            $(element).after(value);
          });
        }
      }
    });
  });
</script>