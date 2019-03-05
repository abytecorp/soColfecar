<template>

<div id="firstStep">
<hr>
                            <form class="form-horizontal" v-on:submit.prevent="stepTwo">
                                <div class="form-group row">
                                    <label for="inputNames" class="col-sm-3 text-right control-label col-form-label">Ingresa tu nombre</label>
                                    <div class="col-sm-9">
                                        <input type="text" v-model="enrrollNames" class="form-control" id="enrNames" placeholder="Nombre de la persona que realiza la inscripcion">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-3 text-right control-label col-form-label">Ingresa tu correo Electronico</label>
                                    <div class="col-sm-9">
                                        <input type="email" v-model="enrrollMail" class="form-control" id="inputEmail" placeholder="Email">
                                    </div>
                                </div>

                                <div class="form-group m-b-0">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button type="submit"  class="btn btn-info waves-effect waves-light m-t-10">Continuar</button>
                                    </div>
                                </div>
                            </form>
</div>


</template>
<script>
require('../../assets/node_modules/jquery/jquery-3.2.1.min.js');
export default {
    props: ['event'],
    data () {
        return {
            enrrollNames:  '',
            enrrollMail:   '',
            errors:        [],
        }
    },
    created: function() {
        //this.getPlanes();
        
    },
    methods: {
        stepTwo : function() {
            console.log(this.enrrollNames)
            if(this.enrrollNames == null){
            $( "#enrNames" ).addClass("form-control form-control-danger")
        }
        },
        // since : function(d) {
        //     return moment(d).fromNow();
        // },
        // getPlanes : function() {
        //     var urlGetPLans = '/plans/'+this.event+'/lists';
        //     axios.get(urlGetPLans).then(response =>{
        //         this.plans = response.data
        //         this.count = this.plans.length
        //     });

        // },


    }
}
</script>