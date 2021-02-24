window._ = require('lodash');

try {
    global.Popper = require('popper.js').default;
    global.$ = global.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
