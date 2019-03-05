<template>

<a href="#" v-on:click="since">toast</a>
 

</template>

<script>


// require('../../assets/node_modules/select2/dist/js/select2.full.min.js');
// require('../../assets/node_modules/bootstrap-select/bootstrap-select.min.js');
// require('../../assets/node_modules/multiselect/js/jquery.multi-select.js');
// require('../../assets/node_modules/toast-master/js/jquery.toast.js');
// require('../../dist/js/pages/toastr.js');

import toastr from 'toastr'

export default {   

methods: {
        since : function() {
            toastr.success('Eliminado correctamente'); //mensaje
            console.log(toastr);
        },
        

    }
}


</script>