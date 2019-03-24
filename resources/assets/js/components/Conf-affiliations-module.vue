<template>
<!-- to show this modal have to create a event funtion `confAffiliationsModulModal` in the father model .show --> 
<div>
    <p>testing text</p>
                                <div id="confAffiliationsModulModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
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
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#companyStatus" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Estado de empresa</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile7" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Profile</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages7" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Messages</span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="companyStatus" role="tabpanel">
                                        <div class="p-20">
                                            <div v-for="cmpState in cmpStates" :key="cmpState.id" :class="cmpState.id_status | classNotificationActive"> <i :class="cmpState.icon"></i> {{ cmpState.company_state }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"><i class="fa fa-pensil"></i> </span> </button>
                                                  
                                                <button type="button" class="close" @click="setActiveInactive(cmpState.id_status)"> <span aria-hidden="true"><i :class="cmpState.id_status | iconClassActive"></i> </span> </button>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane  p-20" id="profile7" role="tabpanel">2</div>
                                    <div class="tab-pane p-20" id="messages7" role="tabpanel">3</div>
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

Vue.use(classNotificationActive)
Vue.use(iconClassActive)

export default {
    components: {
        //compponents
    },
    data () {
        return {
            cmpStates:          [],

        }
    },
    created: function() {
        //this.getCompanies();
        this.getCmpState();   
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
        getCmpState : function() {
            let urlCmpState = 'affiliations/estados-get-all';
            axios.get(urlCmpState).then(response =>{
                this.cmpStates = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        setActiveInactive : function (val) {
            let setValue = val == 1 ? 2 : 1
            let urlCmpState = 'affiliations/estados';
            axios.get(urlCmpState).then(response =>{
                this.cmpStates = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        }
    }
}
</script>