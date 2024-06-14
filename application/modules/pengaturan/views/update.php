<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <form action="<?=$action?>" id="form" autocomplete="off">
          
                          <div class="form-group">
                <label>Deskripsi Web</label>
                                            <textarea class="form-control form-control-sm" placeholder="Deskripsi Web" name="deskripsi_web" id="deskripsi_web" rows="3" cols="80"><?=$deskripsi_web?></textarea>
                                          </div>
                      
                          <div class="form-group">
                <label>Alamat gmaps</label>
                                            <textarea class="form-control form-control-sm" placeholder="Alamat gmaps" name="alamat_gmaps" id="alamat_gmaps" rows="3" cols="80"><?=$alamat_gmaps?></textarea>
                                          </div>
                      
                          <div class="form-group">
                <label>Visi</label>
                                            <textarea class="form-control form-control-sm" placeholder="Visi" name="visi" id="visi" rows="3" cols="80"><?=$visi?></textarea>
                                          </div>
                      
                          <div class="form-group">
                <label>Misi</label>
                                            <textarea class="form-control form-control-sm" placeholder="Misi" name="misi" id="misi" rows="3" cols="80"><?=$misi?></textarea>
                                          </div>
                      
                          <div class="form-group">
                <label>Foto</label>
                                            <input type="file" name="img" class="file-upload-default" data-id="foto" />
                <div class="input-group col-xs-12">
                  <input type="hidden" class="file-dir" name="file-dir-foto" data-id="foto" />
                  <input type="text" class="form-control form-control-sm file-upload-info file-name" data-id="foto" placeholder="Foto" readonly name="foto" value="<?=$foto?>" />
                  <span class="input-group-append">
                    <button class="btn-remove-image btn btn-danger btn-sm" type="button" data-id="foto" style="display:<?=$foto!=''?'block':'none'?>;"><i class="ti-trash"></i></button>
                    <button class="file-upload-browse btn btn-primary btn-sm" data-id="foto" type="button">Select File</button>
                  </span>
                </div>
                <div id="foto"></div>
                                          </div>
                      
                          <div class="form-group">
                <label>Header</label>
                                            <input type="file" name="img" class="file-upload-default" data-id="header" />
                <div class="input-group col-xs-12">
                  <input type="hidden" class="file-dir" name="file-dir-header" data-id="header" />
                  <input type="text" class="form-control form-control-sm file-upload-info file-name" data-id="header" placeholder="Header" readonly name="header" value="<?=$header?>" />
                  <span class="input-group-append">
                    <button class="btn-remove-image btn btn-danger btn-sm" type="button" data-id="header" style="display:<?=$header!=''?'block':'none'?>;"><i class="ti-trash"></i></button>
                    <button class="file-upload-browse btn btn-primary btn-sm" data-id="header" type="button">Select File</button>
                  </span>
                </div>
                <div id="header"></div>
                                          </div>
                      
                          <div class="form-group">
                <label>Marquee</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Marquee" name="marquee" id="marquee" value="<?=$marquee?>">
                                          </div>
                      
                          <div class="form-group">
                <label>Tagline</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Tagline" name="tagline" id="tagline" value="<?=$tagline?>">
                                          </div>
                      
                          <div class="form-group">
                <label>Motto</label>
                                            <textarea class="form-control form-control-sm" placeholder="Motto" name="motto" id="motto" rows="3" cols="80"><?=$motto?></textarea>
                                          </div>
                      
                          <div class="form-group">
                <label>Tujuan</label>
                                            <textarea class="form-control form-control-sm" placeholder="Tujuan" name="tujuan" id="tujuan" rows="3" cols="80"><?=$tujuan?></textarea>
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