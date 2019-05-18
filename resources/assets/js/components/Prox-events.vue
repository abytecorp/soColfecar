<template>
                <div class="row el-element-overlay">

                    <div v-for="event in evToShow" :key="event.id" class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="el-card-item">
                                <div class="el-card-avatar el-overlay-1"> <img :src="'storage/banner/'+event.banner" alt="user" />
                                    <div class="el-overlay">
                                        <ul class="el-info">
                                            <li><a class="btn default btn-outline image-popup-vertical-fit" href=""><i class="icon-magnifier"></i></a></li>
                                            <li><a class="btn default btn-outline" href="javascript:void(0);"><i class="icon-link"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="el-card-content">
                                    <h3 class="box-title">{{ event.event }}</h3> <small>{{ event.date_init }}</small>
                                    <br/> 
                                    <flip-countdown :deadline="event.date_init"></flip-countdown></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
</template>
<script>

import moment from 'moment';
import FlipCountdown from 'vue2-flip-countdown'

export default {
    components: {
        moment,
        FlipCountdown
    },
    props: ['events'],
    data () {
        return {
            //variables
            countdown:  null,
            evToShow:   [],
            errors:     []
        }
    },
    created: function() {
        this.setProxEvents()
    },
    computed: {
        //computed functions
    },
    methods: {
        setProxEvents : function() {
            var dateNow = new Date()
            let month = dateNow.getMonth()+1
            let day = dateNow.getDate()
            let year = dateNow.getFullYear()
            let currentDate = year+'-0'+month+'-'+day+' '+'23:59:00'
            let url = '/api/get-events-after/'+ currentDate //get events after current date
            axios.get(url).then(response =>{
                this.evToShow = response.data
            }).catch(error => {
                this.errors = error.response.data
            }); 
        }
    }
}
</script>
