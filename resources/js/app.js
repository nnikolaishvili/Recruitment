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
});
