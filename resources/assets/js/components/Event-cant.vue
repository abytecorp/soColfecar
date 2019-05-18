<template>
    <div>
        {{ events.length }}
    </div>
</template>
<script>
export default {
    props: ['data'],
    data () {
        return {
            events:     [],
            errors:     []
        }
    },
    created: function() {
        this.getEventsByType()
        // this.$bus.$on('comp-cant-up',() => {
        //     this.getCompaniesByState()
        // })
    },
    methods: {
        getEventsByType : function() {
            let url = 'affiliations/events-by-type/'+this.data
            axios.get(url).then(response =>{
                this.events = response.data
            }).catch(error => {
            this.errors = error.response.data
            });
        }
    }
}
</script>