require('./bootstrap');
require('@themesberg/flowbite')

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$(document).ready(function () {
    $('.skills-select').select2({
        placeholder: "-- Choose Skills --"
    });
});
