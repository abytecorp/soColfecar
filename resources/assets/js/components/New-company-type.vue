<template>
<div>
    <hr>
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <form v-on:submit.prevent="storeCompanyType">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tipo de empresa</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" v-model="company_type.company_type" placeholder="Ingrese el estado de la empresa">
                        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.company_type }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDescription">Descripcion</label>
                        <textarea class="form-control" id="exampleTextarea" rows="3" v-model="company_type.description" placeholder="Message"></textarea>
                        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.description }}</span>
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
            company_type:   {
                company_type:  '',
                description:    '',
                slug:           ''
            },
            errors:     []
        }
    },
    created: function() {
        //this.getIcons()
    },
    computed: {
        //computed functions
    },
    methods: {
        storeCompanyType :function() {
            let url = 'company-type/store'
            this.company_type.slug = this.company_type.company_type != '' ? this.company_type.company_type.toLowerCase().split(" ").join("-") : ''
            axios.post(url, this.company_type).then(response =>{
                this.$bus.$emit('set-new-company-type-false')
                this.$bus.$emit('get-company-types')
                this.company_type.company_type=         '',
                this.company_type.description=          '',
                this.company_type.slug=                 '',
                this.company_type.icon=                 ''
            }).catch(error => {
                console.log(error)
                this.errors = error.response.data;
            });
        },
        cancelNew : function () {
            this.$bus.$emit('set-new-company-type-false')
            this.company_type.company_type=         '',
            this.company_type.description=          '',
            this.company_type.slug=                 '',
            this.company_type.icon=                 ''
        }
    }
}
</script>