<template>
<!-- to show this modal have to create a event funtion `newAffiliationModal` in the father model .show --> 
<div>
                                <div id="newEventModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Nuevo Evento</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                               

  <form-wizard 
    @on-complete="onComplete"
    @on-validate="handleValidation"
    @on-error="handleErrorMessage"
    shape="circle"
    back-button-text="Atras"
    next-button-text="Siguiente"
    finish-button-text="Finalizar"
    color="#2395D2"
    error-color="#e74c3c">
    <h2 slot="title">{{ event.id_event_type && event.id_event_type.label }} {{ event.event || 'Formulario de evento' }}</h2>

     <tab-content title="Tipo de evento"
                  icon="ti-settings"
                  :before-change="valStepEvTy">
        <label for="eventTypeSelect">Seleccione el tipo de evento</label>
        <v-select id="eventTypeSelect" :options="eventTypes" v-model="event.id_event_type"  label="label">
            <template slot="option" slot-scope="option">
                    <i :class="option.label"></i> {{ option.label }}
            </template>
        </v-select>
        <span class="text-danger" v-if="errLblEventType">{{ errLblEventType }}</span>
        
     </tab-content>

     <tab-content title="Nombre del evento"
                  icon="ti-flag-alt-2"
                  :before-change="valStepEvNam">
        <FloatingLabel
            :config="{label: 'Nombre del evento', hasError: errLblEvNam, hasClearButton: false }">
            <input name="example" v-model="event.event" type="text">
        </FloatingLabel>
        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.event }}</span>
        <span class="text-danger" v-if="errLblEvNam">{{ errLblEvNam }}</span>
     </tab-content>

     <tab-content title="Fechas"
                  icon="ti-calendar"
                  :before-change="valStepEvDat">
        <div class="row justify-content-center">
            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.date_end }}</span>
            <button v-for="eventDay in eventDays" :key="eventDay.date" type="button" class="btn btn-outline-success"><i class="fa fa-check"></i> {{ eventDay.day }} {{ eventDay.dayNumber }} de {{ eventDay.month }}</button>
        </div>

        <blockquote>
            <div class="row">
                    <!-- Column -->
                    <div class="col-lg-6 col-md-6">
                        <div :class="[event.date_init ? cardStart : cardEmpty]">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="m-r-20 align-self-center">
                                        <h1 :class="[event.date_init ? textWhite : textBlack]"><i class="ti-flag-alt-2"></i></h1></div>
                                    <div>
                                        <h3 :class="[event.date_init ? 'card-title '+textWhite : 'card-title '+textBlack]">{{ formDay(event.date_init) || 'Fecha inicio' }}</h3>
                                        <h6 :class="[event.date_init ? 'card-subtitle '+textWhite : 'card-subtitle '+textBlack]"> {{ 'Fecha y hora de inicio' }} </h6> </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-4 align-self-center">
                                        <font class="display-6 text-white">50 GB</font>
                                    </div>
                                     <div class="col-8 align-self-center">
                                        <div class="usage chartist-chart" style="height:120px"></div>
                                    </div> 
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-6 col-md-6">
                        <div :class="[event.date_end ? cardEnd : cardEmpty]">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="m-r-20 align-self-center">
                                        <h1 :class="[event.date_end ? textWhite : textBlack]"><i class="ti-share-alt"></i></h1></div>
                                    <div>
                                        <h3 :class="[event.date_end ? 'card-title '+textWhite : 'card-title '+textBlack]">{{ formDay(event.date_end) || 'Fecha final' }}</h3>
                                        <h6 :class="[event.date_end ? 'card-subtitle '+textWhite : 'card-subtitle '+textBlack]">{{ 'Fecha y hora de finalizacion' }}</h6> </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-4 align-self-center">
                                        <font class="display-6 text-white">35487</font>
                                    </div>
                                    <div class="col-8  text-right">
                                        <div class="spark-count" style="height:120px"></div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
            </div>
                <!-- Row -->
        </blockquote>
        <blockquote>
            <h3><i class="ti-calendar"></i> Seleccione el dia de inicio y final del evento</h3>
            <VueCtkDateTimePicker 
                v-model="fullDate"
                button-now-translation="Ahora"
                locale="es"
                :range="true" :only-date="true"
                label="Seleccione la fecha de inicio y final del evento"
                :custom-shortcuts="[
                    { label: `Hoy`, value: 'day', isSelected: false },
                    { label: 'Ayer', value: '-day', isSelected: false },
                    { label: 'Esta semana', value: 'week', isSelected: false },
                    { label: 'Ultima semana', value: '-week', isSelected: false },
                    { label: 'Esta semana', value: 'month', isSelected: false },
                    { label: 'Ultimo mes', value: '-month', isSelected: false },
                    { label: 'Este mes', value: 'year', isSelected: false },
                    { label: 'Ultimo Año', value: '-year', isSelected: false },
                    { label: 'Ultimos 5 años', value: 5, isSelected: false }
                    ]"
                @is-hidden="validateStep()">
            </VueCtkDateTimePicker>
            <span v-if="err.date_start" class="text-danger">{{ err.date_start }}</span>
            <br v-if="err.date_start">
            <span v-if="err.date_end" class="text-danger">{{ err.date_end }}</span>
        </blockquote>
        <blockquote>
            <h3><i class="ti-alarm-clock"></i> Seleccione la hora incial</h3>
            <VueCtkDateTimePicker only-time format="hh:mm a" label="Click aqui para asignar la hora inicial" :no-value-to-custom-elem="(true)" v-model="hourInit" @is-hidden="validateStep()">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-hand-o-right"></i></span>
                    </div>
                    <input type="text" class="form-control"  v-model="hourInit">
                </div>
            </VueCtkDateTimePicker>
            <span v-if="err.hour_start" class="text-danger">{{ err.hour_start }}</span>
        </blockquote>
        <blockquote>
            <h3><i class="ti-alarm-clock"></i> Seleccione la hora final</h3>
            <VueCtkDateTimePicker only-time  format="hh:mm a" label="Click aqui para asignar la hora" :no-value-to-custom-elem="(true)" v-model="hourEnd" @is-hidden="validateStep()">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-hand-o-right"></i></span>
                    </div>
                    <input type="text" class="form-control"  v-model="hourEnd">
                </div>
            </VueCtkDateTimePicker>
            <span v-if="err.hour_end" class="text-danger">{{ err.hour_end }}</span>
        </blockquote>
            
    </tab-content>

    <tab-content title="Banner del evento"
                  icon="ti-image"
                  :before-change="valStepEvImg">
                    <div class="card" v-if="event.banner">
                        <img class="card-img-top img-responsive" :src="imageData" alt="Card image cap">
                        <div class="card-body">
                            <button type="button" class="btn btn-danger" v-on:click="deleteLogo"><i class="fa fa-trash-o"></i> Eliminar</button>
                        </div>
                        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.banner }}</span>
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Seleccione un archivo de imagen .png o .jpg dando click en <strong>-Browse-</strong></label>
                        <div></div>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" @change="previewImage" id="customFileUpdate">
                          <label class="custom-file-label" for="customFile">Seleccione archivo</label>
                          <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.banner }}</span>
                          <span v-if="errLblEvDatImg" class="text-danger">{{ errLblEvDatImg }}</span>
                        </div>
                    </div>
    </tab-content>
    <tab-content title="Ubicación"
                  icon="ti-map-alt"
                  :before-change="valStepEvPl">
        <label for="eventTypeSelect">Seleccione la ubicacion donde se realizará de evento</label>
        <v-select id="eventTypeSelect" :options="places" v-model="event.place_id"  label="label">
            <template slot="option" slot-scope="option">
                    <i :class="option.label"></i> {{ option.label }}
            </template>
        </v-select>
        <span class="text-danger" v-if="errLblEvPl">{{ errLblEvPl }}</span>
        <hr>
        <button type="button" class="btn waves-effect waves-light btn-success" v-on:click="setNewPlace()">Nuevo lugar</button>
        <hr>
        <new-place-form v-if="isNewPlace" @handlerSuccess="getPlaces(),setNewPlace()"></new-place-form>
    </tab-content>
    <tab-content title="Planes"
                icon="ti-money"
                :before-change="valStepPl">
            <span v-if="errLblPlan" class="text-danger">{{ errLblPlan }}</span>
           <Plans @setPlan="setPlan"></Plans>

    </tab-content>
    <tab-content title="Confirmacion"
                  icon="ti-check">

        <div class="card">
            <div class="card-body">
                    <div class="card" v-if="event.banner">
                        <img class="card-img-top img-responsive" :src="imageData" alt="Card image cap">
                        <div class="card-body">
                            <h2 class="card-title">{{ event.event }}</h2>
                            <div v-if="event.place_id" >
                                <h3>{{ event.place_id.label }}</h3>
                            </div>
                            <div v-if="plans">
                                <h3><strong>Planes</strong></h3>
                                <h4 v-for="plan in plans" :key="plan.id" >{{plan.plan}}</h4>
                            </div>
                            <div v-else>
                                <h3 class="text-danger">No se asignaron planes aun, lo puede hacer mas adelante.</h3>
                            </div>
                        </div>
                    </div>   
            </div>
        </div>

     </tab-content>
 </form-wizard>



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

import newPlaceForm from './New-place-form'
//imports form wizzard
import {FormWizard, TabContent} from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'

import AddressAutocomplete from './Address-autocomplete'

import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';

Vue.component('VueCtkDateTimePicker', VueCtkDateTimePicker);

import Plans from './New-event/Plans'
import FloatingLabel from 'vue-simple-floating-labels'
import moment from 'moment'
import toastr from 'toastr'

import onlyHour from '../filters/only-hour'
import { async } from 'q';
Vue.use(onlyHour)

export default {
    components: {
        newPlaceForm,
        FormWizard,
        TabContent,
        FloatingLabel,
        Plans,
        toastr,
        AddressAutocomplete
    },
    data () {
        return {
            event: {
                event:          '',
                id_event_type:  null,
                is_billing:     true,
                date_init:      '',
                date_end:       '',
                banner:         null,
                place_id:       null
            },
            err: {
                date_start :    null,
                date_end:       null,
                hour_start:     null,
                hour_end:       null
            },
            imageData:          null,
            logoChanged:        false,
            eventTypes:         [],
            cities:             [],
            places:             [],
            errors:             [],
            errLblEvent:        false,
            errLblEvNam:        false,
            errLblEvDatIn:      false,
            errLblEvDatEn:      false,
            errLblEvDatImg:     false,
            errLblEvPl:         false,
            errLblPlan:         false,
            errLblEventType:    null,
            cmpStatSel:         null,
            eventDays:          [],
            errorDate:          null,
            isNewPlace:         null,
            plans:              null,
            cardStart:          'card bg-info',
            cardEnd:            'card bg-success',
            cardEmpty:          'card bg-secondary',
            textBlack:          'text-black',
            textWhite:          'text-white',
            fullDate:           '',
            hourInit:           '',
            hourEnd:            '',
            tempHourStart:      '',
            tempHourEnd:        '',
            tempDayStart:       '',
            tempDayEnd:         ''
        }
    },
    created : function (){
        this.getEventTypes()
        this.getCities()
        this.getPlaces()
        this.$bus.$on('get-company-types', () => {
            this.getCompanyTypes()
        })
    },
    methods : {
        getCities() {
            let url = '/api/get-cities';
            axios.get(url).then(response =>{
                this.cities = response.data;
                this.errors = [];
            }).catch(error => {
                this.cities = [];
                this.errors = error.response.data;
            });
        },
        getPlaces () {
            let url = '/api/get-places';
            axios.get(url).then(response =>{
                this.places = response.data;
                this.errors = [];
            }).catch(error => {
                this.places = [];
                this.errors = error.response.data;
            });
        },
        getEventTypes : function() {
            let url = '/api/get-event-types'; //get the company types
            axios.get(url).then(response =>{
                this.eventTypes = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        getLogoUpdate : function (e) {
            var fileReader = new FileReader()
            fileReader.readAsDataURL(e.target.files[0])
            fileReader.onload = (e) => {
            this.event.banner = e.target.result
            }
            this.logoChanged = true
        },
        deleteLogo : function() {
            this.event.banner = null
            this.imageData = null
            this.logoChanged = false
        },
        previewImage: function(event) {
            // Reference to the DOM input element
            var input = event.target;
            // Ensure that you have a file before attempting to read it
            if (input.files && input.files[0]) {
                // create a new FileReader to read this image and convert to base64 format
                var reader = new FileReader();
                // Define a callback function to run, when FileReader finishes its job
                reader.onload = (e) => {
                    // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
                    // Read image as base64 and set to imageData
                    this.imageData = e.target.result;
                }
                // Start the reader job - read file as a data url (base64 format)
                reader.readAsDataURL(input.files[0]);
            }
        this.getLogoUpdate(event)
        },
        getLogoUpdate : function (e) {
            var fileReader = new FileReader()
            fileReader.readAsDataURL(e.target.files[0])
            fileReader.onload = (e) => {
            this.event.banner = e.target.result
            }
            //this.logoChanged = true
        },
        setUpAddress : function(val) {
        //(Addres-gen)this function used to add the nomenclature an the letters, whit spaces to build the string
        this.company.address = this.company.address + ' ' + val + ' '
        },
        setUpAddressDig : function(val) {
        //(Addless-gen)this function add the string whitout a initial space, this used in the numbers.
        this.company.address = this.company.address + val
        },
        setReset : function() {
        //(Address-gen) this function reset or erase the charset or adress that gives the object
        this.company.address = ''
        },
        storePlan : function(plan,event_id){
            plan.id_event = event_id
            let url = '/plans';
            axios.post(url, plan).then(response => {
                return true
            }).catch(error => {
                this.errors = error.response.data
                return false
            });
        },
        onComplete : function() {
            this.event.id_event_type = this.event.id_event_type.id
            this.event.place_id = this.event.place_id.id
            this.event.date_init = moment(this.event.date_init).format('YYYY-MM-DD HH:mm:ss')
            this.event.date_end = moment(this.event.date_end).format('YYYY-MM-DD HH:mm:ss')
            let url = 'events/store'
            axios.post(url, this.event).then(response =>{
                //this.responseTest = response.data
                this.plans.forEach(async (plan) => {
                    await this.storePlan(plan,response.data.id)
                })
                toastr.success(`ha creado el evento ${this.event.event}, con exito!`)
                this.$bus.$emit('set-prox-events')
                this.$emit('successEnd')
            }).catch(error => {
                this.errors = error.response.data;
                //console.log(this.errors)
            });
        },
        valStepEvTy : function() {
            return new Promise((resolve, reject) => {
                !this.event.id_event_type ? reject('Debes seleccionar el tipo de evento para continuar') : resolve(true); this.errLblEventType = null
            })
        },
        valStepEvNam : function () {
            return new Promise((resolve, reject) => {
                !this.event.event ? reject('Debes asignar un nombre de evento para continuar') : resolve(true); this.errLblEvNam = false
            })
        },
        valStepEvDat : function () {
            return new Promise((resolve, reject) => {
                !this.event.date_init ? reject('Debes indicar la fecha inicial para continuar') : 
                !this.event.date_end  ? reject('Debes indicar la fecha final para continuar') : resolve(true); this.errLblEvDatEn= false ; this.errLblEvDatIn = false
            })
        },
        valStepEvImg : function () {
            return new Promise((resolve, reject) => {
                !this.event.banner ? reject('Debes seleccionar el banner del evento para continuar') : resolve(true); this.errLblEvImg = false
            })
        },
        valStepEvPl : function () {
            return new Promise((resolve, reject) => {
                !this.event.place_id ? reject('Debes seleccionar el lugar del evento o crearlo para continuar') : resolve(true); this.errLblEvImg = false
            })
        },
        valStepPl : function () {
            return new Promise((resolve, reject) => {
                !this.plans ? reject('Debes asignar al menos 1 plan para continuar') : resolve(true); this.errLblPlan = false
            })
        },
        handleValidation : function() {

        },
        handleErrorMessage : function(errMsg) {
            console.log(errMsg)
            if(errMsg){
            errMsg.includes('tipo') ? this.errLblEventType = errMsg : this.errLblEventType = null
            errMsg.includes('nombre') ? this.errLblEvNam = errMsg : this.errLblEvNam = false
            errMsg.includes('inicial') ? this.errLblEvDatIn = errMsg : this.errLblEvDatIn = false
            errMsg.includes('final') ? this.errLblEvDatEn = errMsg : this.errLblEvDatEn = false
            errMsg.includes('banner') ? this.errLblEvDatImg = errMsg : this.errLblEvDatImg = false
            errMsg.includes('lugar') ? this.errLblEvPl = errMsg : this.errLblEvPl = false
            errMsg.includes('plan') ? this.errLblPlan = errMsg : this.errLblPlan = false
            }
        },
        handlerTest : function() {
        this.errors = []
        this.eventDays = []
        this.errLblEvDatEn = false;
        var date1 = moment(this.event.date_init);
        var date2 = moment(this.event.date_end);
        if(date1 <= date2){
            if(this.event.date_end){
                while(date1.isSameOrBefore(date2)) {
                    this.eventDays.push({'day':date1.format('dddd'),'date':date1.format('YYYY-MM-DD'),'dayNumber':date1.format('DD'),'month':date1.format('MMM')});
                        date1.add(1,'days');
                }
            }else{
                this.eventDays = []
            }
        }else{
            this.errors.push({'date_end':'La fecha final no puede ser menor a la inicial'})
            //this.errLblEvDatEn = true
            this.event.date_end = ''
        }
        },
        setNewPlace : function() {
            this.isNewPlace ? this.isNewPlace = null : this.isNewPlace = true
        },
        isOn(value) {
            this.event.is_billing = value;
        },
        setPlan : function(value) {
            console.log(value)
            this.plans = []
            this.plans = value
        },
        saveAllPlans : function() {
            if(this.plans){
            let url = '/plans';
            this.plans.forEach(async (plan))
            axios.post(url, plan).then(response => {
                toastr.success(`Se creo el plan ${plan.plan} con exito`);
            }).catch(error => {
                this.errors = error.response.data
            });
            }else{

            }
        },
        validateDayStart : function(){
            if(this.fullDate.start){
                this.tempDayStart = this.fullDate.start
                this.err.date_start = '';
                return true
            }else{
                this.err.date_start = 'Debe Asignar una fecha de inicio del evento';
                return false
            }
        },
        validateDayEnd : function(){
            if(this.fullDate.end){
                this.tempDayEnd = this.fullDate.end
                this.err.date_end = '';
                return true
            }else{
                this.err.date_end = 'Debe Asignar la fecha cuando finalizara el evento';
                return false
            }
        },
        validateHourStart : function(){
            if(this.hourInit){
                this.tempHourStart = this.hourInit
                this.err.hour_start = '';
                return true
            }else{
                this.err.hour_start = 'Debe Asignar la hora inicial del evento';
                return false
            }
        },
        validateHourEnd : function(){
            if(this.hourEnd){
                this.tempHourEnd = this.hourEnd
                this.err.hour_end = '';
                return true
            }else{
                this.err.hour_end = 'Debe Asignar la hora final del evento';
                return false
            }
        },
        validateStep : function(){
            let dayStart = this.validateDayStart()
            let dayEnd = this.validateDayEnd()
            let hourStart = this.validateHourStart()
            let hourEnd = this.validateHourEnd()
            if(dayStart && hourStart){
                this.event.date_init = moment(this.tempDayStart).format('YYYY-MM-DD') + ' ' + this.hourInit
                }else{
                this.event.date_init = ""  
                }
            if(dayEnd && hourEnd){
                this.event.date_end = moment(this.tempDayEnd).format('YYYY-MM-DD') + ' ' + this.hourEnd
                }else{
                this.event.date_end = ''
                }
        },
        formDay : function(e){
            if(e){
            return moment(e).format('dddd, MMMM Do YYYY, h:mm:ss a')
            }    
        }
    }
} 
</script>