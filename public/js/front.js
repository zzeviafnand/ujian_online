$(document).ready(function () {

    // ------------------------------------------------------- //
    // Custom Scrollbar
    // ------------------------------------------------------ //

    if ($(window).outerWidth() > 992) {
        $("nav.side-navbar").mCustomScrollbar({
            scrollInertia: 200
        });
    }

    // Main Template Color
    var brandPrimary = '#33b35a';

    // ------------------------------------------------------- //
    // Side Navbar Functionality
    // ------------------------------------------------------ //
    $('#toggle-btn').on('click', function (e) {

        e.preventDefault();

        if ($(window).outerWidth() > 1194) {
            $('nav.side-navbar').toggleClass('shrink');
            $('.page').toggleClass('active');
        } else {
            $('nav.side-navbar').toggleClass('show-sm');
            $('.page').toggleClass('active-sm');
        }
    });

    // ------------------------------------------------------- //
    // Tooltips init
    // ------------------------------------------------------ //

    $('[data-toggle="tooltip"]').tooltip()

    // ------------------------------------------------------- //
    // Universal Form Validation
    // ------------------------------------------------------ //

    $('.form-validate').each(function() {
        $(this).validate({
            errorElement: "div",
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            ignore: ':hidden:not(.summernote),.note-editable.card-block',
            errorPlacement: function (error, element) {
                // Add the `invalid-feedback` class to the error element
                error.addClass("invalid-feedback");
                //console.log(element);
                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.siblings("label"));
                }
                else {
                    error.insertAfter(element);
                }
            }
        });
    });
    // ------------------------------------------------------- //
    // Material Inputs
    // ------------------------------------------------------ //

    var materialInputs = $('input.input-material');

    // activate labels for prefilled values
    materialInputs.filter(function () {
        return $(this).val() !== "";
    }).siblings('.label-material').addClass('active');

    // move label on focus
    materialInputs.on('focus', function () {
        $(this).siblings('.label-material').addClass('active');
    });

    // remove/keep label on blur
    materialInputs.on('blur', function () {
        $(this).siblings('.label-material').removeClass('active');

        if ($(this).val() !== '') {
            $(this).siblings('.label-material').addClass('active');
        } else {
            $(this).siblings('.label-material').removeClass('active');
        }
    });

    // ------------------------------------------------------- //
    // Jquery Progress Circle
    // ------------------------------------------------------ //
    // var progress_circle = $("#progress-circle").gmpc({
    //     color: brandPrimary,
    //     line_width: 5,
    //     percent: 80
    // });
    // progress_circle.gmpc('animate', 80, 3000);

    // ------------------------------------------------------- //
    // External links to new window
    // ------------------------------------------------------ //

    $('.external').on('click', function (e) {

        e.preventDefault();
        window.open($(this).attr("href"));
    });

    // ------------------------------------------------------ //
    // For demo purposes, can be deleted
    // ------------------------------------------------------ //

    // var stylesheet = $('link#theme-stylesheet');
    // $("<link id='new-stylesheet' rel='stylesheet'>").insertAfter(stylesheet);
    // var alternateColour = $('link#new-stylesheet');
    //
    // if ($.cookie("theme_csspath")) {
    //     alternateColour.attr("href", $.cookie("theme_csspath"));
    // }
    //
    // $("#colour").change(function () {
    //
    //     if ($(this).val() !== '') {
    //
    //         var theme_csspath = 'css/style.' + $(this).val() + '.css';
    //
    //         alternateColour.attr("href", theme_csspath);
    //
    //         $.cookie("theme_csspath", theme_csspath, {
    //             expires: 365,
    //             path: document.URL.substr(0, document.URL.lastIndexOf('/'))
    //         });
    //
    //     }
    //
    //     return false;
    // });

    /**
     * @return Febri Hidayan
     */
    $(function(){
      $(document).on('click', '.btn-add', function(e) {
        e.preventDefault();

        var controlForm = $('.controls:first'),
        currentEntry = $(this).parents('.entry:first'),
        newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add').removeClass('btn-add').addClass('btn-remove').removeClass('btn-success').addClass('btn-danger').html('<span class="fa fa-minus"></span>');
      }).on('click', '.btn-remove', function(e) {
        $(this).parents('.entry:first').remove();
        e.preventDefault();
        return false;
      });
    });
    $('.menuhome').click( function() {
      $('#menupage').load('resource/views/dashboard/_home.php', {page: 'nuybcrsuyhncgr3w7rfbci8r7wirb73t'});
      $('.menuActive').removeClass('active');
      $('.pageRemove').remove();
      $('#Achome').addClass('active');
      $('.down a').attr('aria-expanded', 'false');
      $('#nilaiDropdown').removeClass('show');
      changeurl('index.php');
    });
    $('#Achome').click( function() {
      $('#menupage').load('resource/views/dashboard/_home.php', {page: 'nuybcrsuyhncgr3w7rfbci8r7wirb73t'});
      $('.menuActive').removeClass('active');
      $('.pageRemove').remove();
      $('#Achome').addClass('active');
      $('.down a').attr('aria-expanded', 'false');
      $('#nilaiDropdown').removeClass('show');
      changeurl('index.php');
    });


  // Disable
  // $('body').on('contextmenu', function() {
  //   return false;
  // });
  // document.onkeydown = function(e) {
  //   if(event.keyCode == 123) {
  //   return false;
  //   }
  //   if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
  //   return false;
  //   }
  //   if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
  //   return false;
  //   }
  //   if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
  //   return false;
  //   }
  // }

});
/**
 * @return Febri Hidayan
 */
function getMessages() {
  $('#messages').load('resource/views/data/_msg.php');
}
function deleteRecord(link, id) {
  if (confirm('Anda yakin ingin menghapus data tersebut?')) {
    $.ajax({
      type: 'POST',
      url: link,
      data: {id: id},
      success: function(data) {
        $('#table-'+id).remove();
        return getMessages();
      }
    });
  }
}
// function loading() {
//   $('.loading-gif').fadeOut("slow");
// }
function queryRequest(url, fields) {
  $('form').submit( function(e) {
      e.preventDefault();
      $.ajax({
          type: 'POST',
          url: url,
          data: fields,
          cache: false,
          success: function(data) {

          }
      });
  });
}
