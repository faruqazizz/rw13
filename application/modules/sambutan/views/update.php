<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <form action="<?=$action?>" id="form" autocomplete="off">
          
                          <div class="form-group">
                <label>Judul sambutan</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Judul sambutan" name="judul_sambutan" id="judul_sambutan" value="<?=$judul_sambutan?>">
                                          </div>
                      
                          <div class="form-group d-none">
                <label>Ketua RW</label>
                <?=is_select("auth_user","nama_rw","id_user","name","$nama_rw");?>
                                          </div>
                      
                          <div class="form-group">
                <label>Foto Diri</label>
                                            <input type="file" name="img" class="file-upload-default" data-id="foto_diri" />
                <div class="input-group col-xs-12">
                  <input type="hidden" class="file-dir" name="file-dir-foto_diri" data-id="foto_diri" />
                  <input type="text" class="form-control form-control-sm file-upload-info file-name" data-id="foto_diri" placeholder="Foto Diri" readonly name="foto_diri" value="<?=$foto_diri?>" />
                  <span class="input-group-append">
                    <button class="btn-remove-image btn btn-danger btn-sm" type="button" data-id="foto_diri" style="display:<?=$foto_diri!=''?'block':'none'?>;"><i class="ti-trash"></i></button>
                    <button class="file-upload-browse btn btn-primary btn-sm" data-id="foto_diri" type="button">Select File</button>
                  </span>
                </div>
                <div id="foto_diri"></div>
                                          </div>
                      
                          <div class="form-group">
                <label>Sambutan</label>
                                            <textarea class="form-control text-editor" rows="3" data-original-label="sambutan_teks" name="sambutan_teks" id="sambutan_teks"><?=$sambutan_teks?></textarea>
                                          </div>
                      
                          <div class="form-group d-none">
                <label>Dokumentasi Lain</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Dokumentasi Lain" name="dokumentasi_lain" id="dokumentasi_lain" value="<?=$dokumentasi_lain?>">
                                          </div>
                      
          <input type="hidden" name="submit" value="update">

          <div class="text-right">
            <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger"><?=cclang("cancel")?></a>
            <button type="submit" id="submit" class="btn btn-sm btn-primary"><?=cclang("update")?></button>
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