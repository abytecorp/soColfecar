<template>
    <div>
        <hr>
       <div class="row button-group">
                <button :class="buttonClass.info">Habitación Seleccionada</button>
                <button :class="buttonClass.danger">Habitación Ocupada</button>
                <button :class="buttonClass.warning">Habitación con un cupo</button>
                <button :class="buttonClass.secondary">Habitación libre</button>
            <div class="col-lg-6 col-xlg-6 m-b-30">
                <h4>Habitaciones sencillas</h4>
                <button type="button" 
                    v-for="singleRoom in singleRooms" :key="singleRoom.id"
                    :class="[singleRoom.record_id == true ? buttonClass.info : valIsNumber(singleRoom.record_id) ? buttonClass.danger : buttonClass.secondary]"
                    :id="'single'+singleRoom.id"
                    :disabled="valIsNumber(singleRoom.record_id)"
                    @click="setRoom(singleRoom.id,'s')">
                    {{ singleRoom.room_number || 'Sencilla' }} 
                    <i class="icon-user"></i>
                </button>
            </div>
            <div class="col-lg-6 col-xlg-6 m-b-30">
                <h4>Habitaciones dobles</h4>
                <button type="button"
                    v-for="doubleRoom in doubleRooms" :key="doubleRoom.id"
                    :class="[doubleRoom.record_id == true ? buttonClass.info : doubleRoom.record_id && doubleRoom.companion_id ? buttonClass.danger : doubleRoom.record_id && !doubleRoom.companion_id || !doubleRoom.record_id && doubleRoom.companion_id ? buttonClass.warning : buttonClass.secondary]"
                    :id="'double'+doubleRoom.id"
                    :disabled="doubleRoom.record_id && doubleRoom.companion_id ? true : false"
                    @click="setRoom(doubleRoom.id,'d')">
                    {{ doubleRoom.room_number || 'Doble' }} 
                    <i class="icon-people"></i>
                </button>
            </div>   
       </div>

    </div>
</template>
<script>
export default {
    props: ['hotel_to_event_id','roomsSelected'],
    components: {

    },
    data () {
        return {
            company:        [],
            singleRooms:    [],
            doubleRooms:    [],
            buttonClass:    {
                success:    'btn btn-success',
                danger:     'btn btn-danger',
                secondary:  'btn btn-secondary',
                info:       'btn btn-info',
                warning:    'btn btn-warning'
            },
            errors:         []
        }
    },
    created : function(){
        this.getSingleRooms();
        this.getDoubleRooms();
    },
    beforeUpdate: function(){
        this.setSelectedRooms(this.roomsSelected);
    },
    methods : {
        getSingleRooms(){
            let url = `/api/${this.hotel_to_event_id}/get-single-rooms-external`;
            axios.get(url).then(response =>{
                this.singleRooms = response.data;
                this.errors = [];
            }).catch(error => {
                this.singleRooms = [];
                this.errors = error.response.data;
            });
        },
        getDoubleRooms(){
            let url = `/api/${this.hotel_to_event_id}/get-double-rooms-external`;
            axios.get(url).then(response =>{
                this.doubleRooms = response.data;
                this.errors = [];
            }).catch(error => {
                this.doubleRooms = [];
                this.errors = error.response.data;
            });
        },
        closed(){
            this.$emit('closeCompany');
        },
        unmarkDoubleSelected(room_id){
            let selectedDoubleIndex = this.doubleRooms.findIndex(doubleRoom => doubleRoom.record_id === 'is_double' || doubleRoom.companion_id === 'is_double' );
            if(selectedDoubleIndex > -1){
                if(this.doubleRooms[selectedDoubleIndex].record_id == 'is_double'){
                    this.doubleRooms[selectedDoubleIndex].record_id = null;
                }else if(this.doubleRooms[selectedDoubleIndex].companion_id == 'is_double'){
                    this.doubleRooms[selectedDoubleIndex].companion_id = null;
                }
                return true
            }else{
                //return false
            }
        },
        unmarkSingleSelected(singleRoom_id){
            let selectedIndex = this.singleRooms.findIndex(singleRoom => singleRoom.record_id === true);
            if(selectedIndex > -1){
                this.singleRooms[selectedIndex].record_id = null;
                return true
            }else{
                //return false
            }
        },
        markSingleRoom(singleRoom_id){
            let index = this.singleRooms.findIndex(singleRoom => singleRoom.id === singleRoom_id);
            this.singleRooms[index].record_id = true;
        },
        markDoubleRoom(doubleRoom_id){
            let index = this.doubleRooms.findIndex(doubleRoom => doubleRoom.id === doubleRoom_id);
            if(this.doubleRooms[index].record_id){
            this.doubleRooms[index].companion_id = 'is_double';
            }else{
                this.doubleRooms[index].record_id = 'is_double';
            }
        },
        setRoom(room_id,rt){
            if(rt === 's'){
                this.unmarkDoubleSelected(room_id);
                this.unmarkSingleSelected(room_id);
                this.markSingleRoom(room_id);
                let room = this.singleRooms.find(singleRoom => singleRoom.record_id === true);
                if(room){
                    this.$emit('setRoom',room);
                }
            }else{
                this.unmarkSingleSelected(room_id);
                this.unmarkDoubleSelected(room_id);
                this.markDoubleRoom(room_id);
                let room = this.doubleRooms.find(doubleRoom => doubleRoom.record_id === 'is_double' || doubleRoom.companion_id === 'is_double');
                if(room){
                    //console.log(room);
                    this.$emit('setRoom',room);
                }
            }

        },
        valIsNumber(val){
            if((val)){
                return true;
            }else{
                return false;
            }
        },
        setSelectedRooms(roomsSelected){
            if(roomsSelected.length > 0){
            roomsSelected.forEach(roomSelected => {
                let selectedIndex = this.singleRooms.findIndex(singleRoom => singleRoom.id == roomSelected.id);
                if(selectedIndex > -1){
                    //console.log(roomSelected.record_id)
                    if(roomSelected.record_id === 'is_double'){
                        let selectedIndex = this.doubleRooms.findIndex(doubleRoom => doubleRoom.id == roomSelected.id);
                        this.doubleRooms[selectedIndex].record_id = 99999;
                        }else{
                         
                    this.singleRooms[selectedIndex].record_id = 99999;
                    }
                }
            },this.singleRooms);
            }
        }
        
    }
}
</script>

