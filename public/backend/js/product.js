$(function() {
    var $group = $('#group_id');
    var $category = $('#category_id');

    // On change category, load nested group select
    $category.change(function(event) {
        var category = $(this);
        var group_id = $group.data('id');

        // reset select group
        $group.html('<option>Loading....</option>').parent().removeClass('has-error');

        // ajax request
        $.get(app.url + 'groups', {category_id: category.val() }, function(response) {
            if (response.success == true) {
                var options = response.data;
                // enable and reset select group
                $group.html('').attr('disabled', false);
                // append new options
                $.each(options ,function(key, o) {
                    var selected = (group_id == o.group_id) ? true : false;
                    var icon = o.active == 1 ? 'pull-right glyphicon glyphicon-ok-circle color-green' : 'pull-right glyphicon glyphicon-ban-circle color-red';
                    $group.append($("<option></option>").attr({"value":o.group_id, "selected": selected}).text(o.name).data('icon', icon));
                });
            } else {
                $group.parent().addClass('has-error');
                // create and set default option
                $group.html('').append($("<option></option>").text($group.data('error-text'))).attr('disabled', true);
            }

            $group.selectpicker();
        });
    });

    // Auto trigger select or create/set default option
    if ( $group.data('id') ) {
        $category.trigger('change');
    } else {
        $group.append($("<option></option>").text($('#group_id').data('empty-text'))).attr('disabled', true);
    }

    // features table
    $('#features').DataTable({
        "columnDefs": [
            { "visible": false, "targets": 2 }
        ],
        "order": [[ 2, 'asc' ]],
        "bPaginate": false,
        "paging":   false,
        "info":     false,
        "bSort": false,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last = null;

            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq(i).before(
                        '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                    );

                    last = group;
                }
            } );
        }
    });

    // features table: autosave
    $('[data-autosave]').on('keydown', function(e) {
        var $t = $(this);
        var $keyCode = e.keyCode || e.which;

        if ($keyCode == 13 || $keyCode == 9) {
            $t.removeClass('modified');
            var url = $t.data('autosave');
            var field = $t.data('field');
            var params = {value: $t.val(), field: field};

            $.getJSON(url, params, function(response, textStatus) {
                var type = response.success == true ? 'success' : 'error';
                var message = response.success == true ? 'The feature "<strong>'+$t.data('name')+'</strong>" was update successful' : 'An error an ocurred, please try again.';

                new PNotify({
                    title: 'Notification',
                    text: message,
                    type: type
                });
            });

        }
    });

    $('[data-autosave]').on('input', function(e) {
        var $t = $(this);

        if ($t.val() != $t.data('oldValue')) {
            $t.addClass('modified')
        } else {
            $t.removeClass('modified')
        }
    });

});