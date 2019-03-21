<template>
    <div>
        <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div>
                                        <h5 class="card-title">Cambios recientes en el modulo</h5>
                                        <h6 class="card-subtitle">Puede organizar los cambios por usuario</h6>
                                    </div>
                                    <!-- <div class="ml-auto">
                                        <select class="custom-select b-0">
                                            <option value="2" selected="">Todos</option>
                                            <option v-for="user in users" :key="user.id" v-on:click="getChangesByUser(user.id)">{{ user.name }}</option>
                                        </select>
                                    </div> -->
                                    <div class="ml-auto">
                                    <v-select :options="users" @input="getChangesByUser"  label="name">
                                        <template slot="option" slot-scope="option">
                                            {{ option.name }}
                                        </template>
                                    </v-select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body bg-light">
                                <div class="row">
                                    <div class="col-6">
                                        <h3>{{ month | month-name }}</h3>
                                        <h5 class="font-light m-t-0">Cambios en este mes</h5></div>
                                    <div class="col-6 align-self-center display-6 text-right">
                                        <h2 class="text-success">{{ changesByMonth.length }}</h2></div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Usuario</th>
                                            <th>Cambio</th>
                                            <th>Fecha</th>
                                            <!-- <th>PRICE</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="change in changesByMonth" :key="change.id">
                                            <td class="text-center"><div class="p-2"><span class="round"><img :src="'storage/'+change.avtr" alt="user" width="50"></span></div></td>
                                            <td><span class="badge badge-success badge-pill">{{ change.name }}</span> </td>
                                            <td class="txt-oflo">{{ change.description }}</td>
                                            <td class="txt-oflo">{{ since(change.created_at) }}</td>
                                            <!-- <td><span class="text-success">$24</span></td> -->
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
    </div>
</template>
<script>

import monthName from '../filters/month-name'
import moment from 'moment';

moment.locale('es');

Vue.use(monthName)

export default {
    props: ['item_id'],
    data () {
        return {
            changes:            [],
            changesByMonth:     [],
            errors:             [],
            users:              [],
            userSelected:       [],
            month:              '',
            day:                '',
            year:               '',
        }
    },
    filters: {

    },
    created : function () {
        this.getChanges();
        this.getUsers();
        this.getCurrentDate();
        this.getChangesByMonth();
        this.$bus.$on('changes-up',() => {
            this.getChangesByMonth()
        })
    },
    methods: {
        since : function(d) {
            return moment(d).fromNow();
        },
        getChanges : function () {
            let url = 'affiliations/changes/'+this.item_id; //gets the item_id to search the changes maked in the module
            axios.get(url).then(response =>{
                this.changes = response.data.changes.data
            }).catch(error => {
            this.errors = error.response.data
            });
        },
        getUsers : function () {
            let url = '/api/get-users/'; //get the users to enlist in the options in models
            axios.get(url).then(response =>{
                this.users = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        getCurrentDate : function () {
            var dateNow = new Date()
            this.month = dateNow.getMonth()+1
            this.day = dateNow.getDate()
            this.year = dateNow.getFullYear()
        },
        getChangesByMonth : function () {
            let currentDate = this.year+'-0'+this.month+'-'+this.day+' '+'23:59:00'
            let initDate = this.year+'-0'+this.month+'-'+'01'+' '+'00:00:00'
            let url = '/api/get-changes-by-month/'+ currentDate +'/'+ initDate + '/' + this.item_id//get changes by month
            axios.get(url).then(response =>{
                this.changesByMonth = response.data
            }).catch(error => {
                this.errors = error.response.data
            });            
        },
        getChangesByUser : function (val) {
            if(val){
            let url = '/api/get-changes-by-user/'+val.id; //gets the item_id to search the changes maked in the module
            axios.get(url).then(response =>{
                this.changesByMonth = response.data
            }).catch(error => {
            this.errors = error.response.data
            });
            }else{
                this.getChangesByMonth()
            }
        }
    }
}
</script>
