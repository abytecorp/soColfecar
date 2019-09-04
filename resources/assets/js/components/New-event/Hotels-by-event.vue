<template>
    <div>
        <blockquote>
            <button class="btn btn-outline-warning waves-effect waves-light" @click="addHotel" type="button"><span class="btn-label"></span>Agregar Hoteles <i class="fa fa-plus"></i></button>
        </blockquote>
        <blockquote v-if="hotelsByEvent.length">
            <div class="alert alert-success" v-for="hotelByEvent in hotelsByEvent"  :key="hotelByEvent.id" > <i class="fa fa-building-o"></i>       {{ hotelByEvent.hotel_name }} <i class="fa fa-user"></i>       {{ hotelByEvent.single_rooms }} <i class="fa fa-users"></i> {{ hotelByEvent.double_rooms }}
                <button type="button" class="close" @click="deleteHotel(hotelByEvent.hotels_to_event_id,hotelByEvent.hotel_name)"> <span aria-hidden="true">&times;</span> </button>
            </div>
        </blockquote>
        <blockquote v-else>
            <h3 class="text-danger">Aun no asigna hoteles a este evento!</h3>
        </blockquote>
    </div>
</template>
<script>

import Swal from 'sweetalert2';
import 'sweetalert2/src/sweetalert2.scss';

import toastr from 'toastr';

export default {
    components: {
    },
    props: ['event_id'],
    data () {
        return {
            //variables
            hotelsByEvent:      [],
            errors:             [],
            
        }
    },
    created: function() {
        this.$bus.$on('get-hootels-by-event', () => {
            this.getHotelsByEvent()
        })
        this.getHotelsByEvent()
    },
    computed: {
        //computed functions
    },
    methods: {

        getHotelsByEvent(){
            let url = `/api/${this.event_id}/get-hotels-by-event`;
            axios.get(url).then(response => {
                this.hotelsByEvent = response.data;
            }).catch(error => {
                this.hotelsByEvent = [];
                this.errors = error.response.data;
            });
        },
        addHotel(){
            this.$bus.$emit('add-hotel',this.event_id);
        },
        isRoomAss(hotels_to_event_id){
            return new Promise((resolve, reject) => {
            //recSended = Object.assign({}, record);
            let url = `/api/${hotels_to_event_id}/get-rooms-assigned`;
            axios.get(url).then(response =>{
                if(response.data.length != 0){
                    resolve(response.data.length);
                }else{
                    reject();
                    }
                //console.log(`the record id: ${record_id}`)
            }).catch(error => {
                this.errors = error.response.data;
                //return false;
            });
            })
        },
        unassignRooms(hotels_to_event_id){
            return new Promise((resolve, reject) => {
            let url = `/api/${hotels_to_event_id}/delete_rooms`;
            axios.get(url).then(response =>{
                resolve();
            }).catch(error => {
                this.errors = error.response.data;
                reject();
            });
            })
        },
        unassignHotels(hotels_to_event_id){
            return new Promise((resolve, reject) => {
            let url = `/api/${hotels_to_event_id}/delete_hotel-assign`;
            axios.get(url).then(response =>{
                resolve();
            }).catch(error => {
                this.errors = error.response.data;
                reject();
            });
            })
        },
        async deleteBoth(hotels_to_event_id){
            try {
                await this.unassignRooms(hotels_to_event_id);
                toastr.success('Se liberaron las habitaciones correctamente');
                } catch (error) {
                    console.log(error);
                toastr.error('ocurrio un error durante la operación, intente nuevamente.');
            }
            try {
                await this.unassignHotels(hotels_to_event_id);
                toastr.success('Se elimino el hotel correctamente');
                this.getHotelsByEvent();
            } catch (error) {
                console.log(error);
                toastr.error('ocurrio un error durante la operación, intente nuevamente.');
            }
        },
        async deleteOne(hotels_to_event_id){
            try {
                await this.unassignRooms(hotels_to_event_id);
                toastr.success('Se liberaron las habitaciones correctamente');
                } catch (error) {
                    console.log(error);
                toastr.error('ocurrio un error durante la operación, intente nuevamente.');
            }
            try {
                await this.unassignHotels(hotels_to_event_id);
                this.getHotelsByEvent();
                toastr.success('Se elimino el hotel correctamente');
            } catch (error) {
                console.log(error);
                toastr.error('ocurrio un error durante la operación, intente nuevamente.');
            }
        },
        async deleteHotel(hotels_to_event_id,hotel){
            try{
                let isRoomAss = await this.isRoomAss(hotels_to_event_id);
                Swal.fire({
                    title: 'Eliminar hotel!',
                    text: `Este hotel cuenta con habitaciones asignadas, desea cancelar estas resaervas y eliminar el hotel ${hotel}?`,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si'
                }).then((result) =>{
                    if(result.value){
                        this.deleteBoth(hotels_to_event_id);
                    }
                })
            } catch(e){
                Swal.fire({
                    title: 'Eliminar hotel!',
                    text: `Esta seguro de eliminar el hotel ${hotel}`,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si'
                }).then((result) =>{
                    if(result.value){
                        this.deleteOne(hotels_to_event_id);
                    }
                })
            }

        }

    }
}
</script>