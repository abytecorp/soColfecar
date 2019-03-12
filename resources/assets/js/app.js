
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('../assets/node_modules/jquery/jquery-3.2.1.min.js');
require('../assets/node_modules/popper/popper.min.js');
//xrequire('../assets/node_modules/bootstrap/dist/js/bootstrap.min.js');
require('../dist/js/perfect-scrollbar.jquery.min.js');
require('../dist/js/waves.js');
require('../dist/js/sidebarmenu.js');
require('../dist/js/custom.min.js');


require('../assets/node_modules/raphael/raphael-min.js');
require('../assets/node_modules/morrisjs/morris.min.js');
require('../assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js');
require('../assets/node_modules/switchery/dist/switchery.min.js');
require('../assets/node_modules/select2/dist/js/select2.full.min.js');
require('../assets/node_modules/bootstrap-select/bootstrap-select.min.js');
require('../assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js');
require('../assets/node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js');
require('../assets/node_modules/multiselect/js/jquery.multi-select.js');
require('../dist/js/form-addons.js');
require('../assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js');
require('../assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js');
require('../assets/node_modules/sparkline/jquery.sparkline.min.js');


// require( 'datatables.net' )

// require('../assets/node_modules/datatables/jquery.dataTables.min.js');
// require('../dist/js/dataTable.js');

// require('../assets/data_table/dataTables.buttons.min.js');
// require('../assets/data_table/buttons.flash.min.js');
// require('../assets/data_table/jszip.min.js');
// require('../assets/data_table/pdfmake.min.js');
// require('../assets/data_table/vfs_fonts.js');
// require('../assets/data_table/buttons.html5.min.js');
// require('../assets/data_table/buttons.print.min.js');





window.Vue = require('vue');
// require('../dist/js/pages/vue-select.js');
// Vue.component('v-select', VueSelect.VueSelect);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('create-event', require('./components/Create-event.vue'));
Vue.component('select2', require('./components/Select2.vue'));
Vue.component('ass-reg', require('./components/Ass-reg.vue').default);
Vue.component('events-dashboard', require('./components/Events-dashboard.vue').default);
Vue.component('contacts-cnt', require('./components/Contacts-cnt.vue'));
Vue.component('print-gafete', require('./components/Print-gafete.vue'));
Vue.component('external-insc', require('./components/External-Inscription.vue'));
Vue.component('trade-union-argumentation', require('./components/Trade-union-argumentation.vue').default);



Vue.component('dashboard-af', require('./components/Dashboard-af.vue').default);


const app = new Vue({
    el: '#log-in',
    data () {
        return {
            eventRecords:      [],
        }
    },
});


