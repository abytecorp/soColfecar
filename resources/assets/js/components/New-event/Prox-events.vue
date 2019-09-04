<template>
               <div>
                    <carousel class="row el-element-overlay">
                        
                    <slide v-for="event in evToShow" :key="event.id" class="col-lg-6 col-md-12">

                    <div >
                        <div class="card">
                            <div class="el-card-item">
                                <div class="el-card-avatar el-overlay-1"> <img :src="'storage/banner/'+event.banner"/>
                                    <div class="el-overlay">
                                        <ul class="el-info">
                                            <li><a class="btn default btn-outline image-popup-vertical-fit" :href="'storage/banner/'+event.banner"><i class="icon-magnifier"></i></a></li>
                                             <li ><a class="btn default btn-outline" href="javascript:void(0);"><i class="icon-link"></i></a></li>
  
                                        </ul>
                                    </div>
                                </div>
                                <div class="el-card-content">
                                    <h3 class="box-title">{{ event.event }}</h3> <small>{{ event.date_init }}</small>
                                    <br/>
                                    <plans-by-event :event_id="event.id"></plans-by-event>
                                    <hotels-by-event :event_id="event.id"></hotels-by-event>
                                     <a class="btn btn-outline-info waves-effect waves-light" :href="'panel-evento/'+event.id" target="_blank" type="button">Validar Registros</a>
                                    <hr>
                                    <br/>
                                    <flip-countdown :deadline="event.date_init" width="50" height="50" ></flip-countdown></div>
                            </div>
                        </div>
                    </div>
                    </slide>
                    </carousel>
                 </div>   
               
</template>
<script>

import moment from 'moment';
import FlipCountdown from 'vue2-flip-countdown'
import PlansByEvent from './Plans-by-event'
import HotelsByEvent from './hotels-by-event'

import { Carousel, Slide } from 'vue-carousel';

export default {
    components: {
        moment,
        FlipCountdown,
        Carousel,
        Slide,
        PlansByEvent,
        HotelsByEvent
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
        this.$bus.$on('set-prox-events', () => {
            this.setProxEvents()
        })
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
        },
    }
}
</script>
