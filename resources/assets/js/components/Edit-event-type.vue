<template>
<div>
    <hr>
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <form v-on:submit.prevent="storeEventType">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tipo de evento</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" v-model="up_event_type.event_type" placeholder="Ingrese el estado de la empresa">
                        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.event_type }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDescription">Descripcion</label>
                        <textarea class="form-control" id="exampleTextarea" rows="3" v-model="up_event_type.description" placeholder="Message"></textarea>
                        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.description }}</span>
                    </div>
                    <div class="form-group">
                        <v-select id="city" :options="icons" v-model="up_event_type.icon"  label="icon">
                            <template slot="option" slot-scope="option">
                                 <i :class="option.icon"></i> {{ option.icon }}
                            </template>
                        </v-select>
                        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.icon }}</span>
                    </div>
                    
                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Actualizar</button>
                    <button type="button" class="btn btn-danger" @click="cancelNew"> Cancelar</button>
                </form>
            </div>
        </div>
</div>
</template>
<script>
export default {
    components: {
        //compponents
    },
    props: ['data'],
    data () {
        return {
            //variables
            icons:      [],
            up_event_type:   {
                event_type:     '',
                description:    '',
                icon:           '',
                slug:           ''
            },
            errors:     []
        }
    },
    created: function() {
        this.getIcons()
        this.getEventType()
    },
    computed: {
        //computed functions
    },
    methods: {
        getEventType : function () {
            let url = '/api/get-event-type/'+ this.data;
            axios.get(url).then(response =>{
                this.up_event_type = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        getIcons : function() {
            let url = '/api/get-icons';
            axios.get(url).then(response =>{
                this.icons = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        storeEventType :function() {
            let url = 'event-type/'+this.up_event_type.id
            this.up_event_type.slug = this.up_event_type.event_type != '' ? this.up_event_type.event_type.toLowerCase().split(" ").join("-") : ''
            this.up_event_type.icon = typeof(this.up_event_type.icon) == "object" ? this.up_event_type.icon.icon : this.up_event_type.icon
            console.log(this.up_event_type.icon)
            axios.put(url, this.up_event_type).then(response =>{
                //this.responseTest = response.data
                //this.$bus.$emit('comp-cant-up')
                this.$bus.$emit('set-edit-event-type-false')
                this.$bus.$emit('get-event-types')
                this.up_event_type.event_type=          '',
                this.up_event_type.description=       '',
                this.up_event_type.slug=              '',
                this.up_event_type.icon=              ''
            }).catch(error => {
                console.log(error)
                this.errors = error.response.data;
            });
        },
        cancelNew : function () {
            this.$bus.$emit('set-edit-event-type-false')
            this.up_event_type.event_type=     '',
            this.up_event_type.description=       '',
            this.up_event_type.slug=              '',
            this.up_event_type.icon=              ''
        }
    }
}
</script>