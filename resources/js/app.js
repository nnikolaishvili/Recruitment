require('./bootstrap');
require('@themesberg/flowbite')

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$(function () {
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            placeholder: "-- Choose Skills --"
        });
    });
})
