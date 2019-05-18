<template>
    <div>
        <div class="card-group" >
            <div class="card" v-for="eventType in eventTypes" :key="eventType.id" >
                <a href="#" @click="showTable(eventType.id,eventType.label)">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3><i :class="eventType.icon"></i></h3>
                                    <p class="text-muted">{{ eventType.label }}</p>
                                </div>
                                <div class="ml-auto">
                                    <h2 class="counter text-primary"><div v-if="reloadCmpState == true"><event-cant :data="eventType.id"></event-cant></div></h2>
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
                                    <button type="button" class="btn waves-effect waves-light btn-info" @click="showNewEventModal"><i class="fa fa-check"></i> Nuevo Evento</button>
                                    <button type="button" class="btn waves-effect waves-light btn-warning" @click="showConfAffModul">Configuraciones</button>
                                    <!-- <button type="button" class="btn waves-effect waves-light btn-danger">Danger</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        <div v-if="eventStatSel"><datatable-event-by-state :data="eventsByStat" @updateDataTable="showTable"></datatable-event-by-state></div>
        <prox-events :events="events"></prox-events>
        <changes :item_id="10" ></changes>
        <new-event-modal v-if="isNewEvent" @successEnd="endNewEventModal"></new-event-modal>
        <conf-events-module></conf-events-module>
    </div>
</template>
<script>

import axios from 'axios'
import activeInTime from '../filters/active-in-time'
import moment from 'moment'

import changes from './Changes'
import eventCant from './event-cant'
import NewEventModal from './New_event_modal'
import datatableEventByState from './Datatable-event-by-state'
import confEventsModule from './Conf-events-module'
import proxEvents from './Prox-events.vue'

Vue.use(activeInTime)

export default {
    components: {
        changes,
        NewEventModal,
        eventCant,
        datatableEventByState,
        confEventsModule,
        proxEvents
    },
    props: ['events'],
    data() {
        return {
            changes:            [],
            eventTypes:         [],
            errors:             [],
            isNewEvent:         true,
            reloadCmpState:     true,
            eventStatSel:       null,
            eventsByStat:       [],
        }
    },
    created: function() {
        this.getChanges()
        this.getEventTypes()
        this.$bus.$on('update-event-changes', () => {
            this.getChanges()
        })
        this.$bus.$on('get-event-types', () => {
            this.getEventTypes()
        })
    },
    methods:    {
        since : function(d) {
            return moment(d).fromNow();
        },
        getChanges : function() {
            let url = '/api/get-changes-by-item/'+10
            axios.get(url).then(response =>{
                this.changes = response.data
                this.errors = []
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        getEventTypes : function() {
            let url = '/api/get-event-types'
            axios.get(url).then(response =>{
                this.eventTypes = response.data
                this.errors = []
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        storeNewEvent : function() {
            var url = 'api/events';
            //var newEvent = this.newEvent
			axios.post(url, this.newEvent).then(response => {
                this.newEvent = {}
				this.errors = [];
				$('#new_event_modal').modal('hide');
				$('.modal-backdrop').remove();
				toastr.success('Se ha creado el evento con exito!')
			}).catch(error => {
                this.errors = error.response.data
                console.log(error.response.data.errors)
			});
        },
        getBanner : function (e) {
            //console.log(e.target.files[0])
            var fileReader = new FileReader()
            fileReader.readAsDataURL(e.target.files[0])
            fileReader.onload = (e) => {
                this.newEvent.banner = e.target.result
            }
            console.log(this.company)
        },
        showTable : function (id,company_state) {
            this.eventStatSel = id
            let url = 'affiliations/events-by-type/'+id
            axios.get(url).then(response =>{
                this.eventsByStat = response.data
                this.eventsByStat.fileName = company_state
            }).catch(error => {
            this.errors = error.response.data
            });
        },
        showNewEventModal : function () {
            this.isNewEvent = true
            $('#newEventModal').modal('show')
        },
        endNewEventModal : function () {
            $('#newEventModal').modal('hide')
            this.isNewEvent = false
        },
        showConfAffModul : function () {
            $('#confEventsModulModal').modal('show')
        }
    },
}
</script>