<template>
<div>
    <div id="update-assistant-modal" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Crea un nuevo Contacto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="POST" v-on:submit.prevent="createNewContact">
                        <div class="form-group">
                            <label for="namesInput">Nombres(*)</label>
                            <input type="text" class="form-control" name="namesInput" v-model="assistantUp.names" placeholder="Nombres">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.names }}</span>
                        </div>
                        <div class="form-group">
                            <label for="last_namesInput">Apellidos(*)</label>
                            <input type="text" class="form-control" name="last_namesInput" v-model="assistantUp.last_names" placeholder="Apellidos">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.last_names }}</span>
                        </div>
                        <div class="form-group">
                            <label for="last_namesInput">Identificacion</label>
                            <input type="text" class="form-control" name="last_namesInput" v-model="assistantUp.id_number" placeholder="Numero de identificacion">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.id_number }}</span>
                        </div>
                        <label for="id_company_state">Seleccione la ciudad(*)</label>
                            <v-select :options="cities" v-model="assistantUp.id_city"  label="city">
                                <template slot="option" slot-scope="option">
                                    {{ option.city }} ( {{ option.get_departament.departament }}  )
                                </template>
                            </v-select>
                            <!-- v select -->
                        <div class="form-group">
                            <label for="webInput">Direccion</label>
                            <input type="text" class="form-control" name="webInput" v-model="assistantUp.address" placeholder="Direccion">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.address }}</span>
                        </div>
                        <div class="form-group">
                            <label for="webInput">Telefono</label>
                            <input type="text" class="form-control" name="webInput" v-model="assistantUp.tel" placeholder="Direccion">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.tel }}</span>
                        </div>
                                                <div class="form-group">
                            <label for="webInput">Celular</label>
                            <input type="text" class="form-control" name="webInput" v-model="assistantUp.cel" placeholder="Direccion">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.cel }}</span>
                        </div>
                        <div class="form-group">
                            <label for="emailInput">Cargo</label>
                            <input type="text" class="form-control" name="emailInput" v-model="assistantUp.position" placeholder="Cargo">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.position }}</span>
                        </div>
                         <div class="form-group">
                            <label for="emailInput">Em@il(*)</label>
                            <input type="text" class="form-control" name="emailInput" v-model="assistantUp.email" placeholder="Em@il">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.email }}</span>
                        </div>
                        
                        <hr>
                        <button type="submit" class="btn btn-info waves-effect text-left">Guardar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    
                </div>
                
            </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
    </div>

</div>
</template>
<script>
export default {
    data () {
        return {
            assistantUp: {
                names:          '',
                last_names:     '',
                id_number:     '',
                email:         '',
                position:      '',
                id_card:       '',
                id_city:       '',
                address:       '',
                tel:           '',
                cel:           '',
                position:      '',
                email:         '',
            },
            errors:         [],
            cities:         [],
        }
    },
    created: function() {
        this.getCities()
        console.log(`the modal update module its running`)
        //this.getUserTypes()
        //this.getIdTypes()
    },
    methods: {
            getCities : function() {
            var url = '/api/get-cities/';
            axios.get(url).then(response =>{
                this.cities = response.data
            });
        },
    }
}
</script>
