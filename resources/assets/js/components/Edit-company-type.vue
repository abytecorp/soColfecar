<template>
<div>
    <hr>
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <form v-on:submit.prevent="storeCompanyType">
                    <div class="form-group">
                        <label for="exampleInputType">Tipo de empresa</label>
                        <input type="text" class="form-control" id="exampleInputType" v-model="up_company_type.company_type" placeholder="Ingrese el tipo de empresa">
                        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.company_state }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDescription">Descripcion</label>
                        <textarea class="form-control" id="exampleInputDescription" rows="3" v-model="up_company_type.description" placeholder="Descripcion del tipo de empresa"></textarea>
                        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.description }}</span>
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
            up_company_type:   {
                company_type:  '',
                description:    '',
                icon:           '',
                slug:           ''
            },
            errors:     []
        }
    },
    created: function() {
        this.getCompanyType()
    },
    computed: {
        //computed functions
    },
    methods: {
        getCompanyType : function () {
            let url = 'affiliations/get-company-type/'+ this.data;
            axios.get(url).then(response =>{
                this.up_company_type = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        storeCompanyType :function() {
            let url = 'company-type/'+this.up_company_type.id
            this.up_company_type.slug = this.up_company_type.company_type != '' ? this.up_company_type.company_type.toLowerCase().split(" ").join("-") : ''
            axios.put(url, this.up_company_type).then(response =>{
                //this.responseTest = response.data
                //this.$bus.$emit('comp-cant-up')
                this.$bus.$emit('set-edit-company-type-false')
                this.$bus.$emit('get-company-types')
                this.up_company_type.company_type=      '',
                this.up_company_type.description=       '',
                this.up_company_type.slug=              ''
            }).catch(error => {
                console.log(error)
                this.errors = error.response.data;
            });
        },
        cancelNew : function () {
            this.$bus.$emit('set-edit-company-type-false')
            this.up_company_type.company_type=         '',
            this.up_company_type.description=          '',
            this.up_company_type.slug=                 ''
        }
    }
}
</script>