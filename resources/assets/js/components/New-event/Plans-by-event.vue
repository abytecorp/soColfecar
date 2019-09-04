<template>
    <div>
        <blockquote>
            <!-- <button v-for="plan in plans" :key="plan.id" type="button" class="btn btn-info btn-rounded"> {{ plan.plan }} <i class="fa fa-link"></i></button> -->
            <button class="btn btn-outline-info waves-effect waves-light" @click="createLink('asistentes')" type="button"><span class="btn-label"></span>Asistentes <i class="fa fa-link"></i></button>
            <button class="btn btn-outline-info waves-effect waves-light" @click="createLink('invitados-especiales')" type="button"><span class="btn-label"></span>Invitados especiales <i class="fa fa-link"></i></button>
            <button class="btn btn-outline-info waves-effect waves-light" @click="createLink('staff')" type="button"><span class="btn-label"></span>Staff <i class="fa fa-link"></i></button>
            <button  type="button" class="btn btn-success btn-circle" @click="confPlans()"><i class="fa fa-gears"></i> </button>

        </blockquote>

    </div>
    
</template>
<script>

export default {
    
    components: {
       
    },
    props: ['event_id'],
    data () {
        return {
            //variables
            invitation_link:    '',
            plans:              [],
            errors:             [],
            
        }
    },
    created: function() {
        this.getPlansByEvent()
        this.$bus.$on('get-plans-by-event', () => {
            this.getPlansByEvent()
        })
    },
    computed: {
        //computed functions
    },
    methods: {
        // },
        getPlansByEvent () {
            let url = `/api/get-plans-event/${this.event_id}`;
            axios.get(url).then(response =>{
                this.plans = response.data;
                this.errors = [];
            }).catch(error => {
                this.plans = [];
                this.errors = error.response.data;
            });
        },
        confPlans : function(){
            this.$bus.$emit('conf-plans',this.event_id)
        },
        createLink(val){
            this.invitation_link = `https://www.sistemaoperativocolfecar.com/inscripcion-externa/${this.event_id}/${val}`;

            this.invitation_link ? this.$bus.$emit('set-modal-link-coupon', this.invitation_link) : $('#copyLinkModal').modal('hide'); this.invitation_link = '';
        },
        closeModal(){
            this.invitation_link = '';
            $('#copyLinkModal').modal('hide'); 
        }

    }
}
</script>