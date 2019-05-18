<template>
    <div>
        <div class="input-group mb-6">
            <!-- <a href="#" @click="reset"><div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="ti-trash"></i></span>
            </div></a> -->
            <button type="button" class="btn btn-danger" @click="reset"><i class="fa fa-trash-o"></i> </button>
            <button type="button" class="btn btn-warning" @click="delLast"><i class="fa fa-rotate-left"></i> -1 </button>
            <button type="button" class="btn btn-info" @click="toEdit"><i class="fa fa-pencil"></i> </button>
            <input type="text" class="form-control"  aria-label="Username" disabled aria-describedby="basic-addon1"  v-model="data">
        </div>
        
        <div v-if="isEdit == true"><div class="row">
            <div class="col-md-6">
                <h8 class="m-t-30 m-b-10">Nomenclaturas</h8>
            <v-select :options="nomenclatures" @input="setValueNom" label="nomenclature">
                <template slot="option" slot-scope="option">
                    {{ option.nomenclature }}
                </template>
            </v-select>
            </div>
            <div class="col-md-4">
                <h8 class="m-t-30 m-b-10">Digitos</h8>
            <v-select :options="digits" @input="setValueDig" label="digit">
                <template slot="option" slot-scope="option">
                    {{ option.digit }}
                </template>
            </v-select>
            </div>
            <div class="col-md-4">
                <h8 class="m-t-30">Letras</h8>
            <v-select :options="add_letters" @input="setValueLet" label="add_letter">
                <template slot="option" slot-scope="option">
                    {{ option.add_letter }}
                </template>
            </v-select>
            </div></div>
        </div>
        <div v-if="named == true">
            <div class="form-group m-form__group">
                <h3><strong>{{ nom_named }}</strong> tiene un nombre adicional?:</h3>
                <button type="button" class="btn btn-success" @click="toAddName(true)"><i class="fa  fa-check-square-o"></i> SI </button>
                <button type="button" class="btn btn-danger" @click="toAddName(false)"><i class="fa fa-times"></i> NO </button>

            </div>
        </div>
        <div v-if="rsp_named == true">
            <hr>
            <div class="input-group mb-3">
                
                <input type="text" class="form-control" ref="input-name" placeholder="Ingrese la descripción" v-model="nom_name">
                <button type="button" class="btn btn-success" @click="addName"><i class="fa fa-pencil"></i> Agregar </button>
               
            </div>
             <span v-ir="error_nom_name" class="text-danger" >{{ error_nom_name }}</span>
        </div>
    </div>
</template>
<script>
export default {
    props:['data'],
    data () {
        return{
            nomenclatures:  [],
            digits:         [],
            add_letters:    [],
            errors:         [],
            isEdit:         false,
            named:          false,
            rsp_named:      false,
            nom_name:       '',
            nom_named:      '',
            error_nom_name: null,
        }
    },
    created: function() {
        this.getNomenclatures()
        this.getDigits()
        this.getAddLetters()
    },
    methods: {
        getNomenclatures : function () {
            let url= '/api/address/get-nomenclatures'
            axios.get(url).then(response =>{
                this.nomenclatures = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        getDigits : function () {
            let url= '/api/address/get-digits'
            axios.get(url).then(response =>{
                this.digits = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        getAddLetters : function () {
            let url= '/api/address/get-add-letters'
            axios.get(url).then(response =>{
                this.add_letters = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        setValueNom : function (val) {
            this.clearInit()
            this.nom_named = val.nomenclature
            this.named = this.named == false ? true : false
            this.isEdit = false  
            //this.$emit('upAddress',val.nomenclature)
        },
        setValueDig : function (val) {
            this.$emit('upAddressDig',val.digit)
            this.nom_named = ''
            this.named = false
            this.rsp_named = false
        },
        setValueLet : function (val) {
            this.$emit('upAddress',val.add_letter)
            this.nom_named = ''
            this.named = false
            this.rsp_named = false
        },
        reset : function () {
            this.$emit('toReset')
            this.nom_named = ''
            this.named = false
            this.rsp_named = false
        },
        toEdit : function () {
                this.isEdit = this.isEdit == false ? true : false
        },
        toAddName : function (val) {
            if(val){
                //this.$refs.input-name.$el.focus()
                this.rsp_named = this.rsp_named == false ? true : false
            }else{
                this.$emit('upAddress',this.nom_named)
                this.isEdit = true
                this.nom_named = ''
                this.nom_name = ''
                this.named = false
                this.rsp_named = false
            }
        },
        addName : function () {
            if(this.nom_name != '') {
            let fullNomName = this.nom_named + ' ' + this.nom_name
            this.$emit('upAddress',fullNomName)
            this.isEdit = true
            this.nom_named = ''
            this.nom_name = ''
            this.named = false
            this.rsp_named = false
            }else{
                this.error_nom_name = 'Debe ingresar un nombre para '+ this.nom_named
            }
        },
        delLast : function () {
            var charFull = this.data
            this.reset()
            charFull = charFull.split(' ')
            let pos = charFull.length-2
            let charFullDel = charFull.splice(pos,1)
            charFull = charFull.join(' ');
            this.$emit('upAddressDig',charFull)
        },
        clearInit : function () {
            if(this.data == null){
                console.log('cleared!')
                this.reset()
            }
        }
    }
}
</script>