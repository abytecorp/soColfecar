<template>
    <div>
        <blockquote>
                            <h3>Assistentes inscritos</h3>
                            <div class="card-body">
                                <div class="row">
                                            <br/>
                                            <hr>
                                            <div v-for="isSu in isSus" :key="isSu.id" class="col-md-3 col-xs-6 b-r"> <strong>{{ isSu[0] }}</strong>
                                                <br>
                                                <p class="text-muted">{{ isSu.id }}</p>
                                            </div>
                                            <!-- <div class="col-md-3 col-xs-6 b-r"> <strong>Hospedaje</strong>
                                                <br>
                                                <p class="text-muted">{{ planSelected.host == 1 ? 'Este plan cuenta con hospedaje' : 'Este plan no cuenta con hospedaje'  }}</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Agenda Acadedmica</strong>
                                                <br>
                                                <p class="text-muted">{{ planSelected.academic_agenda == 1 ? 'Este plan cuenta con agenda academica' : 'Este plan no cuenta con agenda academica'  }}</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Almuerzos</strong>
                                                <br>
                                                <p class="text-muted">{{  !planSelected.lunches ? 'Este plan no cuenta con este alimento ' : planSelected.lunches   }}</p>
                                            </div> -->
                                </div>
                            </div>
                        </blockquote>        
    </div>
</template>
<script>
export default {
    props: ['isSus'],
    components: {

    },
    data () {
        return {
            errors:         []
        }
    },
    mounted : function(){
        //this.getCompanyById();
    },
    methods : {
        getCompanyById() {
            // let url = `/api/${this.company_id}/get-company-by-id`;
            // axios.get(url).then(response =>{
            //     this.company = response.data;
            //     this.errors = [];
            // }).catch(error => {
            //     this.company = [];
            //     this.errors = error.response.data;
            // });
        },
        
    }
}
</script>