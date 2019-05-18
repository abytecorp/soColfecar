<template>
<!-- to show this modal have to create a event funtion `confAffiliationsModulModal` in the father model .show --> 
<div>
   
                                <div id="confEventsModulModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Configuraciones</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body p-b-0">
                                <h4 class="card-title">Seleccione una de las opciones y agregue Configuraciones.</h4>
                                <!-- <h6 class="card-subtitle">Use default tab with class <code>customtab</code></h6> -->
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs customtab2" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#companyStatus" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Tipos de eventos</span></a> </li>
                                    <!-- <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#companyTypes" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Tipos de empresa</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages7" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Messages</span></a> </li> -->
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="companyStatus" role="tabpanel">
                                        <div class="p-20">
                                            <button type="button" class="btn btn-info" @click="newEventType()"><i class="fa fa-plus"></i> Nuevo</button>
                                            <new-event-type v-if="isNewEventType"></new-event-type>
                                            <hr>
                                            <div v-for="eventType in eventTypes" :key="eventType.id" :class="eventType.id_status | classNotificationActive"> <i :class="eventType.icon"></i> {{ eventType.event_type }}
                                                <button type="button" class="close" @click="editEventType(eventType.id)"> <span aria-hidden="true"><i class="fa fa-pencil"></i> </span> </button>
                                                <button type="button" class="close" @click="setActiveInactive(eventType.id_status,eventType.id)"> <span aria-hidden="true"><i :class="eventType.id_status | iconClassActive"></i> </span> </button>
                                                <edit-event-type v-if="isEditEventType && idEventTypeSelected==eventType.id" :data="eventType.id"></edit-event-type>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="tab-pane" id="companyTypes" role="tabpanel">
                                        <div class="p-20">
                                            <button type="button" class="btn btn-info" @click="newCompanyType()"><i class="fa fa-plus"></i> Nuevo</button>
                                            <new-company-type v-if="isNewCompType"></new-company-type>
                                            <hr>
                                            <div v-for="cmpType in cmpTypes" :key="cmpType.id" :class="cmpType.id_status | classNotificationActive">  {{ cmpType.company_type }}
                                                <button type="button" class="close" @click="editCompanyType(cmpType.id)"> <span aria-hidden="true"><i class="fa fa-pencil"></i> </span> </button>
                                                <button type="button" class="close" @click="setActiveInactiveCompanyType(cmpType.id_status,cmpType.id)"> <span aria-hidden="true"><i :class="cmpType.id_status | iconClassActive"></i> </span> </button>
                                                <edit-company-type v-if="isEditCompType && idCompTypeSelected==cmpType.id" :data="cmpType.id"></edit-company-type>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane p-20" id="messages7" role="tabpanel">3</div> -->
                                </div>
                            </div>
                        </div> 
                    </div>


                                            </div>
                                            <div class="modal-footer">   
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
    <!-- /.modal -->
</div>
</template>
<script>
import classNotificationActive from '../filters/class-notification-active'
import iconClassActive from '../filters/icon-class-active'

//sons modules
import editEventType from './Edit-event-type'
import newEventType from './New-event-Type'
import editCompanyType from './Edit-company-type'
import newCompanyType from './New-company-type'

Vue.use(classNotificationActive)
Vue.use(iconClassActive)

export default {
    components: {
        //compponents
        editEventType,
        newEventType,
        editCompanyType,
        newCompanyType
    },
    data () {
        return {
            eventTypes:              [],
            cmpTypes:               [],
            errors:                 [],
            isNewEventType:         false,
            isEditEventType:        false,
            isNewCompType:          false,
            isEditCompType:         false,
            idEventTypeSelected:    null,
        }
    },
    created: function() {
        this.getEventTypes()
        //this.getCmpTypes()
        this.$bus.$on('set-new-event-type-false', () => {
            this.isNewEventType = false
            this.getEventTypes()
        })
        this.$bus.$on('set-edit-event-type-false', () => {
            this.isEditEventType = false
            this.getEventTypes()
        })
        this.$bus.$on('set-new-event-type-false', () => {
            this.isNewEventType = false
            this.getEventTypes()
        })
        // this.$bus.$on('set-edit-company-type-false', () => {
        //     this.isEditCompType = false
        //     this.getCmpTypes()
        // })
    },
    computed: {
        classActive : function (id) {
            let active = id == 1 ? 'alert alert-success alert-rounded' : 'alert alert-warning alert-rounded'
            return active
        }
    },
    methods: {
        since : function(d) {
            return moment(d).fromNow();
        },
    //company states
        getEventTypes : function() {
            let url = '/api/get-event-types-all';
            axios.get(url).then(response =>{
                this.eventTypes = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        setActiveInactive : function (val,id) {
            let setValue = val == 1 ? 2 : 1
            let url = 'event-type/set-event-type-status/'+ setValue + '/' + id;
            axios.get(url).then(response =>{
                //this.cmpStates = response.data
                this.getEventTypes()
                this.$bus.$emit('get-event-types')
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        newEventType : function () {
            this.isNewEventType = this.isNewEventType == true ? false : true
        },
        editEventType : function (val) {
            this.isEditEventType = this.isEditEventType == true ? false : true
            this.idEventTypeSelected = val
        },
    //company types
        getCmpTypes : function() {
            let url = 'affiliations/get-all-types';
            axios.get(url).then(response =>{
                this.cmpTypes = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        setActiveInactiveCompanyType : function (val,id) {
            let setValue = val == 1 ? 2 : 1
            let url = 'event-type/set-event-type-status/'+ setValue + '/' + id;
            axios.get(url).then(response =>{
                this.getEventTypes()
                this.$bus.$emit('get-event-types')
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        newCompanyType : function () {
            this.isNewCompType = this.isNewCompType == true ? false : true
        },
        editCompanyType : function (val) {
            this.isEditCompType = this.isEditCompType == true ? false : true
            this.idCompTypeSelected = val
        }
    }
}
</script>