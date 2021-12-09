require('./bootstrap');
require('@themesberg/flowbite')
require('select2/dist/js/select2.min');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$(document).ready(function () {
    $('.skills-select').select2();

    if ($('.skills-select').length) {
        if (JSON.parse($('.skills-select').attr('data-ids')).length) {
            $('.skills-select').val(JSON.parse($('.skills-select').attr('data-ids'))).trigger('change');
        }
    }

    $('#delete-candidate').on('submit', function () {
       return confirm('Are you sure?')
    });

    $('#status-update #hiring_status_id').on('change', function () {
        if ($(this).attr('data-current_status') === $(this).val()) {
            $('#status-update #comment').addClass('bg-gray-100')
            $('#status-update #comment').attr('disabled', true);
        } else {
            $('#status-update #comment').removeClass('bg-gray-100').removeAttr('disabled');
        }
    })
});
