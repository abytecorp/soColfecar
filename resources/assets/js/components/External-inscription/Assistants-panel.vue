<template>
    <div>
<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Column -->
                                    <div class="col-lg-6 col-md-12">
                                        <h4 class="card-title">Seleccione un asistente y asigne plan  </h4>
                                        <h6 class="card-subtitle">si no se encuentra enlistado puede agregar uno nuevo </h6>

                                        <button class="btn btn-outline-info waves-effect waves-light" @click="setNewAssistant" type="button"><span class="btn-label"></span>Nuevo asistente <i class="fa fa-plus"></i></button>
                                        <br/>
                                        <hr>
                                        <div v-for="assistant in assistants" :key="assistant.id" :class="[!assistant.id_number ? classes.danger : assistant.id_status === 'suscripted' ? classes.success : classes.warning]"> <i class="ti-user"></i> {{ assistant.names }} {{ assistant.last_names }}
                                            <button type="button" class="close"  aria-label="Close" @click="suscriptionAssistant(assistant.id,assistant.id_number,assistant.id_status)"> <i class="fa fa-edit">  </i> </button> 
                                            <span  class="close"  aria-label="Close"><i></i> - </span>
                                            <button type="button" class="close"  aria-label="Close" @click="updateAssistantData(assistant.id,assistant.id_number)"> <i class="fa fa-address-card">  </i> </button>
                                        </div>
                                        
                                    </div>
                                    <!-- Column -->

                                    <!-- Column -->
                                    <div class="col-lg-6 col-md-12">
                                        <h4 class="card-title">Descripcion del estado del plan </h4>
                                        <h6 class="card-subtitle">Cada usuario cuenta con una caja que indica su estado cambiando de color dependiendo su acción </h6>
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                            <h3 class="text-success"><i class="fa fa-check-circle"></i> Plan asignado</h3> Este estado se representa por el color verde, e indica que el usuario ya tiene listo un plan seleccionado y está listo para inscribirse.
                                        </div>
                                        <div class="alert alert-warning">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                            <h3 class="text-warning"><i class="fa fa-edit"></i> Sin asignar</h3> Este estado indica que el contacto está registrado en nuestra base de datos previamente, o asistió a alguno de los eventos organizados por el gremio, contamos con sus datos, los puede actualizar pero aun no se a elegido un plan para su posterior registro.
                                        </div>
                                        <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                            <h3 class="text-danger"><i class="fa fa-address-card"></i> Sin Identificación</h3> Es importante para la inscripción que el documento de identificación se diligencie correctamente en la base de datos, ya que con este podrá acceder a los diferentes beneficios del aplicativo, rueda de prensa, entre otros, al presionar en este icono <i class="fa fa-address-card"></i> por cada uno de los usuarios respectivamente, podra actualizar este dato.
                                        </div>
                                        <!-- <div class="alert alert-info">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                            <h3 class="text-info"><i class="fa fa-check"></i> Ya inscrito</h3> Este estado indica que este asistente ya esta inscrito en este evento.
                                        </div> -->
                                    </div>
                                    <!-- Column -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<modal-new-external-assistant v-if="isNewAssistant" :company_id="company_id.company_id" @closeNewAssistant="closeNewAssistant"></modal-new-external-assistant>
<modal-edit-external-assistant v-if="isEditAssistant" :company_id="company_id.company_id" :assistant_id="isEditAssistant" @closeEditAssistant="closeEditAssistant"></modal-edit-external-assistant>
<modal-suscription-assistant-ext 
    v-if="isNewSuscription" 
    :assistant_id="assistantSelected" 
    :invitation_type="invitation_type" 
    :event_id="event_id"
    :roomsSelected="roomsSelected"
    @closeNewSuscription="closeNewSuscription"
    @setPlan="setPlan">
</modal-suscription-assistant-ext>
    </div>
</template>
<script>
import ModalNewExternalAssistant from '../External-inscription/Modal-new-external-assistant';
import ModalEditExternalAssistant from '../External-inscription/Modal-edit-external-assistant';
import ModalSuscriptionAssistantExt from '../External-inscription/Modal-suscription-assistant-ext';

import toastr from 'toastr';
export default {
    props:['company_id','invitation_type','event_id','enroll_name','enroll_email','is_bill_order','bill_order_date','pay_way'],
    components: {
        ModalNewExternalAssistant,
        ModalEditExternalAssistant,
        ModalSuscriptionAssistantExt,
        toastr
    },
    data () {
        return {
            assistants:         [],
            isNewAssistant:     null,
            isEditAssistant:    null,
            isNewSuscription:   null,
            assistantSelected:  null,
            roomsSelected:      [],
            classes:    {
                warning:    'alert alert-warning alert-rounded',
                danger:     'alert alert-danger alert-rounded',
                success:    'alert alert-success alert-rounded',
                info:       'alert alert-info alert-rounded'
            },
            inscribed:          [],
            errors:             []
        }
    },
    created : function (){
        //this.getEventTypes()
        this.getAssistantsByCompany()
        
    },
    mounted : function (){
    },
    // beforeUpdate: function () {
    //     
    // },
    methods : {
        getAssistantsByCompany() {
            let url = `/api/${this.company_id.company_id}/get-assistants-by-company-external`;
            axios.get(url).then(response =>{
                this.assistants = response.data;
                this.valSus();
                this.errors = [];
            }).catch(error => {
                this.assistants = [];
                this.errors = error.response.data;
            });
        },
        termAcept (){
            this.$emit('setAcept',true);
            $('#authDatamodal').modal('hide');
            
        },
        setNewAssistant(){
            this.isNewAssistant = !this.isNewAssistant
        },
        closeNewAssistant(){
            this.getAssistantsByCompany()
            this.isNewAssistant = null;
        },
        suscriptionAssistant(assistant_id,assistant_id_number,id_status){
            if(assistant_id_number){
                if(id_status != 'suscripted'){
            this.assistantSelected = assistant_id;
            this.isNewSuscription = !this.isNewSuscription;
            }else{
                toastr.warning('Este asistente ya se encuentra incrito en el evento, si desea cancelñar la suscripcion, informe al area comercial de Colfecar.!');
                }}else{    
                    toastr.error('Primero debe ingresar el numero y tipo de identificación de este contacto!');
            }
        },
        closeNewSuscription(){
            this.isNewAssistant = null;
            this.assistantSelected = null;
            this.isNewSuscription = null;
        },
        storeRecord(record){
            return new Promise((resolve, reject) => {
            let recSended = [];
            recSended = Object.assign({}, record);
            let url = `/api/store-record-external`;
            axios.post(url,recSended).then(response =>{
                let record_id = response.data.id;
                resolve(record_id);
                //console.log(`the record id: ${record_id}`)
            }).catch(error => {
                this.errors = error.response.data;
                reject();
                //return false;
            });
            })

        },
        async storeBill(record_id,price){
            let bill = [];
            bill = {"record_id" : record_id, "price" : price};
            console.log(bill);
            return new Promise((resolve, reject) => {
                let url = '/api/store-new-bill';
                axios.post(url,bill).then(response =>{
                    let bill_id = response.data.id
                    console.log(response.data);
                    resolve(bill_id);
                }).catch(error => {
                    this.errors = error.response.data;
                    console.log(this.errors);
                    reject();
            });
            })
        },
        async setPlan(val,planSelected,roomSelected,names,plan,room,price){
            this.isNewSuscription = null;
            let toPlan = [];
            toPlan.id_assistant = val.assistant_id;
            toPlan.id_event = this.event_id;
            toPlan.id_plan = val.plan_id;
            toPlan.id_record_state = 1;
            toPlan.enroll_name = this.enroll_name;
            toPlan.enroll_email = this.enroll_email;
            toPlan.is_bill_order = this.is_bill_order;
            toPlan.bill_order_date = this.bill_order_date;
            toPlan.names = names;
            toPlan.plan = plan;
            toPlan.room = room;
            toPlan.pay_way = this.pay_way;
            if(planSelected.refreshments == 4){
                toPlan.Refrigeriodia4 = 1;
                toPlan.Refrigeriodia3 = 1;
                toPlan.Refrigeriodia2 = 1;
                toPlan.Refrigeriodia1 = 1;
            }
            if(planSelected.refreshments == 3){
                toPlan.Refrigeriodia3 = 1;
                toPlan.Refrigeriodia2 = 1;
                toPlan.Refrigeriodia1 = 1;
            }
            if(planSelected.refreshments == 2){
                toPlan.Refrigeriodia2 = 1;
                toPlan.Refrigeriodia1 = 1;
            }
            if(planSelected.refreshments == 1){
                toPlan.Refrigeriodia1 = 1;
            }
            if(planSelected.dinner == 3){
                toPlan.Cenadia3 = 1;
                toPlan.Cenadia2 = 1;
                toPlan.Cenadia1 = 1;
            }
            if(planSelected.dinner == 2){
                toPlan.Cenadia2 = 1;
                toPlan.Cenadia1 = 1;
            }
            if(planSelected.dinner == 1){
                toPlan.Cenadia1 = 1;
            }
            if(planSelected.lunches == 3){
                toPlan.Almuerzodia3 = 1;
                toPlan.Almuerzodia2 = 1;
                toPlan.Almuerzodia1 = 1;
            }
            if(planSelected.lunches == 2){
                toPlan.Almuerzodia2 = 1;
                toPlan.Almuerzodia1 = 1;
            }
            if(planSelected.lunches == 1){
                toPlan.Almuerzodia1 = 1;
            }
            let record_id = await this.storeRecord(toPlan);
            await this.storeBill(record_id,price);
            if(roomSelected){
                  await this.storeRoom(roomSelected, record_id);
                  toastr.success('Se registro el plan correctamente!');
                  this.isNewSuscription = null;
                  this.$emit('setIsSus',toPlan);
                  this.getAssistantsByCompany();
             }else{
                toastr.success('Se registro el plan correctamente!');
                this.isNewSuscription = null;
                this.$emit('setIsSus',toPlan);
                this.getAssistantsByCompany();
             } 
        },
        storeRoom(roomSelected, record_id){
            return new Promise((resolve, reject) => {
            if(roomSelected.record_id == 'is_double'){
                roomSelected.record_id = record_id;
                let url = `/api/${roomSelected.id}/set-double-room`
                axios.put(url,roomSelected).then(response =>{
                    resolve();
                }).catch(error => {
                    this.errors = error.response.data;
                    reject();
                });
            }else if(roomSelected.companion_id == 'is_double'){
                roomSelected.companion_id = record_id;
                let url = `/api/${roomSelected.id}/set-double-room`
                axios.put(url,roomSelected).then(response =>{
                    resolve();
                }).catch(error => {
                    this.errors = error.response.data;
                    reject();
                });
            }else{
                roomSelected.record_id = record_id;
                let url = `/api/${roomSelected.id}/set-single-room`
                axios.put(url,roomSelected).then(response =>{
                    resolve();
                }).catch(error => {
                    this.errors = error.response.data;
                    reject();
                });
                return;
            }
            })
        },
        updateAssistantData(assistant_id,assistant_id_number){
            this.isEditAssistant = assistant_id;
        },
        closeEditAssistant(){
            this.getAssistantsByCompany()
            this.isEditAssistant = null;
        },
        setSus(){
            console.log(`the id is ${assistant_id}`);
        },
        valAssistant(assistant_id){
            return new Promise((resolve, reject) => {
            let url = `/api/${assistant_id}/${this.event_id}/get-suscripted-assistant`;
            axios.get(url).then((response) =>{
                if(response.data){
                    resolve(response.data);
                }
            }).catch(error => {
                this.errors = error.response.data;
            });
            })
        },
        valSus(){
            this.assistants.forEach(async (assistant) => {
                let arr = await this.valAssistant(assistant.id);
                let selIndex = this.assistants.findIndex(assistant => assistant.id === arr.id_assistant);
                this.assistants[selIndex].id_status = 'suscripted';
        });
        }
        
    }
} 
</script>
