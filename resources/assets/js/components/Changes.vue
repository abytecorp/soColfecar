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
                                    <div class="ml-auto">
                                        <select class="custom-select b-0">
                                            <option value="2" selected="">Todos</option>
                                            <option v-for="user in users" :key="user.id">{{ user.name }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body bg-light">
                                <div class="row">
                                    <div class="col-6">
                                        <h3>{{ month | month-name }}</h3>
                                        <h5 class="font-light m-t-0">Cambios de este mes</h5></div>
                                    <div class="col-6 align-self-center display-6 text-right">
                                        <h2 class="text-success">$3,690</h2></div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>NAME</th>
                                            <th>STATUS</th>
                                            <th>DATE</th>
                                            <th>PRICE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td class="txt-oflo">Elite admin</td>
                                            <td><span class="badge badge-success badge-pill">sale</span> </td>
                                            <td class="txt-oflo">April 18, 2017</td>
                                            <td><span class="text-success">$24</span></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td class="txt-oflo">Real Homes WP Theme</td>
                                            <td><span class="badge badge-info badge-pill">extended</span></td>
                                            <td class="txt-oflo">April 19, 2017</td>
                                            <td><span class="text-info">$1250</span></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td class="txt-oflo">Ample Admin</td>
                                            <td><span class="badge badge-info badge-pill">extended</span></td>
                                            <td class="txt-oflo">April 19, 2017</td>
                                            <td><span class="text-info">$1250</span></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td class="txt-oflo">Medical Pro WP Theme</td>
                                            <td><span class="badge badge-danger badge-pill">tax</span></td>
                                            <td class="txt-oflo">April 20, 2017</td>
                                            <td><span class="text-danger">-$24</span></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">5</td>
                                            <td class="txt-oflo">Hosting press html</td>
                                            <td><span class="badge badge-success badge-pill">sale</span></td>
                                            <td class="txt-oflo">April 21, 2017</td>
                                            <td><span class="text-success">$24</span></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">6</td>
                                            <td class="txt-oflo">Digital Agency PSD</td>
                                            <td><span class="badge badge-success badge-pill">sale</span> </td>
                                            <td class="txt-oflo">April 23, 2017</td>
                                            <td><span class="text-danger">-$14</span></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">7</td>
                                            <td class="txt-oflo">Helping Hands WP Theme</td>
                                            <td><span class="badge badge-warning badge-pill">member</span></td>
                                            <td class="txt-oflo">April 22, 2017</td>
                                            <td><span class="text-success">$64</span></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">8</td>
                                            <td class="txt-oflo">Ample Admin</td>
                                            <td><span class="badge badge-info badge-pill">extended</span></td>
                                            <td class="txt-oflo">April 19, 2017</td>
                                            <td><span class="text-info">$1250</span></td>
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

Vue.use(monthName)

export default {
    props: ['item_id'],
    data () {
        return {
            changes:            [],
            changesByMonth:     [],
            errors:             [],
            users:              [],
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
    },
    methods: {
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
            this.month = 3 //dateNow.getMonth()
            this.day = dateNow.getDate()
            this.year = dateNow.getFullYear()
        },
        getChangesByMonth : function () {
            let currentDate = this.year+'-0'+this.month+'-'+this.day+' '+'00:00:00'
            let initDate = this.year+'-0'+this.month+'-'+'01'+' '+'00:00:00'
            let url = '/api/get-changes-by-month/'+ currentDate +'/'+ initDate//get changes by month
            console.log(url)
            axios.get(url).then(response =>{
                this.changesByMonth = response.data
            }).catch(error => {
                this.errors = error.response.data
            });            
        }
    }
}
</script>
