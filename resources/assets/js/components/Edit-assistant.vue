<template>
    <div>
                    <form method="POST" v-on:submit.prevent="editContact()">
                        <div class="form-group">
                            <label for="namesInput">Nombres(*)</label>
                            <input type="text" class="form-control" name="namesInput" v-model="assistant.names" placeholder="Nombres">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.names }}</span>
                        </div>
                        <div class="form-group">
                            <label for="last_namesInput">Apellidos(*)</label>
                            <input type="text" class="form-control" name="last_namesInput" v-model="assistant.last_names" placeholder="Apellidos">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.last_names }}</span>
                        </div>
                        <div class="form-group">
                            <label for="last_namesInput">Identificacion</label>
                            <input type="text" class="form-control" name="last_namesInput" v-model="assistant.id_number" placeholder="Numero de identificacion">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.id_number }}</span>
                        </div>
                        <div class="form-group m-form__group">
                        <label for="bsNameInput">Ciudad:</label>
                                <v-select :options="cities"  v-model="assistant.city" @change="delVar" label="city">
                                    <template slot="option" slot-scope="option">
                                        {{ option.city }}
                                    </template>
                                </v-select>
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.id_city }}</span>
                        </div>
                        <div class="jumbotron">
                        <div class="form-group">
                            <label for="webInput">Direccion</label>
                            <address-gen :data="assistant.address" @upAddress="setUpAddress" @upAddressDig="setUpAddressDig" @toReset="setReset" ></address-gen>
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.address }}</span>
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="webInput">Telefono</label>
                            <input type="text" class="form-control" name="webInput" v-model="assistant.tel" placeholder="Direccion">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.tel }}</span>
                        </div>
                        <div class="form-group">
                            <label for="webInput">Celular</label>
                            <input type="text" class="form-control" name="webInput" v-model="assistant.cel" placeholder="Direccion">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.cel }}</span>
                        </div>
                        <div class="form-group">
                            <label for="emailInput">Cargo</label>
                            <input type="text" class="form-control" name="emailInput" v-model="assistant.position" placeholder="Cargo">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.position }}</span>
                        </div>
                         <div class="form-group">
                            <label for="emailInput">Em@il(*)</label>
                            <input type="text" class="form-control" name="emailInput" v-model="assistant.email" placeholder="Em@il">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.email }}</span>
                        </div>
                        
                        <hr>
                        <button type="submit" class="btn btn-info waves-effect text-left">Guardar</button>
                        <button type="button" class="btn btn-danger waves-effect text-left" @click="cancel">Cancelar</button>
                    </form>    
    </div>
</template>
<script>

//import modules
import addressGen from './Address-gen'

import toastr from 'toastr'


export default {
    components: {
        addressGen
    },
    props: ['data'],
    data () {
        return {
            errors:     [],
            assistant:  {
                names:         '',
                last_names:    '',
                id_number:     '',
                email:         '',
                position:      '',
                id_card:       '',
                id_city:       '',
                city:          null,
                address:       '',
                tel:           '',
                cel:           '',
                position:      '',
                email:         '',
            },
            cities:     []
        }
    },
    created: function() {
        //created methods
        this.getCities()
    },
    mounted() {
        //mounted method, when the dom is charged
        this.getContact(this.data)
    },
    computed: {
        //computed functions
    },
    methods: {
        getContact : function (val) {
            let url ='/api/get-assistant-by-id/'+val
            axios.get(url).then(response =>{
                this.assistant = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
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
        editContact: function () {
            this.assistant.names = this.assistant.names.toUpperCase()
            this.assistant.last_names = this.assistant.last_names.toUpperCase()
            this.assistant.id_city = typeof(this.assistant.city) == "object" ? this.assistant.city.id : this.assistant.id_city 
            //console.log(`el id de la ciudad es este: ${this.assistant.id_city}`)
            var url = '/api/assistants/' + this.assistant.id;
            //console.log(`the url are ${url}`)
            axios.put(url, this.assistant).then(response => {
                this.$bus.$emit('set-assistants-in-contacts-manage', this.assistant.id_company)
                toastr.success(`Asistente ${this.assistant.names} actualizado con exito`);
                this.assistant = {
                    names:         '',
                    last_names:    '',
                    id_number:     '',
                    email:         '',
                    position:      '',
                    id_card:       '',
                    id_city:       '',
                    city:          null,
                    address:       '',
                    tel:           '',
                    cel:           '',
                    position:      '',
                    email:         '',
                    id_company:    '',
                };
                
                
            }).catch(error =>{
                this.errors = error.response.data;
            });
        },
        setUpAddress : function(val) {
            //(Addres-gen)this function used to add the nomenclature an the letters, whit spaces to build the string
            this.assistant.address = this.assistant.address + ' ' + val + ' '
        },
        setUpAddressDig : function(val) {
            //(Addless-gen)this function add the string whitout a initial space, this used in the numbers.
            this.assistant.address = this.assistant.address + val
        },
        setReset : function() {
            //(Address-gen) this function reset or erase the charset or adress that gives the object
            this.assistant.address = ''
        },
        delVar : function() {
            if(this.assistant.city == ''){
                this.assistant.id_city = ''
                this.assistant.city = ''
            }
        },
        cancel : function() {
            this.$emit('cancel',this.assistant.id_company);
        }
    }
}
</script>