<template>
    <div>
        <div id="newAssistantModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Datos del asistente</h4>
                        <button type="button" class="close" @click="closeModal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                    <form method="POST" v-on:submit.prevent="storeAssistant">
                        <FloatingLabel
                            :config="{label: 'Nombres del asistente (*)', hasError: err.names, hasClearButton: false }">
                            <input type="text" class="form-control" name="namesInput" v-model="assistant.names">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.names }}</span>
                        </FloatingLabel>
                        <FloatingLabel
                            :config="{label: 'Apellidos del asistente (*)', hasError: err.last_names, hasClearButton: false }">
                            <input type="text" class="form-control" name="last_namesInput" v-model="assistant.last_names">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.last_names }}</span>
                        </FloatingLabel>
                        <FloatingLabel
                            :config="{label: 'Identificacion del asistente (*)', hasError: err.last_names, hasClearButton: false }">
                            <input type="number" class="form-control" name="identificationInput" v-model="assistant.id_number">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.id_number }}</span>
                        </FloatingLabel>
                        <hr>
                            <v-select :options="cities" v-model="assistant.id_city" placeholder="Seleccione la ciudad donde vive"  label="city">
                                <template slot="option" slot-scope="option">
                                    {{ option.city }} 
                                </template>
                            </v-select>
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.id_city }}</span>
                        <hr>
                        <hr>
                            <address-autocomplete @upAddress="upAddress"></address-autocomplete>
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.address }}</span>
                        <hr>
                        <FloatingLabel
                            :config="{label: 'Telefono', hasError: err.tel, hasClearButton: false }">
                            <input type="text" class="form-control" name="telInput" v-model="assistant.tel">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.tel }}</span>
                        </FloatingLabel>
                        <FloatingLabel
                            :config="{label: 'Celular', hasError: err.tel, hasClearButton: false }">
                            <input type="text" class="form-control" name="celInput" v-model="assistant.cel">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.cel }}</span>
                        </FloatingLabel>
                        <FloatingLabel
                            :config="{label: 'Cargo', hasError: err.position, hasClearButton: false }">
                            <input type="text" class="form-control" name="positionInput" v-model="assistant.position">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.position }}</span>
                        </FloatingLabel>
                        <FloatingLabel
                            :config="{label: 'Em@il', hasError: err.email, hasClearButton: false }">
                            <input type="text" class="form-control" name="emailInput" v-model="assistant.email" @keypress="valMailFormat()">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.email }}</span>
                            <span class="text-danger">{{ err.email }}</span>
                        </FloatingLabel>
                        
                        <hr>
                        <!-- <button type="submit" class="btn btn-info waves-effect text-left">Guardar</button> -->
                    </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success waves-effect" @click="storeAssistant">Aceptar</button>
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
    props: ['company_id'],
    components: {
        toastr,
        FloatingLabel,
        AddressAutocomplete,
        },
    data () {
        return {
            assistant:   {
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
            errors:         [],
        }
    },
    created : function() {
        this.getCities();
    },
    mounted : function(){
        $('#newAssistantModal').modal('show');
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
        storeAssistant : function() {
            this.assistant.id_company = this.company_id;
            this.assistant.id_city = typeof(this.assistant.id_city) == 'object' ? this.assistant.id_city.id : this.assistant.id_city;
            var url = '/api/assistants-external';
            axios.post(url, this.assistant).then(response => {
                toastr.success(`Se ha creado el contacto ${this.assistant.names} ${this.assistant.last_names} con exito!`);
                this.$emit('getAssistantsByCompany')
                $('#newAssistantModal').modal('hide');
                this.$emit('closeNewAssistant');
            }).catch(error => {
                //this.assistant = {}
                this.errors = error.response.data
            });
        },
        upAddress(val){
            this.assistant.address = val
        },
        closeModal(){
            $('#newAssistantModal').modal('hide');
            this.$emit('closeNewAssistant');
        },
        valMailFormat : function(){
            let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            //console.log(re.test(String(this.company.email).toLowerCase()))
            if(!re.test(String(this.assistant.email).toLowerCase()) && this.assistant.email){
                this.err.email = 'Debe registrar un correo con el formato correcto >>ejemplo@empresa.com<<'
                return false
                }else{
                    this.err.email = ''
                    return true
                   }
        },
        
    }
}
</script>