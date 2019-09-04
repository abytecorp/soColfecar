<template>
    <div>
        <div id="authDatamodal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Autorizacion para tratamiento de datos personales</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">   
                        <h2>AUTORIZACION PARA TRATAMIENTO DE DATOS PERSONALES</h2>
                        <p style="text-align: justify;">
“al aceptar esta notificacion AUTORIZO voluntaria y expresamente a la <strong>FEDERACION COLOMBIANA DE TRANSPORTADORES DE CARGA POR CARRETERA " COLFECAR "</strong> para que a través de las entidades pertinentes, asociaciones, gremios, conozca, consulte, verifique, actualice y rectifique en cualquier momento la información suministrada por usted en cualquier documento y/o correo electrónico que suministren datos para el Registro de la Empresa, sus representantes y/o administradores, a las centrales de datos e información debidamente constituidas, para fines estadísticos, de atención de Consultas, Peticiones, Quejas y Reclamos; invitación a eventos organizados o patrocinados por COLFECAR; la consulta de información financiera e historia crediticia; Para promocionar y publicar sus productos y los de sus compañías vinculadas a nivel mundial; Para el cumplimiento de mandatos judiciales o legales, para actividades de mercadeo, de investigación y demás propósitos comerciales que no contravengan la legislación vigente en Colombia, es por ello que le permito a COLFECAR se contacte con nosotros vía correo electrónico, o por cualquier otro medio de comunicación. 
Los Datos Personales cuyo tratamiento se autoriza en virtud de este documento, serán conservados por el Responsable hasta que sea solicitada la supresión de la información por parte del Titular, de acuerdo con lo dispuesto en la Política de Protección de Datos Personales de COLFECAR, la cual se encuentra disponible para su consulta en el sitio web: www.colfecar.org.co Sin perjuicio de lo anterior usted conserva la facultad de ejercer en cualquier momento su derecho a conocer, actualizar y rectificar la información en cualquier momento. 
Si no desea recibir nuestras comunicaciones podrá informarnos a través de la página web, o al correo electrónico: info@colfecar.org.co Declaro que conozco y acepto todas las condiciones establecidas, y que esta autorización no genera compromiso de carácter laboral, personal o de otro tipo de contrato de ninguna índole con COLFECAR”</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success waves-effect" @click="termAcept()">Aceptar</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light"  data-dismiss="modal">Cancelar</button>                 
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
export default {
    components: {

    },
    data () {
        return {
            acepted:      null
        }
    },
    created : function (){
        //this.getEventTypes()
    },
    mounted : function (){
        $('#authDatamodal').modal('show');
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
        termAcept (){
            
            this.$emit('setAcept',true);
            $('#authDatamodal').modal('hide');
            
        }
        
    }
} 
</script>