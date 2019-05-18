<template>
<div>
    <hr>
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <form v-on:submit.prevent="storeCompanyState">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tipo de evento</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" v-model="event_type.event_type" placeholder="Ingrese el tipo de evento">
                        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.event_type }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDescription">Descripcion</label>
                        <textarea class="form-control" id="exampleTextarea" rows="3" v-model="event_type.description" placeholder="Message"></textarea>
                        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.description }}</span>
                    </div>
                    <div class="form-group">
                        <v-select id="city" :options="icons" v-model="event_type.icon"  label="icon">
                            <template slot="option" slot-scope="option">
                                 <i :class="option.icon"></i> {{ option.icon }}
                            </template>
                        </v-select>
                        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.icon }}</span>
                    </div>
                    
                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Crear</button>
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
    data () {
        return {
            //variables
            icons:      [],
            event_type:   {
                event_type:  '',
                description:    '',
                icon:           null,
                slug:           ''
            },
            errors:     []
        }
    },
    created: function() {
        this.getIcons()
    },
    computed: {
        //computed functions
    },
    methods: {
        getIcons : function() {
            let url = '/api/get-icons';
            axios.get(url).then(response =>{
                this.icons = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        storeCompanyState :function() {
            let url = 'event-type/store'
            this.event_type.slug = this.event_type.event_type != '' ? this.event_type.event_type.toLowerCase().split(" ").join("-") : ''
            this.event_type.icon = this.event_type.icon != null ? this.event_type.icon.icon : ''
            axios.post(url, this.event_type).then(response =>{
                //this.responseTest = response.data
                //this.$bus.$emit('comp-cant-up')
                this.$bus.$emit('set-new-event-type-false')
                this.$bus.$emit('get-event-types')
                this.event_type.event_type=     '',
                this.event_type.description=       '',
                this.event_type.slug=       '',
                this.event_type.icon=              ''
            }).catch(error => {
                console.log(error)
                this.errors = error.response.data;
            });
        },
        cancelNew : function () {
            this.$bus.$emit('set-new-event-type-false')
            this.event_type.event_type=     '',
            this.event_type.description=       '',
            this.event_type.slug=              '',
            this.event_type.icon=              ''
        }
    }
}
</script>