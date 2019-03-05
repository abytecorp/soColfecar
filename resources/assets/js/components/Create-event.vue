<template>


<a href="#"  v-on:click="showToastr">showmsg</a>

</template>

<script>


import toastr from 'toastr';
export default {
    //props: ['info'],
    data () {
        return {
            info:  'el dichoso mensajito!',
           
            
        }
    },
    created: function() {
        this.showToastr();
    },
    methods: {
        showToastr : function() {
            toastr.success('el mensajito');
        },

    }
}
</script>