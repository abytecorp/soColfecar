<template>
<div>
    <div id="newAffiliationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Nueva Afiliacion</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class=""><img src="" alt="user" class="img-circle" width="100" /></div>
                                <div class="p-l-20">
                                    <div class="form-group has-success m-b-40">
                                        <input type="text" class="form-control" id="input11"><span class="bar"></span>
                                        <label for="input11">Success State</label>
                                    </div>
                                    <h6>UIUX Designer</h6>
                                    <button class="btn btn-success"><i class="ti-plus"></i> Follow</button>
                                </div>
                            </div>
                            <div class="row m-t-40">
                                <div class="col b-r text-center">
                                    <h2 class="font-light">14</h2>
                                    <h6>Photos</h6></div>
                                <div class="col b-r text-center">
                                    <h2 class="font-light">54</h2>
                                    <h6>Videos</h6></div>
                                <div class="col text-center">
                                    <h2 class="font-light">145</h2>
                                    <h6>Tasks</h6></div>
                            </div>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <div class="card-body">
                            <p class="text-center aboutscroll">
                                Lorem ipsum dolor sit ametetur adipisicing elit, sed do eiusmod tempor incididunt adipisicing elit, sed do eiusmod tempor incididunLorem ipsum dolor sit ametetur adipisicing elit, sed do eiusmod tempor incididuntt
                            </p>
                            <ul class="list-icons d-flex flex-item text-center p-t-10">
                                <li class="col"><a href="javascript:void(0)" data-toggle="tooltip" title="Website"><i class="fa fa-globe font-20"></i></a></li>
                                <li class="col"><a href="javascript:void(0)" data-toggle="tooltip" title="twitter"><i class="fa fa-twitter font-20"></i></a></li>
                                <li class="col"><a href="javascript:void(0)" data-toggle="tooltip" title="Facebook"><i class="fa fa-facebook-square font-20"></i></a></li>
                                <li class="col"><a href="javascript:void(0)" data-toggle="tooltip" title="Youtube"><i class="fa fa-youtube-play font-20"></i></a></li>
                                <li class="col"><a href="javascript:void(0)" data-toggle="tooltip" title="Linkd-in"><i class="fa fa-linkedin-square font-20"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
                <!-- Validation wizard -->
        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
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
export default {
    data () {
        return {
            cmpStates:          [],
            changes:            [],
            companies:          [],
            nulledCompanies:    [],
            cmpsByStat:         [],
            count:              [],
            errors:             [],
            cmpStatSel:         null,
        }
    },
    created : function (){

    },
    methods : {

    }
}
</script>