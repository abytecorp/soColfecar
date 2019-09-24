<template>
    <div>
        <div :class="[ isDebt ? dangerClass : successClass]"> 
            <p v-if="res > 0">Tiene un saldo de <strong> {{ res | currency }} </strong></p>
            <p v-else>Se encuentra al dia con los pagos! </p>
        </div>
    </div>
</template>
<script>
export default {
    props: ['bill_id','plan_value'],
    components: {

    },
    data () {
        return {
            dangerClass:        'alert alert-danger alert-rounded',
            successClass:       'alert alert-success alert-rounded',  
            warningClass:       'alert alert-warning alert-rounded',
            debits:             [],
            costs:              [],
            res:                0,
            isDebt:             true,
            errors:             []
        }
    },
    beforeMount() {
        },
    created() {
        this.getDebits()
        this.getCosts()
        //this.valStatus()
    },
    mounted() {
        
    },
    methods: {
        getDebits : function () {
            let url = `/api/${this.bill_id}/get-debits-rec`
            axios.get(url).then(response =>{
                this.debits = response.data;
                this.errors = [];
                this.valStatus()
            }).catch(error => {
                this.debits = [];
                this.errors = error.response.data;
            });
        },
        getCosts : function () {
            let url = `/api/${this.bill_id}/get-costs`
            axios.get(url).then(response =>{
                this.costs = response.data;
                this.errors = [];
            }).catch(error => {
                this.costs = [];
                this.errors = error.response.data;
            });
        },
        getSumCosts : function () {
            let costTotal = 0;
            this.costs.map(function(cost) {
                costTotal = parseInt(costTotal) + parseInt(cost.price)
            });
            return costTotal
        },
        getSumDebits : function () {
            let debitTotal = 0;
            this.debits.map(function(debit) {
                debitTotal = parseInt(debitTotal) + parseInt(debit.debit_price)
            });
            return debitTotal
        },
        valStatus : function () {
            let cost = this.getSumCosts()
            let debits = this.getSumDebits()
            let debLessCost = debits - cost;
            let planValue = parseInt(this.plan_value)
            if(debLessCost >= planValue){
                let res = planValue - debLessCost
                this.res = res
                this.isDebt = false
            }else{
                let res = planValue - debLessCost
                this.res = res
                this.isDebt = true
            }
        }
    },
}
</script>