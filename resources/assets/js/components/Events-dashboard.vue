<template>
<div>
        <div class="row el-element-overlay">


    
<div class="row">
           
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h5 class="card-title">Eventos</h5> -->
                                <button type="button" @click="createNewEvent" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Nuevo evento</button>
                                
                            </div>
                    
                            <div class="comment-widgets">
                                <!-- Comment Row -->
                                <div class="d-flex no-block comment-row" v-for="event in events" :key="event.id">
                                    <a :href="'/panel-evento/'+event.id">
                                    <div class="p-2"><span><img :src="'/storage/'+event.banner" alt="user" width="50"></span></div>
                                    <div class="comment-text w-100">
                                        <h5 class="font-medium">{{ event.event }}</h5>
                                        <p class="m-b-10 text-muted">{{ event.event_type }}</p>
                                        <div class="comment-footer">
                                            <span class="text-muted pull-right">{{ since(event.date_init) }}</span> <span class="badge badge-pill badge-info">{{ event.date_end | active-in-time }}</span> <span class="action-icons">
                                                    <a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
                                                    <a href="javascript:void(0)"><i class="ti-check"></i></a>
                                                    <a href="javascript:void(0)"><i class="ti-heart"></i></a>    
                                                </span>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                    </div>



                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">LOS ULTIMOS {{ changes.length }} CAMBIOS EN EL MODULO</h5>
                                <div class="message-box">
                                    <div class="message-widget message-scroll">
                                      
                                        <a href="javascript:void(0)" v-for="change in changes" :key="change.id">
                                            <div class="user-img"> <img :src="'/storage/'+change.avtr" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                            <div class="mail-contnet">
                                                <h5>{{ change.name }} {{ change.last_name }}</h5> <span class="mail-desc">{{ change.description }}</span> <span class="time">{{ since(change.created_at) }}</span> </div>
                                        </a>


                                       
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    
                </div>

</div>

    <div id="new-event-modal" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Crea un nuevo evento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="POST" v-on:submit.prevent="storeNewEvent">
                        <div class="form-group m-form__group">
                            <label for="eventTypeInput">Tipo de vento:</label>
                            <v-select :options="eventTypes"  v-model="newEvent.id_event_type" id="eventTypeInput">
                                <template slot="option" slot-scope="option">
                                    {{ option.label }}
                                </template>
                            </v-select>
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.id_event_type }}</span>
						</div>
                        <div class="form-group m-form__group">
                            <label for="inputHotelName">Nombre del Evento</label>
                            <input type="text" class="form-control" name="inputHotelName" v-model="newEvent.event" placeholder="Nombre del Evento">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.event }}</span>
                        </div>
                        <div class="form-group m-form__group">
                            <label for="date_init_imput">Fecha de inicio</label>
                                <input class="form-control" type="datetime-local" v-model="newEvent.date_init" value="" id="date_init_imput">
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.date_init }}</span>
                        </div>
                        <div class="form-group m-form__group">
                            <label for="date_end_imput">Fecha de finalizacion</label>
                                <input class="form-control" type="datetime-local" v-model="newEvent.date_end" value="" id="date_end_imput">
                                 <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.date_end }}</span>
                        </div>
                        <div class="form-group m-form__group">
							<label for="customFile">Banner del Evento</label>
							<div></div>
							<div class="custom-file">
								<input type="file" class="custom-file-input" @change="getBanner" id="customFile">
								<label class="custom-file-label" for="customFile">Seleccione archivo</label>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.banner }}</span>
							</div>
						</div>

                        <hr>
                        <button type="submit" class="btn btn-info waves-effect text-left">Guardar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    
                </div>
                
            </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
    </div>
</div>
</template>
<script>

import axios from 'axios'
import activeInTime from '../filters/active-in-time'
import moment from 'moment'


Vue.use(activeInTime)


export default {
    props: ['events'],
    data() {
        return {
            changes:    [],
            eventTypes: [],
            errors:     [],
            newEvent: {
                event:          '',
                id_event_type:  '',
                date_init:      '',
                date_end:       '',
                banner:         '',
            }
        }
    },
    created: function() {
        this.getChanges()
        this.getEventTypes()
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
        createNewEvent : function() {
            $('#new-event-modal').modal('show')
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
    },
}
</script>