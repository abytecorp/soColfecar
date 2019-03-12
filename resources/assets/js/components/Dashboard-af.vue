<template>
    <div>
        <div class="row">
            <!-- Column -->
            <div class="col-lg-3 col-md-6" v-for="cmpState in cmpStates" :key="cmpState.id" >
                <a href="#" @click="showTable(cmpState.id)">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ cmpState.company_state }}</h5>
                        <div class="d-flex no-block align-items-center m-t-20 m-b-20">
                            <div id="sparklinedash"></div>
                            <div class="ml-auto">
                                <h2 class="text-success"><i class="ti-arrow-up"></i> <span class="counter"><comp-cant :data="cmpState.id"></comp-cant></span></h2>
                            </div>
                        </div>
                    </div>
                    <div id="sparkline8" class="sparkchart"></div>
                </div>
                </a>
            </div>
            <!-- Column -->
        </div>
        <div v-if="cmpStatSel != null"><datatable-cmp-by-status :data="cmpsByStat" @updateDataTable="setUpdateCmp"></datatable-cmp-by-status></div>  
    </div>
</template>

<script>
import skycons from 'skycons';
import axios from 'axios';
import toastr from 'toastr';
import moment from 'moment';


import compCant from './comp-cant';
import datatableCmpByStatus from './Datatable-cmp-by-status';

moment.locale('es');
//import raphael from 'raphael';
//import morris from 'morris';
// import jquery_sparkline from 'jquery-sparkline';
// require('./../pages/dashboard.js');
// require('./../pages/skycons.js');

export default {
    components: {
        compCant,
        datatableCmpByStatus
    },
    data () {
        return {
            cmpStates:      [],
            changes:        [],
            companies:      [],
            cmpsByStat:     [],
            count:          [],
            errors:         [],
            cmpStatSel:     null,
        }
    },
    created: function() {
        this.getCompanies();
        this.getCmpState();
        this.getChanges();
        
    },
    computed: {
        howManyComp (id) {
            // let companiesByStates=  []
            // let url = 'affiliations/get-companies-by-state/'+id
            // axios.get(url).then(response => {
            //     companiesByStates = response.data
            // }).catch(error => {
            //     this.errors = error.response.data
            // });
            return id
        }
    },
    methods: {
        since : function(d) {
            return moment(d).fromNow();
        },
        getCmpState : function() {
            var urlCmpState = 'affiliations/estados';
            axios.get(urlCmpState).then(response =>{
                this.cmpStates = response.data
            }).catch(error => {
            this.errors = error.response.data
        });

        },
        getChanges : function() {
            var urlChanges = 'affiliations/changes/'+7; //TODO
            axios.get(urlChanges).then(response =>{
                this.changes = response.data.changes.data
            }).catch(error => {
            this.errors = error.response.data
        });
        },
        getCompanies : function() {
            let url = 'affiliations/get-companies'
            axios.get(url).then(response => {
                this.companies = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        showTable : function (id) {
            this.cmpStatSel = id
            let url = 'affiliations/companies-by-state/'+id
            axios.get(url).then(response =>{
                this.cmpsByStat = response.data
            }).catch(error => {
            this.errors = error.response.data
            });
        },
        setUpdateCmp : function () {
            console.log('testing')
        }


    }
}


</script>