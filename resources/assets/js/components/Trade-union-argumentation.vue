<template>
    <div>
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">CAPITULOS GENERADOS</h5>
                                <div class="d-flex no-block align-items-center m-t-20 m-b-20">
                                    <div id="sparklinedash"></div>
                                    <div class="ml-auto">
                                        <h2 class="text-success"><i class="ti-arrow-up"></i> <span class="counter">8659</span></h2>
                                    </div>
                                </div>
                            </div>
                            <div id="sparkline8" class="sparkchart"></div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">INVITADOS EN GENERAL</h5>
                                <div class="d-flex no-block align-items-center m-t-20 m-b-20">
                                    <div id="sparklinedash2"></div>
                                    <div class="ml-auto">
                                        <h2 class="text-purple"><i class="ti-arrow-up"></i> <span class="counter">7469</span></h2>
                                    </div>
                                </div>
                            </div>
                            <div id="sparkline8" class="sparkchart"></div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">INVITACIONES ENVIADAS</h5>
                                <div class="d-flex no-block align-items-center m-t-20 m-b-20">
                                    <div id="sparklinedash3"></div>
                                    <div class="ml-auto">
                                        <h2 class="text-info"><i class="ti-arrow-up"></i> <span class="counter">6011</span></h2>
                                    </div>
                                </div>
                            </div>
                            <div id="sparkline8" class="sparkchart"></div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">INSCRITOS TOTALES</h5>
                                <div class="d-flex no-block align-items-center m-t-20 m-b-20">
                                    <div id="sparklinedash4"></div>
                                    <div class="ml-auto">
                                        <h2 class="text-danger"><i class="ti-arrow-down"></i> <span class="counter">18%</span></h2>
                                    </div>
                                </div>
                            </div>
                            <div id="sparkline8" class="sparkchart"></div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
        <div v-if="isDataTableChapters"><data-table-chapters :data="allChapters" @updateDataTable="setUpdateChapters"></data-table-chapters></div>   
        <hr>
    </div>
</template>
<script>
import dataTableChapters from './Datatable-chapters';
export default {
    components: {
        dataTableChapters
    },
    data() {
        return {
            isDataTableChapters:    true,
            allChapters:            [],
            errors:                 [],
        }
    },
    filters: {

    },
    created: function() {
        this.getChapters()
    },
    methods: {
        getChapters : function () {
            var url = '/api/get-chapters/';
            axios.get(url).then(response =>{
                this.allChapters = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        setUpdateChapters : function () {
            this.getChapters()
        }

    }
}
</script>