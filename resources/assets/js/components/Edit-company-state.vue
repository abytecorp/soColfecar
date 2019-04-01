<template>
<div>
    <hr>
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <form v-on:submit.prevent="storeCompanyState">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Estado de empresa</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" v-model="up_company_state.company_state" placeholder="Ingrese el estado de la empresa">
                        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.company_state }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDescription">Descripcion</label>
                        <textarea class="form-control" id="exampleTextarea" rows="3" v-model="up_company_state.description" placeholder="Message"></textarea>
                        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.description }}</span>
                    </div>
                    <div class="form-group">
                        <v-select id="city" :options="icons" v-model="up_company_state.icon"  label="icon">
                            <template slot="option" slot-scope="option">
                                 <i :class="option.icon"></i> {{ option.icon }}
                            </template>
                        </v-select>
                        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.icon }}</span>
                    </div>
                    
                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Actualizar</button>
                    <button type="button" class="btn btn-danger" @click="cancelNew"> Cancelar</button>
                </form>
            </div>
        </div>
</div>
</template>
<script>
export default {
    components: {
        //compponents
    },
    props: ['data'],
    data () {
        return {
            //variables
            icons:      [],
            up_company_state:   {
                company_state:  '',
                description:    '',
                icon:           '',
                slug:           ''
            },
            errors:     []
        }
    },
    created: function() {
        this.getIcons()
        this.getCompanyState()
    },
    computed: {
        //computed functions
    },
    methods: {
        getCompanyState : function () {
            let url = 'affiliations/get-company-state/'+ this.data;
            axios.get(url).then(response =>{
                this.up_company_state = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        getIcons : function() {
            let url = '/api/get-icons';
            axios.get(url).then(response =>{
                this.icons = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        storeCompanyState :function() {
            let url = 'company-state/'+this.up_company_state.id
            this.up_company_state.slug = this.up_company_state.company_state != '' ? this.up_company_state.company_state.toLowerCase().split(" ").join("-") : ''
            this.up_company_state.icon = typeof(this.up_company_state.icon) == "object" ? this.up_company_state.icon.icon : this.up_company_state.icon
            console.log(this.up_company_state.icon)
            axios.put(url, this.up_company_state).then(response =>{
                //this.responseTest = response.data
                //this.$bus.$emit('comp-cant-up')
                this.$bus.$emit('set-edit-company-state-false')
                this.$bus.$emit('get-company-states')
                this.up_company_state.company_state=     '',
                this.up_company_state.description=       '',
                this.up_company_state.slug=              '',
                this.up_company_state.icon=              ''
            }).catch(error => {
                console.log(error)
                this.errors = error.response.data;
            });
        },
        cancelNew : function () {
            this.$bus.$emit('set-edit-company-state-false')
            this.up_company_state.company_state=     '',
            this.up_company_state.description=       '',
            this.up_company_state.slug=              '',
            this.up_company_state.icon=              ''
        }
    }
}
</script>