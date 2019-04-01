<template>
<div>
    <hr>
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <form v-on:submit.prevent="storeCompanyState">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Estado de empresa</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" v-model="company_state.company_state" placeholder="Ingrese el estado de la empresa">
                        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.company_state }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDescription">Descripcion</label>
                        <textarea class="form-control" id="exampleTextarea" rows="3" v-model="company_state.description" placeholder="Message"></textarea>
                        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.description }}</span>
                    </div>
                    <div class="form-group">
                        <v-select id="city" :options="icons" v-model="company_state.icon"  label="icon">
                            <template slot="option" slot-scope="option">
                                 <i :class="option.icon"></i> {{ option.icon }}
                            </template>
                        </v-select>
                        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.icon }}</span>
                    </div>
                    
                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Crear</button>
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
    data () {
        return {
            //variables
            icons:      [],
            company_state:   {
                company_state:  '',
                description:    '',
                icon:           null,
                slug:           ''
            },
            errors:     []
        }
    },
    created: function() {
        this.getIcons()
    },
    computed: {
        //computed functions
    },
    methods: {
        getIcons : function() {
            let url = '/api/get-icons';
            axios.get(url).then(response =>{
                this.icons = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        storeCompanyState :function() {
            let url = 'company-state/store'
            this.company_state.slug = this.company_state.company_state != '' ? this.company_state.company_state.toLowerCase().split(" ").join("-") : ''
            this.company_state.icon = this.company_state.icon != null ? this.company_state.icon.icon : ''
            axios.post(url, this.company_state).then(response =>{
                //this.responseTest = response.data
                //this.$bus.$emit('comp-cant-up')
                this.$bus.$emit('set-new-company-state-false')
                this.$bus.$emit('get-company-states')
                this.company_state.company_state=     '',
                this.company_state.description=       '',
                this.company_state.slug=       '',
                this.company_state.icon=              ''
            }).catch(error => {
                console.log(error)
                this.errors = error.response.data;
            });
        },
        cancelNew : function () {
            this.$bus.$emit('set-new-company-state-false')
            this.company_state.company_state=     '',
            this.company_state.description=       '',
            this.company_state.slug=              '',
            this.company_state.icon=              ''
        }
    }
}
</script>