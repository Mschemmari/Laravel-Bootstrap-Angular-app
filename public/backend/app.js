$(function () {
    /**
     *  Nice and fat features!
     *   - Switch for radios butttons
     *   - Tooltip
     *   - Rich text editor
     *   - Ladda for buttons
     *   - Select2
     *   - Datatable
     *   - Remodal
     *
     */

    PNotify.prototype.options.styling = "bootstrap3";
    PNotify.prototype.options.cornerclass = "ui-pnotify-sharp";
    PNotify.prototype.options.shadow = false;
    // PNotify.prototype.options.buttons.sticker = false;

    // auto redirect for selectpicker
    $('[data-redirect]').on('change', function(){
        var href = $(this).find("option:selected").data('href');
        location.href = href;
    });

    $("[data-switch]").bootstrapSwitch();
    $('[data-toggle="tooltip"]').tooltip();

    $('[data-rich-text]').tinymce({
        theme: "modern",
        skin: "light",
        menubar: false,
        statusbar: false,
        plugins : "paste",
        paste_auto_cleanup_on_paste : true
    })

    $('[data-ladda]').ladda( 'bind' );

    $('[data-select]').selectpicker();

    // $('[data-select]').selectpicker();

    /*$('[data-table]').each(function(index, el) {
        var data = $(this).data(),
            lengthMenu = data.lengthMenu || 25;

        $(this).dataTable({
            "bLengthChange": false,
            "lengthMenu": [lengthMenu],
        });
    });*/

    // Toggle navbar
    $('.navbar-toggle').click(function () {
        $('.navbar-nav').toggleClass('slide-in');
        $('#side-body').toggleClass('body-slide-in');
        $('#search').removeClass('in').addClass('collapse').slideUp(200);

        $('.absolute-wrapper').toggleClass('slide-in');

    });

   // Remove menu for searching
   $('#search-trigger').click(function () {
        $('.navbar-nav').removeClass('slide-in');
        $('#side-body').removeClass('body-slide-in');

        $('.absolute-wrapper').removeClass('slide-in');

    });

    // Collapse submenu
    $('#side-menu-container > ul').find('.active > .panel-collapse').toggleClass('collapse').toggleClass('in');

    // Check all
    $('.select-all').checkAll('[data-table] input:checkbox');

    // Enable/Disable delete button
    $('[data-table] input:checkbox').on('click', function() {
        if ($('[data-table] input:checkbox:checked').length) {
            $('.btn-delete').removeClass('disabled');
        } else {
            $('.btn-delete').addClass('disabled');
        }
    });

    // Open modal
    // $('[data-popup]').on('click', function(){
    //     $(document).remodal().open();
    // });
});
