<template>
    <div>
        <div class="alert alert-success alert-rounded"> <img :src="'/storage/logos/'+company_id.logo" width="30" class="img-circle" alt="img">  {{ company_id.bs_name }}.
            <button type="button" class="close" aria-label="Close" @click="closed()"> <i class="fa fa-times">  </i> </button>
        </div>
     
    </div>
</template>
<script>
export default {
    props: ['company_id'],
    components: {

    },
    data () {
        return {
            company:        [],
            errors:         []
        }
    },
    mounted : function(){
        //this.getCompanyById();
    },
    methods : {
        getCompanyById() {
            let url = `/api/${this.company_id}/get-company-by-id`;
            axios.get(url).then(response =>{
                this.company = response.data;
                this.errors = [];
            }).catch(error => {
                this.company = [];
                this.errors = error.response.data;
            });
        },
        closed(){
            this.$emit('closeCompany');
        }
        
    }
}
</script>