<template>
<div id="table">
    <div class="row">
    <div id="table" class="col-xs-12 table-responsive">
        <datatable :columns="columns" :data="getData"></datatable>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 form-inline">
        <datatable-pager v-model="page" type="abbreviated" :per-page="per_page"></datatable-pager>
    </div>
</div>

</div>
</template>

<script>
    Vue.component('rowImg', {
    template: '<img :src="row.links.mission_patch" style="width: 20px;" />',
    props: ['row', 'column']
});

new Vue({
    el: '#log-in',
    data: {
        columns: [
            { label: '', component: 'row-img', sortable: false},
            { label: '#', field: 'flight_number', sortable: false},
            { label: 'Year', field: 'launch_year', sortable: false},
            { label: 'Rocket Name', field: 'rocket.rocket_name', sortable: false},
            { label: 'Rocket Type', field: 'rocket.rocket_type', sortable: false},
            { label: 'Launch Site', field: 'launch_site.site_name', sortable: false},
            { label: 'Success', representedAs: function(row){
                return row.launch_success ? 'Yes' : 'No';
            }, sortable: false},
        ],
        rows: window.rows,
        page: 1,
        per_page: 10,
    },
    methods: {
        getData: function(params, setRowData){
            axios.get('https://api.spacexdata.com/v2/launches').then(function(response){
                var start_index = (params.page_number - 1) * params.page_length;
                var end_index = start_index + params.page_length;

                setRowData(
                    response.data.slice(start_index, end_index),
                    response.data.length
                );
            }.bind(this));
        }
    }
});

</script>