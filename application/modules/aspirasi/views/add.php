<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
          <form action="<?=$action?>" id="form" autocomplete="off">

          <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control form-control-sm" placeholder="Email" name="email" id="email">
          </div>

          <div class="form-group">
            <label>Subjek aduan</label>
            <input type="text" class="form-control form-control-sm" placeholder="Subjek aduan" name="subjek_aduan" id="subjek_aduan">
          </div>

          <div class="form-group">
            <label>Isi aspirasi</label>
            <textarea class="form-control form-control-sm" placeholder="Isi aspirasi" name="isi_aspirasi" id="isi_aspirasi" rows="3" cols="80"></textarea>
          </div>

          <div class="form-group">
            <label>Ip address</label>
            <input type="text" class="form-control form-control-sm" placeholder="Ip address" name="ip_address" id="ip_address">
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