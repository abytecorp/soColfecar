<template>
    <div>
        <div v-if="isAcepted">
        <div class="card">
            <div class="card-body">
                    <div class="card" v-if="event.banner">
                        <img class="card-img-top img-responsive" :src="'/storage/banner/'+event.banner" alt="Card image cap">
                        <!-- <div class="card-body">
                            <h2 class="card-title">{{ event.event }}</h2>
                            <div v-if="event.place_id" >
                                <h3>{{ event.place_id.label }}</h3>
                            </div>
                           
                        </div> -->

        
<form-wizard v-if="isInscription"
    @on-complete="onComplete"
    @on-validate="handleValidation"
    @on-error="handleErrorMessage"
    shape="circle"
    back-button-text="Atras"
    next-button-text="Siguiente"
    finish-button-text="Finalizar"
    color="#2395D2"
    error-color="#e74c3c"
>
         <h2 slot="title"></h2>
    <tab-content title="Inscribe..."
        icon="fa fa-user"
        :before-change="valFirstStep">
            <div class="col-lg-12 col-md-12">
                <!-- Card -->
                <div class="card">
                    <!-- <img class="card-img-top img-responsive" src="" alt="Card image cap"> -->
                    <div class="card-body">
                        <h4 class="card-title">Datos de la persona que realiza la inscripcion</h4>
                        <FloatingLabel
                            :config="{label: 'Nombre de la persona que realiza la inscripciòn', hasError: err.enroll_name, hasClearButton: false }">
                            <input name="enroll_name" v-model="record.enroll_name" type="text">
                            <span v-if="err.enroll_name" class="text-danger">{{ err.enroll_name }}</span>
                        </FloatingLabel>
                        <br>
                        <FloatingLabel
                            :config="{label: 'Em@il de la persona que realiza la inscripciòn', hasError: err.enroll_email, hasClearButton: false }">
                            <input name="enroll_mail" v-model="record.enroll_email" type="mail" @keyup="valMailFormat()">
                            <span v-if="err.enroll_email" class="text-danger">{{ err.enroll_email }}</span>
                        </FloatingLabel>
                    </div>
                </div>
                <!-- Card -->
            </div>
    </tab-content>
    <tab-content v-if="event.invitation_type != 'sponsors'" title="Facturacion"
        icon="fa fa-money"
        :before-change="valSecondStep">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <!-- <img class="card-img-top img-responsive" src="" alt="Card image cap"> -->
                    <div class="card-body">
                        <blockquote>
                        <h3>Requiere orden de Facturacion?</h3>
                            <RockerSwitch
                            :size="0.9"
                            :value="record.is_bill_order"
                            @change="isOn => (record.is_bill_order = isOn)"
                            toggle
                            labelOn="SI"
                            labelOff="NO"
                            />
                        </blockquote>
                        <transition name="fade">
                        <blockquote v-if="record.is_bill_order">
                             <h3>Cuando desea recibir la factura?</h3>
                            <VueCtkDateTimePicker 
                                only-date 
                                :no-value-to-custom-elem="(true)" 
                                v-model="record.bill_order_date"
                                button-now-translation="Ahora"
                                locale="es"
                                format="YYYY-MM-DD">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-hand-o-right"></i></span>
                                    </div>
                                    <input type="text" class="form-control"  v-model="record.bill_order_date">
                                </div>
                            </VueCtkDateTimePicker>
                            <span v-if="err.bill_order_date" class="text-danger">{{ err.bill_order_date }}</span>
                        </blockquote>
                        </transition>
                        <transition name="fade">
                        <blockquote v-if="record.is_bill_order">
                            <h3>Seleccione la forma de pago</h3>
                            <select name="" id="" v-model="record.pay_way">
                                <option value="">Seleccione una opcion</option>
                                <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                                <option value="PSE">PSE</option>
                            </select>
                            <span v-if="err.pay_way" class="text-danger">{{ err.pay_way }}</span>
                        </blockquote>
                        </transition>
                        
                    </div>
                </div>
                <!-- Card -->
            </div>
            
    </tab-content>
    <tab-content title="Empresa"
        icon="fa fa-building-o"
        :before-change="valThirdStep">
                        <company-card v-if="record.company_id" :company_id="record.company_id" @closeCompany="closeCompany"></company-card>
                        <span v-if="err.company_id" class="text-danger">{{ err.company_id }}</span>
                        <blockquote>
                        <h3>Seleccione la empresa a la que pertenece</h3>
                            <v-select id="eventTypeSelect" placeholder="Seleccione una empresa" icon="fa fa-user" :options="companies" v-model="record.company_id"  label="label">
                                <template slot="option" slot-scope="option">
                                        <i :class="option.logo"></i> {{ option.label }}
                                </template>
                            </v-select>
                            <span class="text-danger" v-if="err.company_id">{{ err.company_id }}</span>
                        </blockquote>
                        <blockquote>
                        <h3>O ingrese la informacion de su empresa</h3>
                        <button type="button" @click="setNewCompany()" class="btn btn-info btn-rounded">Ingresar nueva empresa  <i class="fa fa-plus"></i> </button>
                        </blockquote>

    </tab-content>
    <tab-content title="Asistentes"
        icon="fa fa-users"
        :before-change="valFourthStep">
            <span v-if="err.isSus" class="text-danger"><h3>{{ err.isSus }}</h3></span>
            <assistants-panel 
                v-if="record.company_id" 
                :company_id="record.company_id" 
                :invitation_type="event.invitation_type" 
                :event_id="event.id"
                :enroll_name="record.enroll_name"
                :enroll_email="record.enroll_email"
                :is_bill_order="record.is_bill_order"
                :bill_order_date="record.bill_order_date"
                :pay_way="record.pay_way"
                @setIsSus="setIsSus">
            </assistants-panel>
            <span v-if="err.isSus" class="text-danger"><h3>{{ err.isSus }}</h3></span>
    </tab-content>
</form-wizard>
        <blockquote>
            <h3><strong>Persona que realiza la iniscripción</strong> {{ record.enroll_name }}</h3>
        </blockquote>
                <blockquote v-if="record.isSus">
                    <h3>Assistentes inscritos</h3>
                    <div class="card-body">
                        <div class="row" v-for="isSu in record.isSus" :key="isSu.id">
                            <div class="col-md-3 col-xs-6 b-r"> <strong>Nombres</strong>
                                <br>
                                <p class="text-muted">{{ isSu.names }}</p>
                            </div>
                            <div class="col-md-3 col-xs-6 b-r"> <strong>Plan</strong>
                                <br>
                                <p class="text-muted">{{ isSu.plan  }}</p>
                            </div>
                            <div class="col-md-3 col-xs-6 b-r"> <strong>Hospedaje</strong>
                                <br>
                                <p class="text-muted">{{ isSu.room || 'no cuenta con hospedaje' }}</p>
                            </div>  
                        </div>
                    </div>
                </blockquote>
                <blockquote v-if="!isInscription">
                    <h3>Si existe algún error con la información registrada, debe comunicarse con el departamento de Ventas <strong>Colfecar</strong> y solicitar cancelar el registro que presenta errores, posteriormente, debe iniciar un nuevo registro e ingresar la información como lo indica este formulario.</h3>
                    <button class="btn btn-info" @click="restart">Reiniciar procedimiento</button>
                </blockquote>
                </div>   
            </div>

        </div>
        </div>
        <modal-data-confirmation @setAcept="setAcept"></modal-data-confirmation>
        <modal-new-external-company v-if="isNewCompany" :companies="companies" @setCompany="setCompany"></modal-new-external-company>
    </div>
</template>
<script>
import {FormWizard, TabContent} from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import { Carousel, Slide } from 'vue-carousel';
import FloatingLabel from 'vue-simple-floating-labels'
import moment from 'moment'
import toastr from 'toastr'

//import Lightbulb from "./Lightbulb";
import RockerSwitch from "vue-rocker-switch";
import "vue-rocker-switch/dist/vue-rocker-switch.css";

import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';
Vue.component('VueCtkDateTimePicker', VueCtkDateTimePicker);

import modalDataConfirmation from './External-inscription/Modal-data-confirmation'
import companyCard from './External-inscription/Company-card'
import modalNewExternalCompany from './External-inscription/Modal-new-external-company'
import AssistantsPanel from './External-inscription/Assistants-panel'

export default {
    props: ['event'],
    components: {
        FormWizard,
        TabContent,
        Carousel,
        Slide,
        modalDataConfirmation,
        FloatingLabel,
        moment,
        toastr,
        RockerSwitch,
        companyCard,
        modalNewExternalCompany,
        AssistantsPanel,
    },
    data () {
        return {
            isAcepted:      null,
            record: {
                enroll_name:        '',
                enroll_email:       '',
                is_bill_order:      true,
                bill_order_date:    '',
                pay_way:            '',
                company_id:         '',
                isSus:              []
            },
            err:    {
                enroll_name:    null,
                enroll_email:   null,
                bill_order_date:null,
                pay_way:        null,
                company_id:     null,
                isSus:          null
            },
            companies:      [],
            isNewCompany:   null,
            mailInError:    false,
            isInscription:  true,
            errors:         []
            //currentValue: true
        }
    },
    created : function() {
        this.getCompanies()
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
        getCompanies(){
            let url = '/api/get-companies-external';
            axios.get(url).then(response =>{
                this.companies = response.data;
                this.errors = [];
            }).catch(error => {
                this.companies = [];
                this.errors = error.response.data;
            });
        },
        setAcept (val){
            this.isAcepted = val
        },
        onComplete() {
            console.log(this.record.isSus.length == 0)
            this.isInscription = null;
        },
        handleValidation(){

        },
        handleErrorMessage(){

        },
        valFirstStep : function() {
            return new Promise((resolve, reject) => {
                this.mailInError ? reject('Debe registrar un correo con el formato correcto >>ejemplo@empresa.com<<') : !this.record.enroll_name ? reject('Debe asignar el nombre de la persona que inscribe antes de continuar') : 
                !this.record.enroll_email  ? reject('Debe ingresar el Em@il de la persona que inscribe antes de continuar') : resolve(true); this.err.enroll_name= false ; this.err.enroll_email = false
            })
        },
        setBillOrderDate() {
            if(this.record.bill_order_date){
                this.err.bill_order_date = '';
                return true
            }else{
                this.err.bill_order_date = 'Debe seleccionar la fecha cuando recibira la factura';
                return false
            }
        },
        setPayWay() {
        if(this.record.pay_way){
                this.err.pay_way = '';
                return true
            }else{
                this.err.pay_way = 'Debe seleccionar elmetodo de pago!';
                return false
            }
        },
        valSecondStep : function() {
            this.getCompanies();
            return new Promise((resolve, reject) => {
                !this.record.is_bill_order ? resolve(true) : !this.record.bill_order_date ? reject('Debe seleccionar la fecha cuando desea recibir la factura') : 
                !this.record.pay_way  ? reject('Debe establecer el metodo de pago') : resolve(true); this.err.bill_order_date= false ; this.err.pay_way = false
            })
        },
        valThirdStep(){
            return new Promise((resolve, reject) => {
                !this.record.company_id ? reject('Debe seleccionar o crear la empresa!') : 
                resolve(true); this.err.company_id= false ; this.err.company_id = false
            })
        },
        valFourthStep(){
            return new Promise((resolve, reject) => {
                this.record.isSus.length == 0 ? reject('Debe inscribir al menos un asistente!') : 
                resolve(true); this.err.isSus = false ; this.err.isSus = false
            })
        },
        handleErrorMessage : function(errMsg) {
            if(errMsg){
            errMsg.includes('nombre') ? this.err.enroll_name = errMsg : this.err.enroll_name = null
            errMsg.includes('Em@il') ? this.err.enroll_email = errMsg : this.err.enroll_email = null
            errMsg.includes('fecha') ? this.err.bill_order_date = errMsg : this.err.bill_order_date = null
            errMsg.includes('metodo') ? this.err.pay_way = errMsg : this.err.pay_way = null
            errMsg.includes('formato') ? this.err.enroll_email = errMsg : this.err.enroll_email = null
            errMsg.includes('empresa') ? this.err.company_id = errMsg : this.err.company_id = null
            errMsg.includes('asistente') ? this.err.isSus = errMsg : this.err.isSus = null
            }
        },
        valMailFormat : function(){
            let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            //console.log(re.test(String(this.company.email).toLowerCase()))
            if(!re.test(String(this.record.enroll_email).toLowerCase()) && this.record.enroll_email){
                this.mailInError = true
                this.err.enroll_email = 'Debe registrar un correo con el formato correcto >>ejemplo@empresa.com<<'
                return false
                }else{
                    this.err.enroll_email = ''
                    this.mailInError = false
                    return true
                   }
        },
        on(value) {
            this.record.is_bill_order = value;
        },
        setNewCompany(){
            this.isNewCompany = !this.isNewCompany
        },
        setCompany(val){
            let url = `/api/${val}/get-company-by-id`;
            axios.get(url).then(response =>{
                this.record.company_id = response.data;
                this.record.company_id.label = response.data.bs_name
                this.getCompanies();
                this.errors = [];
            }).catch(error => {
                this.record.company_id = [];
                this.errors = error.response.data;
            });
        },
        closeCompany(){
            this.record.company_id = null
        },
        setIsSus(val){
            this.record.isSus.push(val);
        },
        restart(){
            location.reload();
        }
        
    }
}
</script>
<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .39s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
