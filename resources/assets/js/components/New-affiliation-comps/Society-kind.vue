<template>
    <div>
        <form class="form-material m-t-40 row">
            <blockquote class="col-md-12 m-t-1">
            <div class="form-group col-md-12 m-t-1">
                    <h6 class="text-muted">Fecha de constitución</h6>
                    <FloatingLabel
                        :config="{label: '', hasError: err.constitution_date, hasClearButton: false }">
                        <input name="constitution_date" v-model="socClass.constitution_date" type="date">
                    </FloatingLabel>
                    <span v-if="err.constitution_date" class="text-danger" >{{ err.constitution_date }}</span>
            </div>
            <div class="form-group col-md-12 m-t-1">
                    <!-- <h6 class="text-muted">Fecha de constitución</h6> -->
                    <FloatingLabel
                        :config="{label: 'Capital social autorizado', hasError: err.auth_social_capital, hasClearButton: false }">
                        <input name="auth_social_capital" v-model="socClass.auth_social_capital" type="text">
                    </FloatingLabel>
                    <span v-if="err.auth_social_capital" class="text-danger" >{{ err.auth_social_capital }}</span>
            </div>
            <div class="form-group col-md-12 m-t-1">
                    <!-- <h6 class="text-muted">Fecha de constitución</h6> -->
                    <FloatingLabel
                        :config="{label: 'Capital suscrito y pagado', hasError: err.subs_and_paid_capital, hasClearButton: false }">
                        <input name="subs_and_paid_capital" v-model="socClass.subs_and_paid_capital" type="text">
                    </FloatingLabel>
                    <span v-if="err.subs_and_paid_capital" class="text-danger" >{{ err.subs_and_paid_capital }}</span>
            </div>
            <hr>
            </blockquote>
            <blockquote class="col-md-12 m-t-1">
            <div class="form-group col-md-12 m-t-1">
                <h5>Tipo de sociedad</h5>
            </div>
            <div class="form-group col-md-6 m-t-1">
                <div v-for="societyType in societyTypes" :key="societyType.id">
                    <input  type="radio" class="check" v-model="socClass.society_kind" :value="societyType.society_type" >
                    <span>{{ societyType.society_type }} </span><br>
                </div>
            </div>

            <div class="form-group col-md-6 m-t-1">
                <input  type="radio" class="check" value="" id="radioOther" @change="changed()" v-model="socClass.society_kind" >
                <span >Otra </span><br>
                <FloatingLabel v-if="socClass.society_kind === ''"
                    :config="{label: 'Otro tipo de sociedad', hasError: err.society_kind, hasClearButton: false }">
                    <input name="society_kind" v-model="socClass.society_kind_other" type="text">
                </FloatingLabel>
                <span v-if="err.society_kind" class="text-danger" >{{ err.society_kind }}</span>
            </div>
            </blockquote>
            <blockquote class="col-md-12 m-t-1">
            <div class="form-group col-md-12 m-t-1">
                <h5>Tipo de empresa</h5>
            </div>

            <div class="form-group col-md-6 m-t-1">
                <div v-for="companyType in companyTypes" :key="companyType.id">
                    <input  type="radio" class="check"  v-model="socClass.another_company_type" :value="companyType.company_type" >
                    <span>{{ companyType.company_type }}</span><br>
                </div>
            </div>
            <div class="form-group col-md-6 m-t-1">
                <div>
                    <input  type="radio" class="check" id="radioOtherCmpType" @change="changedCmpTypes()" v-model="socClass.another_company_type" value="" >
                    <span >Otros </span><br>
                </div>
                <FloatingLabel v-if="socClass.another_company_type === ''"
                    :config="{label: 'Otro tipo de empresa', hasError: err.another_company_type, hasClearButton: false }">
                    <input name="society_kind" v-model="socClass.another_company_type_other" type="text">
                </FloatingLabel>
                <span v-if="err.another_company_type" class="text-danger" >{{ err.another_company_type }}</span>
            </div>
            </blockquote>
            <blockquote class="col-md-12 m-t-1">
            <div class="form-group col-md-12 m-t-1">
                <h5>Actividad economica</h5>
            </div>

            <div class="form-group col-md-6 m-t-1">
                <div v-for="economicActivity in economicActivities" :key="economicActivity.id">
                    <input  type="radio" class="check"  v-model="socClass.eco_activity" :value="economicActivity.economic_activity" >
                    <span> {{ economicActivity.economic_activity }} </span><br>
                </div>
            </div>
            <div class="form-group col-md-6 m-t-1">
                <div>
                    <input  type="radio" class="check" id="radioOtherEconomicActivity" @change="changedEcoActivity()" v-model="socClass.eco_activity" value="" >
                    <span >Otros </span><br>
                </div>
                <FloatingLabel v-if="socClass.eco_activity === ''"
                    :config="{label: 'Actividad economica', hasError: err.eco_activity, hasClearButton: false }">
                    <input name="eco_activity" v-model="socClass.eco_activity_other" type="text">
                </FloatingLabel>
                
            </div>
            <span v-if="err.eco_activity" class="text-danger" >{{ err.eco_activity }}</span>
            </blockquote>
            <blockquote class="col-md-12 m-t-1">
            <div class="form-group col-md-12 m-t-1">
                <h5>Tipo de regimen</h5>
            </div>

            <div class="form-group col-md-6 m-t-1">
                <div v-for="regimeType in regimeTypes" :key="regimeType.id">
                    <input  type="radio" class="check"  v-model="socClass.regime_type_id" :value="regimeType.id" >
                    <span> {{ regimeType.regime_type }} </span><br>
                </div>
            </div>

            <div class="form-group col-md-6 m-t-1">
                <FloatingLabel
                    :config="{label: 'Codigo CIIU', hasError: err.ciiu_code, hasClearButton: false }">
                    <input name="ciiu_code" v-model="socClass.ciiu_code" type="text">
                </FloatingLabel>
            </div>

            <div class="form-group col-md-12 m-t-1">
                <FloatingLabel
                    :config="{label: 'Vigencia de la sociedad', hasError: err.society_validity, hasClearButton: false }">
                    <input name="society_validity" v-model="socClass.society_validity" type="text">
                </FloatingLabel>
            </div>
            </blockquote>
            <blockquote class="col-md-12 m-t-1">
            <button type="button" class="btn btn-outline-secondary" @click="setSelfRetainer()">Autoretenedor <i :class="[ isSelfRetainer ? minusIcon : plusIcon]"></i></button>
            <div v-if="isSelfRetainer" class="form-group col-md-12 m-t-1">
                <FloatingLabel
                    :config="{label: 'Resolucion No.', hasError: err.society_validity, hasClearButton: false }">
                    <input name="society_validity" v-model="socClass.society_validity" type="text">
                </FloatingLabel>
            </div>
            <div v-if="isSelfRetainer" class="form-group col-md-12 m-t-1">
                <FloatingLabel
                    :config="{label: '', hasError: err.society_validity, hasClearButton: false }">
                    <input name="society_validity" v-model="socClass.society_validity" type="date">
                </FloatingLabel>
            </div>
            </blockquote>

 
        </form>
    </div>
</template>
<script>
import FloatingLabel from 'vue-simple-floating-labels'

export default {
    props: {

    },
    components: {
        FloatingLabel
    },
    data () {
        return {
            socClass: {
                company_id:                 '',
                constitution_date:          '',
                auth_social_capital:        '',
                subs_and_paid_capital:      '',
                society_kind:               null,
                society_kind_other:         '',
                another_company_type:       null,
                another_company_type_other: '',
                eco_activity:               null,
                eco_activity_other:         '',
                regime_type_id:             '',
                self_retainer_res:          '',
                self_retainer_res_date:     '',
                big_contributor_res:        '',
                big_contributor_res_date:   '',
                retention_res:              '',
                retention_res_date:         '',
                ciiu_code:                  '',
                society_validity:           '',
            },
            err: {
                constitution_date:          '',
                auth_social_capital:        '',
                subs_and_paid_capital:      '',
                another_company_type:       '',
                society_validity:           ''
            },
            isOtherSocietyKind:     null,
            isSelfRetainer:         null,
            companyTypes:           [],
            economicActivities:     [],
            errors:                 [],
            regimeTypes:            [],
            societyTypes:           [],
            plusIcon:               'fa fa-plus-square-o',
            minusIcon:              'fa fa-minus-square-o'

        }
    },
    created: function(){
        this.getCompanyTypes()
        this.getEconomicActivities()
        this.getRegimeTypes()
        this.getSocietyTypes()
    },
    methods : {
        getCompanyTypes : function() {
            let url = 'api/get-company-types';
            axios.get(url).then(response =>{
                this.companyTypes = response.data;
                this.errors = [];
            }).catch(error => {
                this.companyTypes = [];
                this.errors = error.response.data;
            });
        },
        getEconomicActivities : function(){
            let url = '/api/get-economic-activities';
            axios.get(url).then(response =>{
                this.economicActivities = response.data;
                this.errors = [];
            }).catch(error => {
                this.economicActivities = [];
                this.errors = error.response.data;
            });
        },
        getRegimeTypes : function(){
            let url = '/api/get-regime-types';
            axios.get(url).then(response =>{
                this.regimeTypes = response.data;
                this.errors = [];
            }).catch(error => {
                this.regimeTypes = [];
                this.errors = error.response.data;
            });
        },
        getSocietyTypes : function(){
            let url = '/api/get-society-types';
            axios.get(url).then(response =>{
                this.societyTypes = response.data;
                this.errors = [];
            }).catch(error => {
                this.societyTypes = [];
                this.errors = error.response.data;
            });
        },
        changed : function(){
            let radio = document.getElementById('radioOther').checked
            console.log(radio)
        },
        changedCmpTypes : function(){
            let radio = document.getElementById('radioOtherCmpType').checked
            console.log(radio)
        },
        changedEcoActivity : function(){
            let radio = document.getElementById('radioOtherCmpType').checked
            console.log(radio)
        },
        setSelfRetainer : function(){
            this.isSelfRetainer = !this.isSelfRetainer
        },
    }
}
</script>