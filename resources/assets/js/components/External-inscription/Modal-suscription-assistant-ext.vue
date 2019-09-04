<template>
    <div>
        <div id="newSuscriptionModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Seleccione el plan y sus respectivos items</h4>
                        <button type="button" class="close" @click="closeModal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">  
                        <blockquote>
                            <h3> <i class="fa fa-edit"></i> Seleccione un plan</h3>
                            <v-select id="eventPlanSelect" placeholder="Seleccione un plan" icon="fa fa-user" :options="plans" v-model="planSelected" @input="setPlan"  label="plan">
                                <template slot="option" slot-scope="option">
                                        {{ option.plan }}
                                </template>
                            </v-select>
                            <span v-if="err.plan" class="text-danger">{{ err.plan }}</span>
                        </blockquote>
                        <blockquote v-if="planSelected">
                            <h3>{{ planSelected.plan }}</h3>
                            <div class="card-body">
                                <div class="row">
                                    
                                            <br/>
                                            <hr>
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Descripcion</strong>
                                                <br>
                                                <p class="text-muted">{{ planSelected.pl_desc }}</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Hospedaje</strong>
                                                <br>
                                                <p class="text-muted">{{ planSelected.host == 1 ? 'Este plan cuenta con hospedaje' : 'Este plan no cuenta con hospedaje'  }}</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Agenda Acadedmica</strong>
                                                <br>
                                                <p class="text-muted">{{ planSelected.academic_agenda == 1 ? 'Este plan cuenta con agenda academica' : 'Este plan no cuenta con agenda academica'  }}</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Almuerzos</strong>
                                                <br>
                                                <p class="text-muted">{{  !planSelected.lunches ? 'Este plan no cuenta con este alimento ' : planSelected.lunches   }}</p>
                                            </div>
                                            <!-- <div class="col-md-3 col-xs-6"> <strong>Desayunos</strong>
                                                <br>
                                                <p class="text-muted">{{  !planSelected.breakfast ? 'Este plan no cuenta con este alimento ' : planSelected.breakfast   }}</p>
                                            </div> -->
                                            <div class="col-md-3 col-xs-6"> <strong>Cenas</strong>
                                                <br>
                                                <p class="text-muted">{{  !planSelected.dinner ? 'Este plan no cuenta con este alimento ' : planSelected.dinner   }}</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6"> <strong>Refrigerios</strong>
                                                <br>
                                                <p class="text-muted">{{  !planSelected.refreshments ? 'Este plan no cuenta con este alimento ' : planSelected.refreshments   }}</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6"> <strong>Valor</strong>
                                                <br>
                                                <p class="text"><strong>{{  !planSelected.price ? 'Este plan no tiene costo ' : addTax(planSelected.price) | currency  }} IVA Incluido</strong></p>
                                            </div>
                                </div>
                            </div>
                        </blockquote>
                        <blockquote v-if="planSelected">
                            <div v-if="planSelected.host">
                            <h3> <i class="fa fa-h-square"></i> Seleccione un hotel</h3>
                            <v-select id="hotelSelect" placeholder="Seleccione un hotel" icon="fa fa-user" :options="hotels" v-model="hotelSelected" @input="setHotel" label="hotel_name">
                                <template slot="option" slot-scope="option">
                                        {{ option.hotel_name }}
                                </template>
                            </v-select>
                            </div>
                            <room-reservation v-if="hotelSelected" :hotel_to_event_id="hotelSelected.id" :roomsSelected="roomsSelected" @setRoom="setRoom"></room-reservation>
                        </blockquote>

                        <blockquote v-else>
                            <h3>seleccione un plan</h3>
                        </blockquote>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success waves-effect"
                            :disabled="cleared" 
                            @click="onComplete"
                        >
                        Aceptar
                        </button>
                        <button type="button" class="btn btn-danger waves-effect waves-light"  @click="closeModal">Cancelar</button>                 
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
import VueCurrencyFilter from 'vue-currency-filter'
Vue.use(VueCurrencyFilter,{
    symbol: '$', // El símbolo, por ejemplo €
  thousandsSeparator: ',', // Separador de miles
  fractionCount: 2, // ¿Cuántos decimales mostrar?
  fractionSeparator: '.', // Separador de decimales
  symbolPosition: 'front', // Posición del símbolo. Puede ser al inicio ('front') o al final ('') es decir, si queremos que sea al final, en lugar de front ponemos una cadena vacía ''
  symbolSpacing: true // Indica si debe poner un espacio entre el símbolo y la cantidad

})
import toastr from 'toastr';
import roomReservation from './Room-reservation'
export default {
    props: ['assistant_id','invitation_type','event_id','roomsSelected'],
    components: {
        toastr,
        roomReservation
        },
    data () {
        return {
            assistant:      [],
            cities:         [],
            plans:          [],
            planSelected:   null,
            hotels:         [],
            hotelSelected:  null,
            roomSelected:   null,
            errors:         [],
            cleared:        true,
            err:    {
                plan:   ''
            }
        }
    },
    created : function() {
        this.getAssitant();
        this.getPlans();
        this.getHotelsByEvent();
    },
    mounted : function(){
        $('#newSuscriptionModal').modal('show');
    },
    methods : {
        getAssitant(){
            let url = `/api/${this.assistant_id}/get-asistant-by-id-external`
            axios.get(url).then(response =>{
                this.assistant = response.data;
                this.errors = [];
            }).catch(error => {
                this.assistant = [];
                this.errors = error.response.data;
            })
        },
        getPlans(){
            let url = `/api/${this.invitation_type}/${this.event_id}/get-plans-external`
            axios.get(url).then(response =>{
                this.plans = response.data;
                this.errors = [];
            }).catch(error => {
                this.plans = [];
                this.errors = error.response.data;
            })
        },
        getHotelsByEvent(){
            let url = `/api/${this.event_id}/get-hotels-external`;
            axios.get(url).then(response =>{
                this.hotels = response.data
            }).catch(error => {
                this.errors = error.response.data;
            })
        },
        closeModal(){
            $('#newSuscriptionModal').modal('hide');
            this.$emit('closeNewSuscription');
        },
        addTax(val){
            let IVA = 19;
            let IVACalc = parseInt(val) * IVA/100;
            let total = parseInt(val) + parseInt(IVACalc);
            return total;
        },
        setRoom(val){
            this.roomSelected = val;
            if(this.roomSelected){
                if(this.planSelected.host == 1 && this.roomSelected) {
                    this.cleared = false
                }
            }else{
                this.cleared = false
            }
        },

        setPlan(){
            if(this.planSelected){
                if(this.planSelected.host == 0){
                    this.cleared = false;
                }else{
                    this.cleared = true;
                }
            }else{
                this.cleared = true;
            }
        },
        setHotel(){
            !this.hotelSelected && this.planSelected.host == 1 ? this.cleared = true : false
            !this.hotelSelected && this.planSelected.host == 1 ? this.roomSelected = null : false
        },
        onComplete(){
            let planFill = [];
            planFill.assistant_id = this.assistant_id;
            planFill.plan_id = this.planSelected.id;
            planFill.hotel_id = this.hotelSelected ? this.hotelSelected.id : '';
            planFill.id_room = this.roomSelected ? this.roomSelected.id : '';
            $('#newSuscriptionModal').modal('hide');
            this.$emit('setPlan',planFill,this.planSelected,this.roomSelected,this.assistant.names+' '+this.assistant.last_names,this.planSelected.plan,planFill.id_room, this.planSelected.price);
        },
    }
}
</script>