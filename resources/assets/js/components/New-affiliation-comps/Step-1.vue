<template>
    <div>
        <form class="form-material m-t-40 row">

            <div class="form-group col-md-12 m-t-20"> 
                <FloatingLabel
                    :config="{label: 'Razon Social', hasError: err.bs_name, hasClearButton: false }">
                    <input name="bs_name" v-model="company.bs_name" type="text" @keyup="validateStep1(),progressing()" @>
                </FloatingLabel>
                <span v-if="err.bs_name" class="text-danger" >{{ err.bs_name }}</span>
            </div>

            <div class="form-group col-md-12 m-t-20">         
                <FloatingLabel
                    :config="{label: 'Siglas de la empresa', hasError: false, hasClearButton: false }">
                    <input name="acronym" v-model="company.acronym" type="text">
                </FloatingLabel>
            </div>
                                                                
            <div class="form-group col-md-8 m-t-20">            
                <FloatingLabel
                    :config="{label: 'NIT', hasError: err.nit, hasClearButton: false }">
                    <input name="nit" v-model="company.nit" type="number" @keyup="validateNit(),validateStep1(),progressing()" @onblur="validateNit(),validateStep1(),progressing()">
                </FloatingLabel>
                <span v-if="err.nit" class="text-danger" >{{ err.nit }}</span>
            </div>
    
            <div class="form-group col-md-2 m-t-20"> 
                <FloatingLabel
                    :config="{label: 'DV', hasError: false, hasClearButton: false }">
                    <input name="dv" v-model="company.verification_digit" type="number">
                </FloatingLabel>
            </div>       
        </form>
    </div>
</template>
<script>

import FloatingLabel from 'vue-simple-floating-labels'


export default {
    props: {

    },
    components: {
        FloatingLabel,
    },
    data() {
        return {
            err: {
                nit:                    '',
                bs_name:                '',
            },
            company: {
                bs_name:                '',
                nit:                    '',
                verification_digit:     ''
            }
        }
    },
    methods : {
         findNit : function (nit){
            return this.companies.find(company => company.nit === nit)
        },
        validateBsName : function (){
            if(this.company.bs_name){
                this.err.bs_name = ''
                return true
            } else {
                this.err.bs_name = 'debe asignar la razon social de la empresa'
                return false
            }
        },
        validateNit : function() {
            let cmpTmp = []
        if(this.company.nit.length != 9){
             this.err.nit = 'El nit debe contener 9 caracteres'
             return false
         }else{
              this.err.nit = ''; this.step1 = ''
         }
        if(this.err.nit === ''){
          if(this.findNit(this.company.nit)){
              cmpTmp = this.findNit(this.company.nit)
              this.err.nit = `Este NIT pertenece a la empresa ${cmpTmp.bs_name} y su afiliacion se encuentra en el estado: ${cmpTmp.company_state}`
              this.step1 = 'error'
          }else {
                this.step1 = ''
                return true
            }} else {
                this.step1 = ''
                return true
          }
        },
        validateStep1 : function() {
            let bsNameField = this.validateBsName()
            let nitField = this.validateNit()
            // console.log(`the bs name ${bsNameField}  and the nit field ${nitField}`)
            bsNameField && nitField ? this.step1 = 'success' : this.step1 = 'error'
        },
    }
    
}
</script>
