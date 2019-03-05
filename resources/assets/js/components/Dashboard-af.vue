<template>


        <div>


        </div>



</template>

<script>
import skycons from 'skycons';
import axios from 'axios';
import toastr from 'toastr';
import moment from 'moment';

moment.locale('es');
//import raphael from 'raphael';
//import morris from 'morris';
// import jquery_sparkline from 'jquery-sparkline';
// require('./../pages/dashboard.js');
// require('./../pages/skycons.js');

export default {
    data () {
        return {
            cmpStates:  [],
            changes:    [],
            companies:  [],
            count:      [],
        }
    },
    created: function() {
        this.getCmpState();
        this.getChanges();
        
    },
    methods: {
        since : function(d) {
            return moment(d).fromNow();
        },
        getCmpState : function() {
            var urlCmpState = 'affiliations/estados';
            axios.get(urlCmpState).then(response =>{
                this.cmpStates = response.data
            });

        },
        getChanges : function() {
            var urlChanges = 'affiliations/changes/'+7; //TODO
            axios.get(urlChanges).then(response =>{
                this.changes = response.data.changes.data
            });
        },


    }
}


</script>