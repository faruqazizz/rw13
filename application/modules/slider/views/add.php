<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
          <form action="<?=$action?>" id="form" autocomplete="off">

          <div class="form-group">
            <label>Judul Foto</label>
            <input type="text" class="form-control form-control-sm" placeholder="Judul Foto" name="judul_foto" id="judul_foto">
          </div>

          <div class="form-group">
            <label>Lokasi Foto</label>            
            <input type="file" name="img" class="file-upload-default" data-id="lokasi_foto"/>
            <div class="input-group col-xs-12">
              <input type="hidden" class="file-dir" name="file-dir-lokasi_foto" data-id="lokasi_foto"/>
              <input type="text" class="form-control form-control-sm file-upload-info file-name" data-id="lokasi_foto" placeholder="Lokasi Foto" readonly name="lokasi_foto" />
            <span class="input-group-append">
              <button class="btn-remove-image btn btn-danger btn-sm" type="button" data-id="lokasi_foto" style="display:<?=$lokasi_foto!=''?'block':'none'?>;"><i class="ti-trash"></i></button>
              <button class="file-upload-browse btn btn-primary btn-sm" data-id="lokasi_foto" type="button">Select File</button>
            </span>
          </div>
          <small>Ukuran gambar sebaiknya < 680 piksel</small>
            <div id="lokasi_foto"></div>
          </div>

          <div class="form-group">
            <label>Status</label>
            <!--
              app_helper.php - methode is_select
              is_select("table", "attribute`id & name`", "value", "label", "entry_value`optional`");
            --->
            <?=is_select("stts","id_stts","id","keterangan");?>
          </div>

          <input type="hidden" name="submit" value="add">

          <div class="text-right">
            <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger"><?=cclang("cancel")?></a>
            <button type="submit" id="submit"  class="btn btn-sm btn-primary"><?=cclang("save")?></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
$("#form").submit(function(e){
e.preventDefault();
var me = $(this);
$("#submit").prop('disabled',true).html('Loading...');
$(".form-group").find('.text-danger').remove();
$.ajax({
      url             : me.attr('action'),
      type            : 'post',
      data            :  new FormData(this),
      contentType     : false,
      cache           : false,
      dataType        : 'JSON',
      processData     :false,
      success:function(json){
        if (json.success==true) {
          location.href = json.redirect;
          return;
        }else {
          $("#submit").prop('disabled',false)
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
