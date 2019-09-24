<template>
    <div>
        <div id="internalInscriptionModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Nueva Inscripción</h4>
                        <button type="button" class="close" @click="closeInternalInscriptionModal()" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <internal-inscription>
                        </internal-inscription>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success waves-effect" @click="closeInternalInscriptionModal()">Aceptar</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light"  @click="closeInternalInscriptionModal()">Cancelar</button>                 
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

import internalInscription from '../Internal-inscription'


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
        internalInscription
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
        //this.record ? this.getBillByRecord() : null
    },
    mounted : function(){
        $('#internalInscriptionModal').modal('show');
    },
    methods : {
        since : function(d) {
            return moment(d).fromNow();
        },
        closeInternalInscriptionModal : function(){
            $('#internalInscriptionModal').modal('hide');
            $('.modal-backdrop').remove();
            this.$emit('closeInternalInscriptionModal')
        },
        
    }
}
</script>