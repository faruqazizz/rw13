<div class="row">
    <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
        <div class="card m-b-30">
            <div class="card-header bg-primary text-white">
                <?=ucwords($title_module)?>
            </div>
            <div class="card-body">
                <form action="<?=$action?>" id="form" autocomplete="off">

                    <div class="form-group d-none">
                        <label>Kategori</label>
                        <?=is_select("kategori_konten","id_kategori","id","nama_kategori",2);?>
                    </div>

                    <div class="form-group">
                        <label>Nama Galeri</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Nama Galeri"
                            name="nama_galeri" id="nama_galeri" maxlength="50">
                    </div>

                    <div class="form-group">
                        <label>Deskripsi kegiatan</label>
                        <textarea class="form-control form-control-sm" placeholder="Deskripsi kegiatan"
                            name="deskripsi_kegiatan" id="deskripsi_kegiatan" rows="3" cols="80"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Cover</label>
                        <input type="file" name="img" class="file-upload-default" data-id="cover" />
                        <div class="input-group col-xs-12">
                            <input type="hidden" class="file-dir" name="file-dir-cover" data-id="cover" />
                            <input type="text" class="form-control form-control-sm file-upload-info file-name"
                                data-id="cover" placeholder="Cover" readonly name="cover" />
                            <span class="input-group-append">
                                <button class="btn-remove-image btn btn-danger btn-sm" type="button" data-id="cover"
                                    style="display:<?=$cover!=''?'block':'none'?>;"><i class="ti-trash"></i></button>
                                <button class="file-upload-browse btn btn-primary btn-sm" data-id="cover"
                                    type="button">Select File</button>
                            </span>
                        </div>
                        <div id="cover"></div>
                    </div>

                    <div class="form-group">
                        <label>Status galeri</label>
                        <!--
              app_helper.php - methode is_select
              is_select("table", "attribute`id & name`", "value", "label", "entry_value`optional`");
            --->
                        <?=is_select("stts","status_galeri","id","keterangan");?>
                    </div>

                    <input type="hidden" name="submit" value="add">

                    <div class="text-right">
                        <a href="<?=url($this->uri->segment(2))?>"
                            class="btn btn-sm btn-danger"><?=cclang("cancel")?></a>
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