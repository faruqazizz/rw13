(function($) {
    showToast = function(type, msg) {
      'use strict';
      $.toast({
        text: msg,
        showHideTransition: 'slide',
        loaderBg: '#f96868',
        icon: type,
        position: 'bottom-left',
        hideAfter: 5000
      })
    };

    // slug typing
    $(document).ready(function() {
      // memeriksa apakah elemen dengan id 'judul' dan id 'slug' tersedia
      if ($('#judul').length && $('#slug').length) {
        // saat input judul diisi atau diubah
        $('#judul').on('keyup', function() {
          // mengambil nilai input judul
          var judul = $(this).val();
          // membuat slug dari nilai input judul
          var slug = slugify(judul);
          // mengisi nilai input slug
          $('#slug').val(slug);
        });
      }
    
      // fungsi untuk membuat slug dari string
      function slugify(text) {
        return text.toString().toLowerCase()
          .replace(/\s+/g, '-')        // mengganti spasi dengan tanda hubung
          .replace(/[^\w\-]+/g, '')   // menghapus karakter non-alfanumerik
          .replace(/\-\-+/g, '-')      // mengganti beberapa tanda hubung berurutan dengan satu tanda hubung
          .replace(/^-+/, '')          // menghapus tanda hubung di awal string
          .replace(/-+$/, '');         // menghapus tanda hubung di akhir string
      }
    });
    
    

    //copy text
    $(document).on('click','#copyboard', function(e) {
      e.preventDefault();
      var copyText = $(this).attr('data-text');
      var textarea = document.createElement("textarea");
      textarea.textContent = copyText;
      textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in MS Edge.
      document.body.appendChild(textarea);
      textarea.select();
      document.execCommand("copy");
      document.body.removeChild(textarea);
      showToast("info","Copy Success");
    });


     //tool tip
     /* Code for attribute data-custom-class for adding custom class to tooltip */
     if (typeof $.fn.tooltip.Constructor === 'undefined') {
       throw new Error('Bootstrap Tooltip must be included first!');
     }

     var Tooltip = $.fn.tooltip.Constructor;

     // add customClass option to Bootstrap Tooltip
     $.extend(Tooltip.Default, {
       customClass: ''
     });

     var _show = Tooltip.prototype.show;

     Tooltip.prototype.show = function() {

       // invoke parent method
       _show.apply(this, Array.prototype.slice.apply(arguments));

       if (this.config.customClass) {
         var tip = this.getTipElement();
         $(tip).addClass(this.config.customClass);
       }

     };
     $('[data-toggle="tooltip"]').tooltip();
})(jQuery);
