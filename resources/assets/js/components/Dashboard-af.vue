<template>
    <div>
        <div class="card-group" >
            <div class="card" v-for="cmpState in cmpStates" :key="cmpState.id" >
                <a href="#" @click="showTable(cmpState.id,cmpState.company_state)">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3><i :class="cmpState.icon"></i></h3>
                                    <p class="text-muted">{{ cmpState.company_state }}</p>
                                </div>
                                <div class="ml-auto">
                                    <h2 class="counter text-primary"><div v-if="reloadCmpState == true"><comp-cant :data="cmpState.id"></comp-cant></div></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="row">
                    <div class="col-lg-12 col-xlg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="button-group">
                                    <!-- <button type="button" class="btn waves-effect waves-light btn-primary">Primary</button>
                                    <button type="button" class="btn waves-effect waves-light btn-secondary">Secondary</button>
                                    <button type="button" class="btn waves-effect waves-light btn-success">Success</button> -->
                                    <button type="button" class="btn waves-effect waves-light btn-info" @click="showNewAffiliationModal"><i class="fa fa-check"></i> Nuevo proceso de afiliacion</button>
                                    <button type="button" class="btn waves-effect waves-light btn-warning" @click="showConfAffModul">Configuraciones</button>
                                    <!-- <button type="button" class="btn waves-effect waves-light btn-danger">Danger</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        <div v-if="cmpStatSel != null"><datatable-cmp-by-status :data="cmpsByStat" @updateDataTable="showTable"></datatable-cmp-by-status></div>  
        <changes :item_id="7" ></changes>
        <new-affiliation :companies="companies" @updateDataTable="compCant.getCompaniesByState()"></new-affiliation>
        <conf-affiliations-module></conf-affiliations-module>
    </div>
</template>

<script>
import skycons from 'skycons';
import axios from 'axios';
import toastr from 'toastr';
import moment from 'moment';


import compCant from './comp-cant';
import datatableCmpByStatus from './Datatable-cmp-by-status';
import changes from './Changes';
import newAffiliation from './New_affiliation';
import confAffiliationsModule from './Conf-affiliations-module';

moment.locale('es');
//import raphael from 'raphael';
//import morris from 'morris';
// import jquery_sparkline from 'jquery-sparkline';
// require('./../pages/dashboard.js');
// require('./../pages/skycons.js');

export default {
    components: {
        compCant,
        datatableCmpByStatus,
        changes,
        newAffiliation,
        confAffiliationsModule,
    },
    data () {
        return {
            cmpStates:          [],
            changes:            [],
            companies:          [],
            nulledCompanies:    [],
            cmpsByStat:         [],
            count:              [],
            errors:             [],
            cmpStatSel:         null,
            reloadCmpState:     true,
        }
    },
    created: function() {
        this.getCompanies();
        this.getCmpState();
        this.$bus.$on('get-company-states', () => {
            this.getCmpState()
        })
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
        getCompanies : function() {
            console.log('get companies its ejected')
            this.reloadCmpState = false
            let url = 'affiliations/get-companies'
            axios.get(url).then(response => {
                this.companies = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
            this.reloadCmpState = true
        },
        showTable : function (id,company_state) {
            this.cmpStatSel = id
            let url = 'affiliations/companies-by-state/'+id
            axios.get(url).then(response =>{
                this.cmpsByStat = response.data
                this.cmpsByStat.fileName = company_state
            }).catch(error => {
            this.errors = error.response.data
            });
        },
        setUpdateCmp : function () {
            console.log('testing')
        },
        showNewAffiliationModal : function () {
            $('#newAffiliationModal').modal('show')
        },
        showConfAffModul : function () {
            $('#confAffiliationsModulModal').modal('show')
        }
    }
}


</script>