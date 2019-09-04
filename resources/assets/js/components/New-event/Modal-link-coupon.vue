<template>
    <div>
        <div id="copyLinkModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Copie el enlace del cupon de inscripciòn</h4>
                        <button type="button" class="close" @click="closeModal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" disabled v-model="invitation_link" aria-label="" aria-describedby="basic-addon1">
                                    <div class="input-group-append">
                                        <button class="btn btn-info" @click="clipboardCopy" type="button">copiar al portapapeles!</button>
                                    </div>
                                    <input type="hidden" id="inputInvitationLink" :value="invitation_link">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-success waves-effect" @click="storeCompany()">Aceptar</button> -->
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
export default {
    props: ['invitation_link'],
    components: {
        toastr
    },
    data () {
        return {
            errors:         []
        }
    },
    mounted : function(){
        $('#copyLinkModal').modal('show');
    },
    methods : {
        closeModal(){
            $('#copyLinkModal').modal('hide');
           this.$bus.$emit('close-modal-link-coupon', this.invitation_link)
        },
        clipboardCopy(){
        let testingCodeToCopy = document.querySelector('#inputInvitationLink')
        testingCodeToCopy.setAttribute('type', 'text')    // 不是 hidden 才能複製
        testingCodeToCopy.select()

        try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'successful' : 'unsuccessful';
            toastr.success('Se copio el enlace exitosamente!');
        } catch (err) {
            toastr.error('Ocurrio un error, cargue de nuevo la pagina e intentelo nuevamente!')
        }
            /* unselect the range */
            testingCodeToCopy.setAttribute('type', 'hidden')
            window.getSelection().removeAllRanges()
        }
    }
}
</script>