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
        <label for="dateInit">Fecha de inicio del evento</label>
        <FloatingLabel
            :config="{label: '', hasError: errLblEvDatIn, hasClearButton: false }">
            <input name="dateInit" type="date" id="dateInit" v-model="event.date_init" >
        </FloatingLabel>
        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.date_init }}</span>
        <span v-if="errLblEvDatIn" class="text-danger">{{ errLblEvDatIn }}</span>
        <hr>
        <label for="dateEnd">Fecha final del evento</label>
        <FloatingLabel
            :config="{label: '', hasError: errLblEvDatEn, hasClearButton: false }">
            <input name="dateEnd" type="date" id="dateInit" v-model="event.date_end" @change="handlerTest" >
        </FloatingLabel>
        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.date_end }}</span>
        <span v-if="errLblEvDatEn" class="text-danger">{{ errLblEvDatEn }}</span>
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
                  icon="ti-money">
       
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

import Plans from './Plans'
import FloatingLabel from 'vue-simple-floating-labels'
import moment from 'moment'
import toastr from 'toastr'

export default {
    components: {
        newPlaceForm,
        FormWizard,
        TabContent,
        FloatingLabel,
        Plans,
        toastr
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
            errLblEventType:    null,
            cmpStatSel:         null,
            eventDays:          [],
            errorDate:          null,
            isNewPlace:         null,
            plans:              null
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
        onComplete : function() {
            this.event.id_event_type = this.event.id_event_type.id
            this.event.place_id = this.event.place_id.id
            let url = 'events/store'
            axios.post(url, this.event).then(response =>{
                //this.responseTest = response.data
                toastr.success(`ha creado el evento ${this.event.event}, con exito!`)
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
        }
    }
} 
</script>