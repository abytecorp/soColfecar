<template>
    <div>
        <div id="billModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">FACTURACION {{ record.names }} {{ record.last_names }}</h4>
                        <button type="button" class="close" @click="closeBillModal()" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <pay-status-notification v-if="bill && isPayStatusNotification"
                            :bill_id="bill.bill_id"
                            :plan_value="bill.price">
                        </pay-status-notification>
                        <div v-if="billsEjectsByRecord">
                            <div class="alert alert-warning" v-if="billsEjectsByRecord">
                            Valor Negociado {{ billsEjectsByRecord.price | currency }} <br/> Valor Iva  {{ parseInt(billsEjectsByRecord.price)*0.19 | currency }} <br/>Por: <strong> {{ billsEjectsByRecord.name+' '+billsEjectsByRecord.last_name }} </strong> {{ since(billsEjectsByRecord.created_at) }}
                            </div>
                            <div class="alert alert-success" v-for="debitEjectByRecord in debitsEjectByRecord" :key="debitEjectByRecord.id">
                            Pago registrado {{ debitEjectByRecord.debit_price | currency }} <br/>con el numero de factrura:  {{ debitEjectByRecord.debit }} Por:<strong> {{ debitEjectByRecord.name+' '+debitEjectByRecord.last_name }} </strong> {{ since(debitEjectByRecord.created_at) }} <br>
                            Observacion: {{ debitEjectByRecord.observation }}
                            </div>
                            <hr>
                            <label for="billedVal">Valor a pagar (sin iva)</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                </div>
                                <input id="billedVal" type="number" class="form-control" v-model="record.plan_price" placeholder="Valor a pagar"  aria-describedby="basic-addon1"> </input>
                            </div>
                            <label for="billedVal">Numero de Factura</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">#</span>
                                </div>
                                    <input type="number" class="form-control" v-model="billsEjectsByRecord.number" placeholder="No de factura" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <label for="billedVal">Observaciones</label>
                            <textarea class="form-control" rows="5" v-model="observationDebit"></textarea>
                            <div class="input-group mb-3">
                                <table class="table full-color-table full-success-table hover-table">
                                    <thead>
                                        <tr>
                                            <td></td>
                                            <td>Valores</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><h5>Subtotal</h5></td>
                                            <td><h5>{{ record.plan_price | currency }}</h5></td>
                                        </tr>
                                        <tr>
                                            <td><h5>Iva</h5></td>
                                            <td><h5>{{ parseInt(record.plan_price)*0.19 | currency }}</h5></td>
                                        </tr>
                                        <tr>
                                            <td><h4>Total</h4></td>
                                            <td><h4><strong>{{ record.plan_price | ivaInc | currency }}</strong></h4></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-success" v-on:click="createBillDebitByRec()" ><i class="fa fa-check"></i> Registrar pago</button>
                            </div>
                        </div>
                        <div v-else>
                            <h5 >{{ record.names }} {{ record.last_names }} aun no cuenta con facturación</h5>
                            <p>Al dar click sobre le boton aceptar se iniciara la inscripcion por el valor de <strong> {{ record.plan_price | currency }} </strong>, 
                                si desea aplicar algun descuento seleccione la opcion <strong>--DESCUENTO--</strong>, es necesario que registre el motivo
                                por el cual se acredita este descuneto.</p>
                            <button class="btn btn-warning waves-effect" v-on:click="isDiscount = !isDiscount">Descuento</button>
                            <hr>
                                <label v-if="isDiscount">Debe digitar solo el valor del descuento, el aplicativo calculara automaticamnte el total:</label>
                                <div v-if="isDiscount" class="input-group mb-3">
                                    <input type="number" class="form-control" v-model="discountValue">
                                </div>
                                <label v-if="isDiscount">Descripción del descuento:</label>
                                <textarea v-if="isDiscount" class="form-control" rows="5" v-model="observationDiscount"></textarea>
                                <hr>
                            <button class="btn btn-success waves-effect" @click="valFields()" >Iniciar Incripción por valor de {{ record.plan_price - discountValue | currency }}</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success waves-effect" @click="closeBillModal()">Aceptar</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light"  @click="closeBillModal()">Cancelar</button>                 
                    </div>
                </div>
                <!-- /.modal-content -->
                </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
</template>
<script>
import toastr from 'toastr'
import moment from 'moment'

import payStatusNotification from './Pay-status-notification'

import ivaInc from '../../filters/iva-inc'
Vue.use(ivaInc)

import VueCurrencyFilter from 'vue-currency-filter'
Vue.use(VueCurrencyFilter,{
    symbol: '$', // El símbolo, por ejemplo €
  thousandsSeparator: ',', // Separador de miles
  fractionCount: 0, // ¿Cuántos decimales mostrar?
  fractionSeparator: '.', // Separador de decimales
  symbolPosition: 'front', // Posición del símbolo. Puede ser al inicio ('front') o al final ('') es decir, si queremos que sea al final, en lugar de front ponemos una cadena vacía ''
  symbolSpacing: true // Indica si debe poner un espacio entre el símbolo y la cantidad

})

export default {
    props: ['record_id'],
    components: {
        toastr,
        payStatusNotification
        },
    data () {
        return {
            record:                 [],
            bill:                   null,
            billsEjectsByRecord:    [],
            debitsEjectByRecord:    [],
            observationDebit:       '',
            observationDiscount:    '',
            discountValue:          0,
            isDiscount:             null,
            isPayStatusNotification:    true,
            err:    {
                
            },
            errors:         [],
        }
    },
    created : function() {
        // /api/{record}/get-reg-by-record
        this.getRecordById()
        this.record ? this.getBillByRecord() : null
    },
    mounted : function(){
        $('#billModal').modal('show');
    },
    methods : {
        since : function(d) {
            return moment(d).fromNow();
        },
        toPay : function(d) {
            let val = parseInt(d) + parseInt(d)*0.19 
            return val
        },
        closeBillModal : function(){
            $('#billModal').modal('hide');
            $('.modal-backdrop').remove();
            this.$emit('closeBillModal')
        },
        getRecordById : function(){
            let url = `/api/${this.record_id}/get-reg-by-record`;
            axios.get(url).then(response =>{
                this.record = response.data
                this.errors = []
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        getBillByRecord : function(){
            let url = `/api/${this.record_id}/get-bills-rec`;
            axios.get(url).then(response =>{
                response.data ==='' ? this.bill = null : this.bill = response.data
                this.getBillsByRec(this.record_id)
                this.getDebitsByRec(this.record_id)
                this.errors = []
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        getBillsByRec : function(id_rec){
            let url = '/api/'+id_rec+'/get-bills-rec';
            axios.get(url).then(response =>{
                this.billsEjectsByRecord = response.data;
                this.errors = [];
            }).catch(error => {
                this.billsEjectsByRecord = [];
                this.errors = error.response.data;
            });
        },
        getDebitsByRec : function(id_bill){
            var url = '/api/'+id_bill+'/get-debits-rec';
            axios.get(url).then(response =>{
                this.debitsEjectByRecord = response.data;
                this.errors = [];
            }).catch(error => {
                this.debitsEjectByRecord = [];
                this.errors = error.response.data;
            });
        },
        setPayStatus : function(status){       
            this.isPayStatusNotification = status
        },
        forceRerender() {
            // Remove my-component from the DOM
            this.isPayStatusNotification = false;

            // If you like promises better you can
            // also use nextTick this way
            this.$nextTick().then(() => {
                // Add the component back in
                this.isPayStatusNotification = true;
            });
        },
        createBillDebitByRec : function(){
            if(!this.billsEjectsByRecord.number){
                this.billsEjectsByRecord.number = ''
            }
            if(this.record.plan_price != ''){
                if(this.billsEjectsByRecord.number != ''){
            var url = '/billing_debits';
            axios.post(url, {
                debit_price:    this.record.plan_price,
                debit:          this.billsEjectsByRecord.number,
                observation:    this.observationDebit,
                id_bill:        this.bill.bill_id
            }).then(response => {
                this.observationDebit = ""
                this.billsEjectsByRecord.number = ""
                this.forceRerender()
                this.errors = [];
                toastr.success('Se se registro el pago exitosamente!');
            }).catch(error => {
                this.errors = error.response.data
            });
            }else{
                toastr.error('Debe ingresar un numero de factura!');
            }}else{
                toastr.error('Debe ingresar un valor!');
            }

        },
        valFields : function(){
            if(this.isDiscount){
                if(this.observationDiscount != ""){
                    this.storeBill()
                }else{
                    toastr.error('Debe especificar el motivo del descuento.')
                }
            }else{
                this.storeBill()
            }
        },
        storeBill : function(){
            let bill = [];
            console.log(`the record id ${this.record_id}`)
                bill = { "record_id" : this.record_id, "price" : this.record.plan_price, "obs" : this.observationDiscount };
                let url = '/api/store-new-bill-in';
                axios.post(url,bill).then(response =>{
                    let bill_id = response.data.id
                    toastr.success('Se se registro la facturación exitosamente!')
                    this.$emit('getAsPr')
                    this.getBillByRecord()
                }).catch(error => {
                    this.errors = error.response.data;
            });
        }
    }
}
</script>