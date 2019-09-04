<template>
    <div>
        <div id="newHotelEventModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Asigne el Hotel y sus habitaciones</h4>
                        <button type="button" class="close" @click="closeModal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <blockquote>
                            <h3> <i class="fa fa-h-square"></i> Seleccione un hotel</h3>
                            <v-select id="hotelSelect" placeholder="Seleccione un hotel" icon="fa fa-user" :options="hotels" v-model="hotelSelected" label="hotel_name">
                                <template slot="option" slot-scope="option">
                                        {{ option.hotel_name }}
                                </template>
                            </v-select>
                        </blockquote>
                        <div v-if="hotelSelected">
                        <blockquote>
                            <h3> <i class="icon-user"></i> Asigne la cantidad de habitaciones sencillas que estaran disponibles para el evento</h3>
                            <div class="form-group col-md-8 m-t-20">            
                                <FloatingLabel
                                    :config="{label: 'Cantidad de habitaciones sencillas', hasError: err.single_room, hasClearButton: false }">
                                    <input name="singleRooms" v-model="hotelAssigned.single_rooms" type="number">
                                </FloatingLabel>
                                <span v-if="err.single_room" class="text-danger" >{{ err.single_room }}</span>
                            </div>
                        </blockquote>
                        <blockquote>
                            <h3> <i class="icon-people"></i> Asigne la cantidad de habitaciones dobles que estaran disponibles para el evento</h3>
                                <FloatingLabel
                                    :config="{label: 'Cantidad de habitaciones dobles', hasError: err.double_room, hasClearButton: false }">
                                    <input name="singleRooms" v-model="hotelAssigned.double_rooms" type="number">
                                </FloatingLabel>
                                <span v-if="err.double_room" class="text-danger" >{{ err.double_room }}</span>                        
                        </blockquote>
                        <div class="alert alert-success" v-if="roomNumber"> <i class="fa fa-spinner"></i> Se activo la habitacion {{roomNumber}} en el evento
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success waves-effect" @click="addHotel()">Aceptar</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light"  @click="closeModal">Cerrar</button>                 
                    </div>
                </div>
                <!-- /.modal-content -->
                </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal --> 
    </div>
</template>
<script>
import toastr from 'toastr';
import FloatingLabel from 'vue-simple-floating-labels'

export default {
    props: ['event_id'],
    components: {
        toastr,
        FloatingLabel
    },
    data () {
        return {
            hotels:         [],
            hotelSelected:  null,
            hotelAssigned:  {
                id_hotel:       null,
                single_rooms:    '',
                double_rooms:    '',
                event_id:       ''
            },
            err:    {
                single_room:    '',
                double_room:    '',
            },
            roomNumber:     null,
            errors:         []
        }
    },
    mounted : function(){
        $('#newHotelEventModal').modal('show');
        this.getHotels()
    },
    methods : {
        closeModal(){
            $('#newHotelEventModal').modal('hide');
            this.$bus.$emit('close-add-hotel');
           //this.$bus.$emit('close-modal-link-coupon', this.invitation_link)
        },
        getHotels : function() {
            let url = '/api/get-hotels';
            axios.get(url).then(response =>{
                this.hotels = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        storeRoom : function(val,single){
            return new Promise((resolve, reject) => {
            let url = `/api/${val}/single-room/`;
            axios.get(url).then(response => {
                resolve(response.data.id+' sencilla');
            }).catch(error => {
                reject();
                this.errors = error.response.data
            });
            })
        },
        storeDoubleRoom : function(val,double){
            return new Promise((resolve, reject) => {
            let url = `/api/${val}/double-room`;
            axios.get(url).then(response => {
                resolve(response.data.id+' doble');
            }).catch(error => {
                reject();
            });
            })
        },
        setCreateSingleRooms(data){
            return new Promise((resolve, reject) => {
            let singles = [];
            for (var i = 0; i < this.hotelAssigned.single_rooms; i++) {
                singles.push({'i':i});
            }
            try {
                singles.forEach(async (single) => {
                await this.storeRoom(data.id,single);
                })
                toastr.success('Se activaron habitaciones sencillas correctamente!');
                resolve();
            } catch (error) {
                reject();
            }
            })    
        },
        setCreateDoubleRooms(data){
            return new Promise((resolve, reject) => {
            let doubles = [];
            for (var i = 0; i < this.hotelAssigned.double_rooms; i++) {
                doubles.push({'i':i});
            }
            try {
                doubles.forEach(async (double) => {
                await this.storeDoubleRoom(data.id,double);
                })
                toastr.success('Se activaron habitaciones dobles correctamente!');
                resolve();
            } catch (error) {
                reject();
            }
            
            })
        },
        async goToRooms(data){
                if(this.hotelAssigned.single_rooms.length > 0){
                    await this.setCreateSingleRooms(data);
                }
                this.roomNumber = null;
                if(this.hotelAssigned.double_rooms.length > 0){
                    await this.setCreateDoubleRooms(data);
                }
                this.roomNumber = null;
                toastr.success('Se creo el hotel satisfactoriamente!');
                this.$bus.$emit('get-hootels-by-event');
                $('#newHotelEventModal').modal('hide');
                this.$bus.$emit('close-add-hotel');
        },
        addHotel(){
            this.hotelAssigned.event_id = this.event_id;
            this.hotelAssigned.hotel_id = this.hotelSelected.id;
            let url = `/api/store-hotel-to-event`;
            axios.post(url, this.hotelAssigned).then(response => {
                this.goToRooms(response.data);                
            }).catch(error => {
                this.errors = error.response.data
            });

        }
    }
}
</script>