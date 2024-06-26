<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <form action="<?=$action?>" id="form" autocomplete="off">
          
          <div class="form-group">
            <label for="no_kk">No KK</label>
            <input type="text" class="form-control form-control-sm" placeholder="No KK" name="no_kk" id="no_kk" maxlength="16" required>
          </div>
                      
          <div class="form-group">
            <label for="no_ktp">No KTP</label>
            <input type="text" class="form-control form-control-sm" placeholder="No KTP" name="no_ktp" id="no_ktp" maxlength="16" required>
          </div>
                      
          <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" class="form-control form-control-sm" placeholder="Nama Lengkap" name="nama_lengkap" id="nama_lengkap" maxlength="50" required>
          </div>
                      
          <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" class="form-control form-control-sm" placeholder="Tempat Lahir" name="tempat_lahir" id="tempat_lahir" maxlength="50" required>
          </div>
                      
          <div class="form-group">
            <label for="tgl_lahir">Tgl Lahir</label>
            <input type="date" class="form-control form-control-sm" placeholder="Tgl Lahir" name="tgl_lahir" id="tgl_lahir" max="<?=date('Y-m-d')?>" required>
          </div>
                      
          <div class="form-group">
            <label for="hp">Nomor Handphone</label>
            <input type="text" class="form-control form-control-sm" placeholder="Nomor Handphone" name="hp" id="hp" maxlength="13" required>
          </div>
                      
          <div class="form-group">
            <label for="jenis_kelamin">Jenis kelamin</label>
            <?=is_select("kelamin","jenis_kelamin","id","nama");?>
          </div>
                      
          <div class="form-group">
            <label for="agama">Agama</label>
            <?=is_select("agama","agama","id","nama");?>
          </div>
                      
          <div class="form-group">
            <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
            <?=is_select("pendidikan_terakhir","pendidikan_terakhir","id","nama");?>
          </div>
                      
          <div class="form-group">
            <label for="id_profesi">Profesi</label>
            <?=is_select("profesi","id_profesi","id","nama_profesi");?>
          </div>
                      
          <div class="form-group">
            <label for="id_group">RT</label>
            <?=is_combo("auth_group","id_group","id","group",$id_group,">=","4")?>
            </div>
            <div class="form-group">
                <label>Alamat (No Rumah)</label>
                                            <textarea class="form-control form-control-sm" placeholder="Alamat (No Rumah)" name="alamat" id="alamat" rows="3" cols="80" required></textarea>
                                          </div>
                      
                          <div class="form-group">
                <label>Foto Profil</label>
                                            <input type="file" name="img" class="file-upload-default" data-id="foto_profil" />
                <div class="input-group col-xs-12">
                  <input type="hidden" class="file-dir" name="file-dir-foto_profil" data-id="foto_profil" />
                  <input type="text" class="form-control form-control-sm file-upload-info file-name" data-id="foto_profil" placeholder="Foto Profil" readonly name="foto_profil" />
                  <span class="input-group-append">
                    <button class="btn-remove-image btn btn-danger btn-sm" type="button" data-id="foto_profil" style="display:<?=$foto_profil!=''?'block':'none'?>;"><i class="ti-trash"></i></button>
                    <button class="file-upload-browse btn btn-primary btn-sm" data-id="foto_profil" type="button">Select File</button>
                  </span>
                </div>
                <div id="foto_profil"></div>
                                          </div>
                      
                          <div class="form-group">
                <label>Tandatangan Digital</label>
                                            <input type="file" name="img" class="file-upload-default" data-id="ttd_digital" />
                <div class="input-group col-xs-12">
                  <input type="hidden" class="file-dir" name="file-dir-ttd_digital" data-id="ttd_digital" />
                  <input type="text" class="form-control form-control-sm file-upload-info file-name" data-id="ttd_digital" placeholder="Tandatangan Digital" readonly name="ttd_digital"/>
                  <span class="input-group-append">
                    <button class="btn-remove-image btn btn-danger btn-sm" type="button" data-id="ttd_digital" style="display:<?=$ttd_digital!=''?'block':'none'?>;"><i class="ti-trash"></i></button>
                    <button class="file-upload-browse btn btn-primary btn-sm" data-id="ttd_digital" type="button">Select File</button>
                  </span>
                </div>
                <div id="ttd_digital"></div>
                                          </div>
                      
                          <div class="form-group d-none">
                <label>Link Berkas</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Link Berkas" name="link_drive" id="link_drive">
                                          </div>
                     
                      <div class="form-group">
            <label>Status Warga</label>
            <?=is_select("status_warga","status_warga","id","nama_stts_warga");?>
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

<script>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" rel="stylesheet"></link>
<script>
$(document).ready(function(){
$("#form").validate({
  rules: {
    no_kk: {
      required: true,
      maxlength: 16
    },
    no_ktp: {
      required: true,
      maxlength: 16
    },
    nama_lengkap: {
      required: true,
      maxlength: 50
    },
    tempat_lahir: {
      required: true,
      maxlength: 50
    },
    tgl_lahir: {
      required: true,
      date: true
    },
    hp: {
      required: true,
      maxlength: 13
    },
    jenis_kelamin: {
      required: true
    },
    agama: {
      required: true
    },
    pendidikan_terakhir: {
      required: true
    },
    id_profesi: {
      required: true
    },
    id_group: {
      required: true
    },
    alamat: {
      required: true
    },
    status_warga: {
      required: true
    }
  },
  messages: {
    no_kk: {
      required: "No KK wajib diisi",
      maxlength: "No KK maksimal 16 karakter"
    },
    no_ktp: {
      required: "No KTP wajib diisi",
      maxlength: "No KTP maksimal 16 karakter"
    },
    nama_lengkap: {
      required: "Nama lengkap wajib diisi",
      maxlength: "Nama lengkap maksimal 50 karakter"
    },
    tempat_lahir: {
      required: "Tempat lahir wajib diisi",
      maxlength: "Tempat lahir maksimal 50 karakter"
    },
    tgl_lahir: {
      required: "Tanggal lahir wajib diisi",
      date: "Tanggal lahir harus dalam format YYYY-MM-DD"
    },
    hp: {
      required: "Nomor handphone wajib diisi",
      maxlength: "Nomor handphone maksimal 13 karakter"
    },
    jenis_kelamin: {
      required: "Jenis kelamin wajib diisi"
    },
    agama: {
      required: "Agama wajib diisi"
    },
    pendidikan_terakhir: {
      required: "Pendidikan terakhir wajib diisi"
    },
    id_profesi: {
      required: "Profesi wajib diisi"
},
id_group: {
required: "RT wajib diisi"
},
alamat: {
required: "Alamat wajib diisi"
},
status_warga: {
required: "Status warga wajib diisi"
}
}
});
});
</script>