<template>
    <div style="border:1px solid grey; padding: 5px;">
    <form v-on:submit.prevent="storePlace">
        <FloatingLabel
            :config="{label: 'Nombre del lugar', hasError: placeInErr, hasClearButton: false }">
            <input name="placeName" v-model="place.place" type="text">
        </FloatingLabel>
        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.place }}</span>
        <br>
        <FloatingLabel
            :config="{label: '', hasError: cityInErr, hasClearButton: false }">
        <v-select id="placeCity" :options="cities" v-model="place.city_id"  label="city">
            <template slot="option" slot-scope="option">
                    <i :class="option.city"></i> {{ option.city }}
            </template>
        </v-select>
        </FloatingLabel>
        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.city_id }}</span>
        <label for="placeCity">Seleccione una ciudad</label>
        <br>
        <div class="jumbotron">
            <address-gen :data="place.address" @upAddress="setUpAddress" @upAddressDig="setUpAddressDig" @toReset="setReset"></address-gen>
        </div>
        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.address }}</span>
        <br>
        <button type="submit"  class="btn waves-effect waves-light btn-success" >Guardar</button>
    </form>

    </div>
</template>
<script>
import FloatingLabel from 'vue-simple-floating-labels'
import addressGen from './Address-gen'

export default {
    components:    {
        FloatingLabel,
        addressGen,
    },
    data () {
        return {
            place : {
                place:      '',
                city_id:    null,
                address:    '',
            },
            cities:         [],
            placeInErr:     null,
            cityInErr:      null,
            errors:         []
        }
    },
    created : function() {
        this.getCities()
    },
    methods : {
        getCities() {
            let url = '/api/get-cities';
            axios.get(url).then(response =>{
                this.cities = response.data;
                this.errors = [];
            }).catch(error => {
                this.cities = [];
                this.errors = error.response.data;
            });
        },
        setUpAddress : function(val) {
        //(Addres-gen)this function used to add the nomenclature an the letters, whit spaces to build the string
        this.place.address = this.place.address + ' ' + val + ' '
        },
        setUpAddressDig : function(val) {
        //(Address-gen)this function add the string whitout a initial space, this used in the numbers.
        this.place.address = this.place.address + val
        },
        setReset : function() {
        //(Address-gen) this function reset or erase the charset or adress that gives the object
        this.place.address = ''
        },
        storePlace : function() {
            this.place.city_id = this.place.city_id ? this.place.city_id.id : null
            let url = '/api/places/store'
            axios.post(url, this.place).then(response =>{
                //this.$bus.$emit('comp-cant-up')
                this.$bus.$emit('update-event-changes')
                this.$emit('handlerSuccess')  
            }).catch(error => {
                console.log(error)
                this.errors = error.response.data;
            });
        },
    }
    
}
</script>