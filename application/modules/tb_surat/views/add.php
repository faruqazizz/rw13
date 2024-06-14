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
                <?=is_select("tb_jenis_surat","id_jenis_surat","id","nama_surat");?>
                                          </div>
                      
                          <div class="form-group <?= profile('id_group') == 3 ? 'd-none' : '' ?>">
                <label>Warga</label>
                
            <?=is_select_dua("warga","id_warga","id","no_ktp","nama_lengkap", $id_warga);?>
                                          </div>
                      
                                          <div class="form-group">
                <label>Keperluan</label>
                                            <textarea class="form-control form-control-sm" placeholder="Keperluan" name="keperluan" id="keperluan" rows="3" cols="80"></textarea>
                                          </div>

                          <div class="form-group <?= profile('id_group') == 3 || profile('id_group') == 2 ? 'd-none' : '' ?>">
                <label>Nomor surat</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Nomor surat" name="nomor_surat" id="nomor_surat">
                                          </div>
                                               
                          <div class="form-group <?= profile('id_group') >= 3 || profile('id_group') == 2 ? 'd-none' : '' ?>">
                <label>Status surat</label>
                
                <?=is_select("tb_status_surat","id_status_surat","id","nama_status", $id_status_surat);?>
                                          </div>
                      
                          <div class="form-group <?= profile('id_group') >= 3 || profile('id_group') == 2 ? 'd-none' : '' ?>">
                <label>Tgl keputusan</label>
                                            <input type="date" class="form-control form-control-sm" placeholder="Tgl keputusan" name="tgl_keputusan" id="tgl_keputusan">
                                          </div>
                      
                          <div class="form-group <?= profile('id_group') >= 3 ? 'd-none' : '' ?>">
                <label>Validator</label>
                
                <?=is_combo("auth_group","id_group","id","group",$id_group,">=","4")?>
                                          </div>
                      
                          <div class="form-group <?= profile('id_group') >= 3 || profile('id_group') == 2 ? 'd-none' : '' ?>">
                <label>Revisi</label>
                                            <textarea class="form-control form-control-sm" placeholder="Revisi" name="revisi" id="revisi" rows="3" cols="80"></textarea>
                                          </div>
                      
                                                  
                                                  
          <input type="hidden" name="submit" value="add">

          <div class="text-right">
            <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger"><?=cclang("cancel")?></a>
            <button type="submit" id="submit" class="btn btn-sm btn-primary"><?=cclang("save")?></button>
          </div>
        </form>
        
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