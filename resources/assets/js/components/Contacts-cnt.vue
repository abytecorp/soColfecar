<template>
 <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">{{ cntCnt }}</font></a></div>
</template>
<script>


import axios from 'axios'

export default {
    data () {
        return {
            cntCnt:  0,
        }
    },
    created: function() {
        //this.getCmpState();
    },
    methods: {
        // since : function(d) {
        //     return moment(d).fromNow();
        // },
        // getCmpState : function() {
        //     var urlCmpState = 'affiliations/estados';
        //     axios.get(urlCmpState).then(response =>{
        //         this.cmpStates = response.data
        //     });
        // }

    }
}

</script>