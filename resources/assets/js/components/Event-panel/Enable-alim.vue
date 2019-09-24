<template>
    <div>
        <div id="enableAlimModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Administrar alimentacion {{ record.names }} {{ record.last_names }}</h4>
                        <button type="button" class="close" @click="closeEnableAlimModal()" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                                    <div class="col-lg-12 col-xlg-12 m-b-30">
                                        <button :class="[ lunchStatus.Refrigeriodia1 === 1 ? buttonInfo : lunchStatus.Refrigeriodia1 === 2 ? buttonDanger : buttonSecondary]" type="button" v-on:click="changeLunchStatus('Refrigeriodia1')"><span class="btn-label"><i class="fa fa-coffee"></i></span> Refrigerio dia 1</button>
                                        <button :class="[ lunchStatus.Refrigeriodia2 === 1 ? buttonInfo : lunchStatus.Refrigeriodia2 === 2 ? buttonDanger : buttonSecondary]" type="button" v-on:click="changeLunchStatus('Refrigeriodia2')"><span class="btn-label"><i class="fa fa-coffee"></i></span> Refrigerio dia 2</button>
                                        <button :class="[ lunchStatus.Refrigeriodia3 === 1 ? buttonInfo : lunchStatus.Refrigeriodia3 === 2 ? buttonDanger : buttonSecondary]" type="button" v-on:click="changeLunchStatus('Refrigeriodia3')"><span class="btn-label"><i class="fa fa-coffee"></i></span> Refrigerio dia 3</button>
                                        <button :class="[ lunchStatus.Refrigeriodia4 === 1 ? buttonInfo : lunchStatus.Refrigeriodia4 === 2 ? buttonDanger : buttonSecondary]" type="button" v-on:click="changeLunchStatus('Refrigeriodia4')"><span class="btn-label"><i class="fa fa-coffee"></i></span> Refrigerio dia 4</button>
                                        <hr>
                                        <button :class="[ lunchStatus.Almuerzodia1 === 1 ? buttonInfo : lunchStatus.Almuerzodia1 === 2 ? buttonDanger : buttonSecondary]" type="button" v-on:click="changeLunchStatus('Almuerzodia1')"><span class="btn-label"><i class="fa fa-cutlery"></i></span> Almuerzo dia 1</button>
                                        <button :class="[ lunchStatus.Almuerzodia2 === 1 ? buttonInfo : lunchStatus.Almuerzodia2 === 2 ? buttonDanger : buttonSecondary]" type="button" v-on:click="changeLunchStatus('Almuerzodia2')"><span class="btn-label"><i class="fa fa-cutlery"></i></span> Almuerzo dia 2</button>
                                        <button :class="[ lunchStatus.Almuerzodia3 === 1 ? buttonInfo : lunchStatus.Almuerzodia3 === 2 ? buttonDanger : buttonSecondary]" type="button" v-on:click="changeLunchStatus('Almuerzodia3')"><span class="btn-label"><i class="fa fa-cutlery"></i></span> Almuerzo dia 3</button>
                                        <hr>
                                        <button :class="[ lunchStatus.Cenadia1 === 1 ? buttonInfo : lunchStatus.Cenadia1 === 2 ? buttonDanger : buttonSecondary]" type="button" v-on:click="changeLunchStatus('Cenadia1')"><span class="btn-label"><i class="fa fa-cutlery"></i></span> Cena dia 1</button>
                                        <button :class="[ lunchStatus.Cenadia2 === 1 ? buttonInfo : lunchStatus.Cenadia2 === 2 ? buttonDanger : buttonSecondary]" type="button" v-on:click="changeLunchStatus('Cenadia2')"><span class="btn-label"><i class="fa fa-cutlery"></i></span> Cena dia 2</button>
                                        <button :class="[ lunchStatus.Cenadia3 === 1 ? buttonInfo : lunchStatus.Cenadia3 === 2 ? buttonDanger : buttonSecondary]" type="button" v-on:click="changeLunchStatus('Cenadia3')"><span class="btn-label"><i class="fa fa-cutlery"></i></span> Cena dia 3</button>
                                        <hr>
                                    </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success waves-effect" @click="closeEnableAlimModal()">Aceptar</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light"  @click="closeEnableAlimModal()">Cancelar</button>                 
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
        toastr
        },
    data () {
        return {
            record:         [],
            errors:         [],
            buttonInfo:     'btn btn-rounded btn-block btn-outline-info',
            buttonDanger:     'btn btn-rounded btn-block btn-outline-danger',
            buttonSecondary:     'btn btn-rounded btn-block btn-outline-secondary',
            lunchStatus:      [],
            rSelToLunch:        [],
        }
    },
    created : function() {
        // /api/{record}/get-reg-by-record
        this.getRecordById()
        this.getLunchesStatus()
        //this.record ? this.getBillByRecord() : null
    },
    mounted : function(){
        $('#enableAlimModal').modal('show');
    },
    methods : {
        since : function(d) {
            return moment(d).fromNow();
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
        getLunchesStatus : function(){
            let url = `/api/${this.record_id}/get-lunch-status`
            axios.get(url).then(response => {
                this.lunchStatus = response.data
                this.errors = []
            }).catch(error => {
                this.errors = error.response.data
            })
        },
        closeEnableAlimModal : function(){
            $('#enableAlimModal').modal('hide');
            $('.modal-backdrop').remove();
            this.$emit('closeEnableAlimModal')
        },
        changeLunchStatus : function(button) {
            //console.log(`the value of selected: ${this.rSelToLunch[0][button]}`)
            let selection = this.rSelToLunch[0][button] == 0 ? 1 : 0
            console.log(`the button selected! ${button} and the record id ${this.rSelToLunch[0].record_id}`)
            let url = '/api/records-lunch-update/' + this.rSelToLunch[0].record_id + '/' + button + '/' + selection
            axios.get(url).then(response => {
                this.getRecordByAssistant(this.rSelToLunch[0].record_id)
            }).catch(error => {
                this.errors = error.response.data
                console.log(`ooops thats an error like this: ${error.resoonse.data}`)
            });
        },
        
    }
}
</script>