<template>
    <div>
        {{ companies.length }}
    </div>
</template>
<script>
export default {
    props: ['data'],
    data () {
        return {
            companies:  [],
            errors:      []
        }
    },
    created: function() {
        this.getCompaniesByState()
        this.$bus.$on('comp-cant-up',() => {
            this.getCompaniesByState()
        })
    },
    methods: {
        getCompaniesByState : function() {
            let url = 'affiliations/companies-by-state/'+this.data
            axios.get(url).then(response =>{
                this.companies = response.data
            }).catch(error => {
            this.errors = error.response.data
            });
        }
    }
}
</script>