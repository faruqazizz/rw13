<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <form action="<?=$action?>" id="form" autocomplete="off">
          
                          <div class="form-group">
                <label>RT</label>
                                            <!--
              app_helper.php - methode is_select
              is_select("table", "attribute`id & name`", "value", "label", "entry_value`optional`");
            --->
            <?=is_combo("auth_group","id_group","id","group",$id_group,">=","4")?>
                                          </div>
                      
                          <div class="form-group">
                <label>Gambar Kop</label>
                                            <input type="file" name="img" class="file-upload-default" data-id="gambar_kop" />
                <div class="input-group col-xs-12">
                  <input type="hidden" class="file-dir" name="file-dir-gambar_kop" data-id="gambar_kop" />
                  <input type="text" class="form-control form-control-sm file-upload-info file-name" data-id="gambar_kop" placeholder="Gambar Kop" readonly name="gambar_kop" value="<?=$gambar_kop?>" />
                  <span class="input-group-append">
                    <button class="btn-remove-image btn btn-danger btn-sm" type="button" data-id="gambar_kop" style="display:<?=$gambar_kop!=''?'block':'none'?>;"><i class="ti-trash"></i></button>
                    <button class="file-upload-browse btn btn-primary btn-sm" data-id="gambar_kop" type="button">Select File</button>
                  </span>
                </div>
                <div id="gambar_kop"></div>
                                          </div>
                      
                          <div class="form-group">
                <label>RT Berapa</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="RT Berapa" name="nama" id="nama" value="<?=$nama?>">
                                          </div>
                      
                          <div class="form-group">
                <label>Alamat</label>
                                            <textarea class="form-control form-control-sm" placeholder="Alamat" name="alamat" id="alamat" rows="3" cols="80"><?=$alamat?></textarea>
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