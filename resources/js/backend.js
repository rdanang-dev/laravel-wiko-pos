window.$ = window.jQuery = require('jquery');
window.Popper = require('popper.js').default;

require('./bootstrap');

// bootstrap datatables...
require('jszip');
require('pdfmake');
require('datatables.net');
require('datatables.net-bs4');
require('datatables.net-buttons-bs4');
require('datatables.net-buttons/js/buttons.colVis.js');
require('datatables.net-buttons/js/buttons.flash.js');
require('datatables.net-buttons/js/buttons.html5.js');
require('datatables.net-buttons/js/buttons.print.js');
require('datatables.net-autofill-bs4');
require('datatables.net-fixedheader-bs4');
require('datatables.net-responsive-bs4');
require('datatables.net-scroller-bs4');
require('datatables.net-select-bs4');
// bs4 no js - require direct component
// styling only packages for bs4
require('datatables.net-keytable');
