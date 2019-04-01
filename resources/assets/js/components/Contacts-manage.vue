<template>
    <div>
        <div id="modal-contacts-manage" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">{{ company.bs_name }}</h4>
                        <button type="button" class="close" v-on:click="close">×</button>
                    </div>
                    <div class="modal-body">
                        <datatable-contacts v-if="assistants" :data="assistants"></datatable-contacts>
                        <edit-assistant v-if="assistant" :data="assistant" @cancel="cancelProcess"></edit-assistant>
                    </div>
                    <div class="modal-footer">                
                        <button type="button" class="btn btn-danger" v-on:click="close">Cerrar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
</template>
<script>

//import modules
import datatableContacts from './Datatable-contacts'
import editAssistant from './Edit-assistant'

export default {
    components: {
        //components
        datatableContacts,
        editAssistant
    },
    props: ['data'],
    data () {
        return {
            //variables
            company:    [],
            assistants: null,
            assistant:  null,
            errors:     []
        }
    },
    created: function() {
        //created methods
        this.getCompany()
        this.$bus.$on('set-id-assistant-in-contacts-manage', (id) => {
            this.assistants = null
            this.setIdAssistant(id)
        })
        this.$bus.$on('set-assistants-in-contacts-manage', (idCmp) =>{
            this.assitant = null
            this.assistant = this.getContactsByCompany(idCmp)
        })
    },
    mounted() {
        this.showModalContactsManage()
    },
    computed: {
        //computed functions
    },
    methods: {
        showModalContactsManage : function () {
            $('#modal-contacts-manage').modal('show')
        },
        close : function () {
            $('#modal-contacts-manage').modal('hide')
            $('.modal-backdrop').remove();
            this.$bus.$emit('set-null-isContactSelected',this.data)
        },
        getCompany : function () {
            let url = '/api/company/'+ this.data +'/get-company';
            axios.get(url).then(response =>{
                this.company = response.data
                this.getContactsByCompany(this.company.company_id)
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        getContactsByCompany : function (id) {
            let url = '/api/'+ id +'/assistants-by-companies';
            axios.get(url).then(response =>{
                this.assistants = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        setIdAssistant : function (id) {
            this.assistant = id
        },
        cancelProcess : function (val) {
            this.getContactsByCompany(val)
            this.assistant = null
        }
    }
}
</script>