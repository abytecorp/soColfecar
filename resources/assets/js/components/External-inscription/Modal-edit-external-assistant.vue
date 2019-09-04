<template>
    <div>
        <div id="editAssistantModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Editar datos del asistente</h4>
                        <button type="button" class="close" @click="closeModal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">EDITE LOS DATOS DEL CONTACTO {{ assistant.names }} {{ assistant.last_names }}</h4>
            </div>
            <div class="card-body">
                    <form method="POST" v-on:submit.prevent="storeContact">
                    <div class="form-body">
                        <!-- <h3 class="card-title"></h3> -->
                        <hr>
                        <div class="row p-t-20">
                            <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Nombres</label>
                                <input type="text" class="form-control" name="namesInput" v-model="assistant.names">
                                <small class="form-control-feedback"> Nombres del asistente </small>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.names }}</span>
                            </div>
                            </div>
                            
                            <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Apellidos</label>
                                <input type="text" class="form-control" name="last_namesInput" v-model="assistant.last_names">
                                <small class="form-control-feedback"> Apellidos del asistente </small>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.last_names }}</span>
                            </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Tipo de identificacion</label>
                                    <select name="" id="" class="form-control" v-model="assistant.id_type">
                                        <option v-for="idType in idTypes" :key="idType.id" :value="idType.id">{{ idType.id_type }}</option>
                                    </select>
                                     <small class="form-control-feedback"> Tipo de identificación </small>
                                     <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.id_type }}</span>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label">Identificación</label>
                                    <input type="number" class="form-control" name="identificationInput" v-model="assistant.id_number">
                                    <small class="form-control-feedback"> Numero de identificacion </small>
                                    <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.id_number }}</span>
                                </div>
                            </div>
                        
                            <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Ciudad</label>
                                <v-select  :options="cities" v-model="assistant.city" placeholder="Seleccione la ciudad donde vive"  label="city">
                                    <template slot="option" slot-scope="option">
                                        {{ option.city }} 
                                    </template>
                                </v-select>
                                <small class="form-control-feedback"> Ciudad donde reside </small>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.id_city }}</span>
                            </div>
                            </div>

                            <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Direccion</label>
                                <div v-if="isAddressEdit == null" class="input-group mb-3">
                                    <input type="text" class="form-control" disabled v-model="assistant.address" aria-label="Username">
                                    <div class="input-group-append" @click="editAddress">
                                        <span class="input-group-text"><i class="fa fa-edit"></i></span>
                                    </div>
                                </div>
                                <address-autocomplete v-if="isAddressEdit"  @upAddress="upAddress" :address="assistant.address"></address-autocomplete>
                                <small class="form-control-feedback"> Dirección del lugar donde reside </small>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.address }}</span>
                            </div>
                            </div>
                       
                            <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Telefono</label>
                                <input type="text" class="form-control" name="telInput" v-model="assistant.tel">
                                <small class="form-control-feedback"> Telefono fijo </small>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.tel }}</span>
                            </div>
                            </div>
                        
                            <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Celular</label>
                                <input type="text" class="form-control" name="celInput" v-model="assistant.cel">
                                <small class="form-control-feedback"> Celular de contacto </small>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.cel }}</span>
                            </div>
                            </div>

                            <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Cargo</label>
                                <input type="text" class="form-control" name="positionInput" v-model="assistant.position">
                                <small class="form-control-feedback"> Cargo en la empresa </small>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.position }}</span>
                            </div>
                            </div>

                            <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input type="text" class="form-control" name="emailInput" v-model="assistant.email" @keypress="valMailFormat()">
                                <small class="form-control-feedback"> Correo electronico de contacto </small>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.email }}</span>
                                <span class="text-danger">{{ err.email }}</span>
                            </div>
                            </div>
                        
                        
                        <hr>
                        <!-- <button type="submit" class="btn btn-info waves-effect text-left">Guardar</button> -->
                        </div>
                    </div>
                    </form>
            </div>
        </div>
    </div>
</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success waves-effect" @click="updateAssistant">Aceptar</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light" @click="closeModal">Cancelar</button>                 
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
import toastr from 'toastr';
import FloatingLabel from 'vue-simple-floating-labels';
import AddressAutocomplete from '../Address-autocomplete';
export default {
    props: ['company_id','assistant_id'],
    components: {
        toastr,
        FloatingLabel,
        AddressAutocomplete,
        },
    data () {
        return {
            assistant:   [],
            err:    {
                names:          '',
                last_names:     '',
                id_type:        '',
                id_number:      '',
                id_city:        '',
                address:        '',
                tel:            '',
                cel:            '',
                position:       '',
                email:          '',
                id_company:     ''
            },
            cities:         [],
            idTypes:        [],
            isAddressEdit:  null,
            errors:         [],
        }
    },
    created : function() {
        this.getCities();
        this.getIdTypes();
    },
    mounted : function(){
        $('#editAssistantModal').modal('show');
        this.getAssistantById();
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
        getIdTypes() {
            let url = '/api/get-id-types-external';
            axios.get(url).then(response =>{
                this.idTypes = response.data;
                this.errors = [];
            }).catch(error => {
                this.idTypes = [];
                this.errors = error.response.data;
            });
        },
        getAssistantById(){
            console.log(this.assistant_id);
            let url = `/api/${this.assistant_id}/get-asistant-by-id-external`;
            axios.get(url).then(response =>{
                console.log(response.data);
                this.assistant = response.data;
                this.errors = [];
            }).catch(error => {
                this.assistant = [];
                this.errors = error.response.data;
            });
        },
        updateAssistant : function() {
            this.assistant.id_company = this.company_id;
            this.assistant.id_city = typeof(this.assistant.id_city) == 'object' ? this.assistant.id_city.id : this.assistant.id_city;
            var url = `/api/${this.assistant.id}/assistants-up-external`;
            axios.put(url, this.assistant).then(response => {
                toastr.success(`Se actualizaron los datos del contacto ${this.assistant.names} ${this.assistant.last_names} con exito!`);
                $('#editAssistantModal').modal('hide');
                this.$emit('closeEditAssistant');
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        upAddress(val){
            this.assistant.address = val
        },
        closeModal(){
            $('#editAssistantModal').modal('hide');
            this.$emit('closeEditAssistant');
        },
        valMailFormat : function(){
            let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if(!re.test(String(this.assistant.email).toLowerCase()) && this.assistant.email){
                this.err.email = 'Debe registrar un correo con el formato correcto >>ejemplo@empresa.com<<'
                return false
                }else{
                    this.err.email = ''
                    return true
                   }
        },
        editAddress(){
            this.isAddressEdit = !this.isAddressEdit;
        }
        
    }
}
</script>