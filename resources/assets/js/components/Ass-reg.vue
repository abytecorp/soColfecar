<template>
<div>
    <div class="card-group">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h3><i class="icon-note"></i></h3>
                                <a href="#" data-toggle="modal" data-target="#ass-regM">
                                <p class="text-muted">ASISTENTES INSCRITOS</p>
                                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ass-regM" data-whatever="@mdo">Open modal for @mdo</button> -->
                                </a>
                            </div>
                            <div class="ml-auto" id="test1">
                                <h2 class="counter text-primary">{{ assistantsByEvent.length }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                    
                    
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                                        
                            <div>
                                <a href="#" v-on:click="newRegModal" >
                                <h3><i class="icon-screen-desktop"></i></h3>
                                <p class="text-muted">GAFETES IMPRESOS</p>
                                </a>
                            </div>
                            <div class="ml-auto">
                                <h2 class="counter text-cyan">{{ assPrinted }}</h2>
                            </div>
                                        
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-cyan" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                                        
                            <div>
                                <a href="#" v-on:click="newEntryModal" >
                                <h3><i class="icon-login"></i></h3>
                                <p class="text-muted">REGISTROS</p>
                                </a>
                            </div>
                            <div class="ml-auto">
                                <h2 class="counter text-cyan">{{ assRegistered.length }}</h2>
                            </div>
                                        
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-cyan" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                    
                    
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <a href="#" v-on:click="newRefModal" >
                                <h3><i class="icon-cup"></i></h3>
                                <p class="text-muted">REFRIGERIOS</p>
                                </a>
                            </div>
                            <div class="ml-auto">
                                <h2 class="counter text-purple">{{ refClaim.length }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-purple" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                 
                    
        <!-- <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h3><i class="icon-star"></i></h3>
                                <p class="text-muted">CHARLAS</p>
                            </div>
                            <div class="ml-auto">
                                <h2 class="counter text-success">431</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
   
    <div class="card-group">
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">TAREAS COMUNES</h5>
                    <div class="row">
                        <a href="#" v-on:click.prevent="newInscription" class="btn btn-block btn-outline-info">NUEVA INSCRIPCION</a>
                        <a href="#" v-on:click.prevent="showDatatable"  class="btn btn-block btn-outline-info">VALIDAR INSCRIPCIONES</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
     <div v-if="isDatatable"><data-table :data="assistantsByEvent" @updateAlimentsModal="setUpdateAlimentsModal" @updateAssistantModal="setUpdateAssistantModal" @updateDataTable="getAssistantsByEvent"></data-table></div>   
     <hr>
     <div class="card-group">
        <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">PLANES</h5>
                <div class="row">
                    <div v-if="plans == ''">
                            <a href="#" v-on:click="newPlanF" class="btn waves-effect waves-light btn-outline-danger">Aun no asigna planes a este evento!</a>
                    </div>
                    <div v-else>
                        <div class="button-group">
                            
                            <button v-for="plan in plans" :key="plan.id" type="button" v-on:click="editPlanF(plan)" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-xs">{{ plan.plan }} {{ plan.id }} {{plan.company_state}}</button>
                            
                        </div>
                        <a href="#" v-on:click="newPlanF" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-xs">NUEVO PLAN</a>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">HOTELES</h5>
                    <div class="row">
                            <div v-if="hotels == ''">
                                <a href="#" v-on:click="newHotelF" class="btn waves-effect waves-light btn-outline-danger">Aun no asiga Hoteles a este evento!</a>
                                
                            </div>
                        <div v-else>
                            <div v-for="hotel in hotels" :key="hotel.id" >
                            <table class="table-bordered ">
                            <button type="button" v-on:click="editHotelF(hotel)" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-xs">{{ hotel.hotel_name }}  </button>
                            <div v-if="hotel.rooms != ''">
                                <a href="#"  class="btn waves-effect waves-light btn-rounded btn-outline-info btn-xs">{{ disponibleNights.length }} Noches</a>
                            </div>

                            <a href="#" v-on:click="addRoom(hotel.id)" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-xs">Asignacion noches</a>
                            </table>
                            <hr>
                            </div>
                            <a href="#" v-on:click="newHotelF" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-xs">NUEVO HOTEL</a>
                             
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




 <!-- MODALS -->

    <div id="ass-regM" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Asistentes Inscritos</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive m-t-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Empresa</th>
                                    <th>Asistente</th>
                                    <th>Plan</th>
                                    <th>Estado</th>
                                    <th>Inscribe</th>
                                    <th>Fecha Inscripción</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Empresa</th>
                                    <th>Asistente</th>
                                    <th>Plan</th>
                                    <th>Estado</th>
                                    <th>Inscribe</th>
                                    <th>Fecha Inscripción</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr v-for="eventRecord in eventRecords" :key="eventRecord.id">
                                    <td>{{ eventRecord.bs_name }}</td>
                                    <td>{{eventRecord.names}} {{eventRecord.last_names}}</td>
                                    <td>{{ eventRecord.plan }}</td>
                                    <td>{{ eventRecord.record_state }} </td>
                                    <td>{{ eventRecord.enroll_name }} ({{ eventRecord.enroll_email }}) </td>
                                    <td>{{ since(eventRecord.created_at) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
    </div>

    <div id="reg" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">IMPRESION DE GAFETES</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    

                    <!-- v select to catch the assistant and his data -->
                    <v-select :options="eventRecords" @input="onChange">
                        <template slot="option" slot-scope="option">
                            {{ option.names+' '+option.last_names+' ( '+option.id_number+' ) ( '+option.bs_name+' ) ' }} 
                        </template>
                    </v-select>
                    <!-- v select -->
                        <!-- reg and print gafette -->
                        <div v-if="assSel != ''">
                        <div class="row" id="infoAss">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- Nav tabs -->
                                        <div class="vtabs customvtab">
                                            <ul class="nav nav-tabs tabs-vertical" role="tablist">
                                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home3" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Plan</span> </a> </li>
                                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile3" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Informacion Asistente</span></a> </li>
                                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages3" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Observaciones</span></a> </li>
                                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#billing" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Contabilidad</span></a> </li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="home3" role="tabpanel">
                                                    <div class="p-20">
                                                        <h3>{{assSel.plan}}</h3>
                                                        <h4>{{assSel.bill_price | currency}} <span class="muted"> Valor negociado</span></h4>
                                                        <p>{{assSel.pl_desc}}</p>

                                                        <div v-if="assSel.id_partner != null">
                                                        <p>Room mate: {{partnerData.names+' '+partnerData.last_names}}</p>
                                                        </div>
                                                        <hr>
                                                        <div class="alert alert-success" v-for="observationByRec in observationsByRec" :key="observationByRec.id">
                                                    {{ observationByRec.obs }} <br/><strong> {{ observationByRec.name+' '+observationByRec.last_name }} </strong> {{ since(observationByRec.created_at) }}
                                                    </div>


                                                    </div>
                                                </div>
                                                <div class="tab-pane  p-20" id="profile3" role="tabpanel">
                                                    <h3>{{assSel.bs_name}}</h3>
                                                    <h4>{{assSel.names}} {{assSel.last_names}}</h4>
                                                    <h4>{{assSel.city}}  ({{assSel.departament}})</h4>
                                                </div>
                                                <div class="tab-pane  p-20" id="messages3" role="tabpanel">
                                                    <textarea class="form-control" rows="5" v-model="observationByRec"></textarea>
                                                    <button type="button" class="btn btn-success" v-on:click="createObservationByRec(assSel.id_r)"><i class="fa fa-check"></i> Agregar</button>
                                                    <div class="alert alert-success" v-for="observationByRec in observationsByRec" :key="observationByRec.id">
                                                    {{ observationByRec.obs }} <br/><strong> {{ observationByRec.name+' '+observationByRec.last_name }} </strong> {{ since(observationByRec.created_at) }}
                                                    </div>
                                                </div>
                                                <div class="tab-pane  p-20" id="billing" role="tabpanel">
                                                    <!-- PANEL FACTURACION -->
                                                    <div class="alert alert-warning" v-for="billEjectByRecord in billsEjectsByRecord" :key="billEjectByRecord.id">
                                                    Valor Negociado {{ billEjectByRecord.price | currency }} <br/> Valor Iva  {{ parseInt(billEjectByRecord.price)*0.19 | currency }} <br/>Por: <strong> {{ billEjectByRecord.name+' '+billEjectByRecord.last_name }} </strong> {{ since(billEjectByRecord.created_at) }}
                                                    </div>

                                                    
                                                    <div class="alert alert-success" v-for="debitEjectByRecord in debitsEjectByRecord" :key="debitEjectByRecord.id">
                                                        Pago registrado {{ debitEjectByRecord.debit_price | currency }} <br/>con el numero de factrura:  {{ debitEjectByRecord.debit }} Por:<strong> {{ debitEjectByRecord.name+' '+debitEjectByRecord.last_name }} </strong> {{ since(debitEjectByRecord.created_at) }} <br>
                                                        Observacion: {{ debitEjectByRecord.observation }}
                                                    </div>

                                                     <hr>
                                                        <div class="input-group mb-3">
                                                            
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" class="form-control" v-model="billingValue" placeholder="Valor facturado" aria-label="Username" aria-describedby="basic-addon1">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">#</span>
                                                            </div>
                                                            <input type="number" class="form-control" v-model="billingNumber" placeholder="No de factura" aria-label="Username" aria-describedby="basic-addon1">
                                                        </div>
                                                        
                                                        <textarea class="form-control" rows="5" v-model="observationDebit"></textarea>
                                                        <div class="input-group mb-3">
                                                            <button type="button" class="btn btn-success" v-on:click="createBillDebitByRec(assSel.id_bill)" ><i class="fa fa-check"></i> Registrar pago</button>
                                                        </div>


                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div v-if="assSel.id_status_gafete == null">
                                            <button v-on:click="print(assSel.id_r)" class="btn btn-outline-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-print"></i></span> Imprimir</button>
                                        </div>
                                        <div v-else>
                                            <button v-on:click="print" class="btn btn-outline-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-print"></i></span> Reimprimir</button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </div>
                        <!-- reg and print gafette -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <!-- /.MODAL REGISTRO -->
    <div id="new-entry-modal" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">REGISTRO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                                <button type="button" v-on:click="setRegMode('qr')" class="btn btn-success btn-circle btn-lg"><i class="fa fa-qrcode"></i> </button>
                                <button type="button" v-on:click="setRegMode('vsel')" class="btn btn-info btn-circle btn-lg"><i class="fa fa-search-plus"></i> </button>
                                <hr>
                <div v-if="regMode == 'qr'">
                <qrcode-reader @detect="onDetect"></qrcode-reader>
                </div>
                <div v-else-if="regMode == 'vsel'">
                   

                    <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-barcode"></i></span>
                            </div>
                            <input type="text" class="form-control"  @keyup.enter="assistantRegistering()" v-model="assIdToReg" value="" >
                        </div>
                        <!-- <v-select :options="assistantsByEvent" @input="assistantRegistering" label="names">
                            <template slot="option" slot-scope="option">
                                {{ option.id }}
                            </template>
                        </v-select> -->
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <!-- /.MODAL REGRIGERIOS -->
    <div id="new-ref-modal" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">REFRIGERIOS</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                                
                                
                                <button type="button" v-on:click="setRefMode('AgendaAcademica')" class="btn btn-secondary"> Agenda Academica <i class="fa fa-graduation-cap"></i></button>
                                
                                <button type="button" v-on:click="setRefMode('Almuerzodia1')" class="btn btn-primary"><i class="fa fa-cutlery"></i> Almuerzo dia 1</button>
                                <button type="button" v-on:click="setRefMode('Almuerzodia2')" class="btn btn-primary"><i class="fa fa-cutlery"></i> Almuerzo dia 2</button>
                                <button type="button" v-on:click="setRefMode('Almuerzodia3')" class="btn btn-primary"><i class="fa fa-cutlery"></i> Almuerzo dia 3</button>
                               
                                <button type="button" v-on:click="setRefMode('Refrigeriodia1')" class="btn btn-info"><i class="fa fa-glass"></i> Refrigerio 1</button>
                                <button type="button" v-on:click="setRefMode('Refrigeriodia2')" class="btn btn-info"><i class="fa fa-glass"></i> Refrigerio 2</button>
                                <button type="button" v-on:click="setRefMode('Refrigeriodia3')" class="btn btn-info"><i class="fa fa-glass"></i> Refrigerio 3</button>
                                <button type="button" v-on:click="setRefMode('Refrigeriodia4')" class="btn btn-info"><i class="fa fa-glass"></i> Refrigerio 4</button>
                                
                                <button type="button" v-on:click="setRefMode('Cenadia1')" class="btn btn-warning"><i class="fa fa-moon-o"></i> Cena 1</button>
                                <button type="button" v-on:click="setRefMode('Cenadia2')" class="btn btn-warning"><i class="fa fa-moon-o"></i> Cena 2</button>
                                <button type="button" v-on:click="setRefMode('Cenadia3')" class="btn btn-warning"><i class="fa fa-moon-o"></i> Cena 3</button>
                                <hr>
                <div v-if="refMode != ''">
                    <span>{{ refMode }}</span>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-barcode"></i></span>
                            </div>
                            <input type="text" class="form-control"  @keyup.enter="getAssistantRef()" v-model="assIdToReF" id="refBox" value="" >
                        </div>
                </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div id="new-record-modal" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Nuevo Registro</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                        <hr>
                        <!-- v select to catch the assistant and his data -->
                        <h5 class="modal-title" id="myLargeModalLabel">1. Seleccione una empresa</h5>
                        <v-select :options="companies" @input="companySelected" label="bs_name">
                            <template slot="option" slot-scope="option">
                                {{ option.bs_name+ ' ( ' +option.nit +' )' }}
                            </template>
                        </v-select>
                        <br>
                        <button type="button" v-on:click="newCompany" class="btn waves-effect waves-light btn-rounded btn-outline-success">Nueva Empresa</button>
                        <!-- v select -->
                    <hr>
                    <div v-if="companySel != ''">
                        <!-- v select to catch the assistant and his data -->
                        <h5 class="modal-title" id="myLargeModalLabel">2. Seleccione un contacto</h5>
                        <v-select :options="assistantsByCmp" @input="getAssistantInRecord" label="names">
                            <template slot="option" slot-scope="option">
                                {{ option.names }} {{ option.last_names }} {{ option.position }}
                            </template>
                        </v-select>
                        <!-- v select -->
                        <br>
                        <button type="button" v-on:click="newContact" class="btn waves-effect waves-light btn-rounded btn-outline-success">Nuevo Contacto</button>
                    </div>
                    <div v-if="assistantSel != '' && companySel != ''">
                        <hr>
                        <h5 class="modal-title" id="myLargeModalLabel">3. Seleccione un Plan</h5>
                        <v-select :options="plans" @input="planUserSelected" label="plan">
                            <template slot="option" slot-scope="option">
                                {{ option.plan }} {{ option.pl_desc }} {{ option.price | currency }}
                            </template>
                        </v-select>
                        <blockquote>
                            <p>{{ planSel.pl_desc }} - {{ planSel.price | currency}}</p>
                            <small><cite title="Source Title">{{ planSel.company_state }}</cite></small>
                        </blockquote>
                        <h5 class="modal-title" id="myLargeModalLabel">Cambie el valor del plan si desea negociar o aplicar descuentos</h5>
                        <input class="" type="text" v-model="priceNegotiate"/>
                    </div>
                    
                    <div v-if="assistantSel != '' && companySel != '' && planSel.host != null">
                        <hr>
                        <h5 class="modal-title" id="myLargeModalLabel">4. Seleccione un Hotel</h5>
                        <v-select :options="hotels" @input="hotelUserSelected" label="hotel_name">
                            <template slot="option" slot-scope="option">
                                {{ option.hotel_name }} 
                            </template>
                        </v-select>
                        <div v-if="hotelSel != []">
                            <span><strong>{{ disponibleNights.length }} noches disponibles</strong></span>
                            <br>
                            <h5 class="modal-title" id="myLargeModalLabel">Seleccione el dia de llegada</h5>
                            <input type="date"  v-model="checkInDate">
                            <br>
                            <h5 class="modal-title" id="myLargeModalLabel">Seleccione el dia de Salida</h5>
                            <input type="date" v-on:change="setNights()"   v-model="checkOutDate">
                        </div>
                        <br>
                        <span> <strong>{{ nightCant }}</strong> Noches</span>
                        <br>
                        <hr>
                        <h5 class="modal-title" id="myLargeModalLabel">5. Seleccione el tipo de habitacion que asignara</h5>
                        <div class="form-group">
                            <v-select :options="roomTypes" v-model="roomTypeSel" label="room_type">
                                <template slot="option" slot-scope="option">
                                    {{ option.room_type }}
                                </template>
                            </v-select>
                        </div>
                        <div class="form-group" v-if="roomTypeSel.id == 1">
                        <h5 class="modal-title" id="myLargeModalLabel">2. Seleccione Contacto para habitacion doble</h5>
                        <v-select :options="assistantsByCmp" v-model="assRoomDoubleSet" label="names">
                            <template slot="option" slot-scope="option">
                                {{ option.names }} {{ option.last_names }} {{ option.position }}
                            </template>
                        </v-select>
                        </div>
                    </div>
                    <!-- <div v-if="planSel.lunches != null" class="form-group">
                        <br>
                        <h5 class="modal-title" id="myLargeModalLabel">Seleccione los Almuerzos</h5>
                        <button v-for="lunch in planSel.lunches" :key="lunch" v-on:click="discountLunch" class="btn btn-outline-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-hand-o-up"></i></span> Almuerzo Dia {{ lunch }} </button><br>
                        <button type="button" v-on:click="addLunch" class="btn waves-effect waves-light btn-outline-info">Agregar Almuerzo <i class="fa fa-plus-square"></i></button>
                    </div>
                    <hr>
                    <div v-if="planSel.academic_agenda != null" class="form-group">
                        <br>
                        <h5 class="modal-title" id="myLargeModalLabel">Seleccione Agenda Academica</h5>
                        <button v-for="academic_agenda in planSel.academic_agenda" :key="academic_agenda" v-on:click="discountAcademic_agenda" class="btn btn-outline-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa  fa-mortar-board"></i></span> Agenda Academica {{ academic_agenda }} </button><br>
                        <button type="button" v-on:click="addAcademic_agenda" class="btn waves-effect waves-light btn-outline-info">Agregar Agenda <i class="fa fa-plus-square"></i></button>
                    </div>
                    <div v-if="planSel.breakfast != null" class="form-group">
                        <br>
                        <h5 class="modal-title" id="myLargeModalLabel">Seleccione Desayunos</h5>
                        <button v-for="breakfast in planSel.breakfast" :key="breakfast" v-on:click="discountBreakfast" class="btn btn-outline-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa  fa-gear"></i></span> Desayuno Dia {{ breakfast }} </button><br>
                        <button type="button" v-on:click="addBreakfast" class="btn waves-effect waves-light btn-outline-info">Agregar Desayuno <i class="fa fa-plus-square"></i></button>
                    </div>
                    <div v-if="planSel.dinner != null" class="form-group">
                        <br>
                        <h5 class="modal-title" id="myLargeModalLabel">Seleccione Cenas</h5>
                        <button v-for="dinner in planSel.dinner" :key="dinner" v-on:click="discountDinner" class="btn btn-outline-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-hand-o-up"></i></span> Cena Dia {{ dinner }} </button><br>
                        <button type="button" v-on:click="addDinner" class="btn waves-effect waves-light btn-outline-info">Agregar cena <i class="fa fa-plus-square"></i></button>
                    </div>
                    <div v-if="planSel.refreshments != null" class="form-group">
                        <br>
                        <h5 class="modal-title" id="myLargeModalLabel">Seleccione Refrigerios</h5>
                        <button v-for="refreshment in planSel.refreshments" :key="refreshment" v-on:click="discountRefreshment" class="btn btn-outline-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-glass"></i></span> Refrigerio {{ refreshment }} </button><br>
                        <button type="button" v-on:click="addRefreshment" class="btn waves-effect waves-light btn-outline-info">Agregar Refrigerio <i class="fa fa-plus-square"></i></button>
                    </div> -->
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" v-on:click="saveRecord">Guardar Registro</button>
                </div>
            </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
    </div>

    <div id="newPlanModal" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Crear un nuevo Plan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="POST" v-on:submit.prevent="createNewPlan">
                        <div class="form-group">
                            <label for="planInput">Plan</label>
                            <input type="text" class="form-control" name="planInput" v-model="newPlan" placeholder="Ingrese el nombre del plan">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.plan }}</span>
                        </div>
                        <div class="form-group">
                            <label for="textPl_desc">Descripción</label>
                            <textarea class="form-control" name="textPl_desc" rows="5" v-model="newDescription" id="descriptionTextarea"></textarea>
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.pl_desc }}</span>
                        </div>
                        <div>
                            <input type="hidden" name="id_event" v-bind="eventS">
                        </div>
                        <label for="id_company_state">Seleccione el tipo de beneficio</label>
                        <div class="form-group"> 
                            <v-select :options="companyStates" v-model="newCompanyState"  label="company_state">
                                <template slot="option" slot-scope="option">
                                    {{ option.company_state }} 
                                </template>
                            </v-select>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.id_company_state }}</span>
                        </div>
                        <label for="event">Evento</label>
                        <div class="form-group">
                            <input type="text" v-model="eventSelects.event" class="form-control" disabled>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.id_event }}</span>
                        </div>
                        <label for="priceInput">Valor del plan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input id="priceInput" type="text" v-model="newPrice" class="form-control" name="price" aria-label="Amount (to the nearest dollar)">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.price }}</span>
                        </div>
                        <br>
                        <div class="form-group col-sm-2">
                            <label for="input_academic">Agenda Academica</label>
                            <input type="number" class="form-control" name="input_academic" v-model="new_academic_agenda" placeholder="">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.academic_agenda }}</span>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="input_lunch">Aluerzos</label>
                            <input type="number" class="form-control" name="input_lunch" v-model="new_lunches" placeholder="">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.lunches }}</span>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="input_refreshmen">Refrigerios</label>
                            <input type="number" class="form-control" name="input_refreshmen" v-model="new_refreshmen" placeholder="">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.refreshmen }}</span>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="input_dinner">Cenas</label>
                            <input type="number" class="form-control" name="input_dinner" v-model="new_dinner" placeholder="">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.dinner }}</span>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="input_breakfast">Desayunos</label>
                            <input type="number" class="form-control" name="input_breakfast" v-model="new_breakfast" placeholder="">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.breakfast }}</span>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="input_host">Hospedaje</label>
                            <input type="number" class="form-control" name="input_host" v-model="new_host" placeholder="">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.host }}</span>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-info waves-effect text-left">Guardar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    
                </div>
                
            </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
    </div>

    <div id="editPlanModal" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Editar Plan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="POST" v-on:submit.prevent="updatePlan(fillPlan.id)">
                        <div class="form-group">
                            <label for="planInput">Plan</label>
                            <input type="text" class="form-control" name="plan" v-model="fillPlan.plan" placeholder="Ingrese el nombre del plan">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.plan }}</span>
                        </div>
                        <div class="form-group">
                            <label for="descriptionTextarea">Descripción</label>
                            <textarea class="form-control" name="pl_desc" rows="5" v-model="fillPlan.pl_desc" id="descriptionTextarea"></textarea>
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.pl_desc }}</span>
                        </div>
                        <div>
                            <input type="hidden" name="id_event" v-bind="eventS">
                        </div>
                        <label for="id_company_state">Seleccione el tipo de beneficio</label>
                        <div class="form-group"> 
                            <select  name="id_company_state" v-model="fillPlan.id_company_state">
                                <option value=""></option>
                                <option v-for="companyState in companyStates" :key="companyState.id" :value="companyState.id">
                                    {{ companyState.company_state }} 
                                </option>
                            </select>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.id_company_state }}</span>
                        </div>
   
                        <label for="priceInput">Valor del plan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input id="priceInput" type="text" v-model="fillPlan.price" class="form-control" name="price" aria-label="Amount (to the nearest dollar)">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.price }}</span>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-info waves-effect text-left">Actualizar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    
                </div>
                
            </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
    </div>


    <div id="new-company-modal" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Crea una nueva Empresa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="POST" v-on:submit.prevent="createNewCompany">
                        <div class="form-group">
                            <label for="bs_nameInput">Razon Social (*)</label>
                            <input type="text" class="form-control" name="bs_nameInput" v-model="new_bs_name" placeholder="Nombre o razon social">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.bs_name }}</span>
                        </div>
                        <div class="form-group">
                            <label for="acronymInput">Siglas</label>
                            <input type="text" class="form-control" name="acronymInput" v-model="new_acronym" placeholder="Siglas">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.acronym }}</span>
                        </div>
                        <div class="form-group">
                            <label for="nitInput">NIT</label>
                            <input type="text" class="form-control" name="nitInput" v-model="new_nit" placeholder="Nit">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.nit }}</span>
                        </div>
                        <div class="form-group">
                            <label for="webInput">Pagina WEB</label>
                            <input type="text" class="form-control" name="webInput" v-model="new_web" placeholder="Pagina WEB">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.web }}</span>
                        </div>
                        <div class="form-group">
                            <label for="emailInput">Email principal(*)</label>
                            <input type="text" class="form-control" name="emailInput" v-model="new_email" placeholder="info@empresa.com">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.email }}</span>
                        </div>
                        
                        <hr>
                        <button type="submit" class="btn btn-info waves-effect text-left">Guardar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    
                </div>
                
            </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
    </div>


    <div id="new-contact-modal" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Crea un nuevo Contacto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="POST" v-on:submit.prevent="createNewContact">
                        <div class="form-group">
                            <label for="namesInput">Nombres(*)</label>
                            <input type="text" class="form-control" name="namesInput" v-model="new_names" placeholder="Nombres">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.names }}</span>
                        </div>
                        <div class="form-group">
                            <label for="last_namesInput">Apellidos(*)</label>
                            <input type="text" class="form-control" name="last_namesInput" v-model="new_last_names" placeholder="Apellidos">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.last_names }}</span>
                        </div>
                        <div class="form-group">
                            <label for="last_namesInput">Identificacion</label>
                            <input type="text" class="form-control" name="last_namesInput" v-model="new_id_number" placeholder="Numero de identificacion">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.id_number }}</span>
                        </div>
                        <label for="id_company_state">Seleccione la ciudad(*)</label>
                            <v-select :options="cities" v-model="new_id_city"  label="city">
                                <template slot="option" slot-scope="option">
                                    {{ option.city }} ( {{ option.get_departament.departament }}  )
                                </template>
                            </v-select>
                            <!-- v select -->
                        <div class="form-group">
                            <label for="webInput">Direccion</label>
                            <input type="text" class="form-control" name="webInput" v-model="new_address" placeholder="Direccion">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.address }}</span>
                        </div>
                        <div class="form-group">
                            <label for="webInput">Telefono</label>
                            <input type="text" class="form-control" name="webInput" v-model="new_tel" placeholder="Direccion">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.tel }}</span>
                        </div>
                                                <div class="form-group">
                            <label for="webInput">Celular</label>
                            <input type="text" class="form-control" name="webInput" v-model="new_cel" placeholder="Direccion">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.cel }}</span>
                        </div>
                        <div class="form-group">
                            <label for="emailInput">Cargo</label>
                            <input type="text" class="form-control" name="emailInput" v-model="new_position" placeholder="Cargo">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.position }}</span>
                        </div>
                         <div class="form-group">
                            <label for="emailInput">Em@il(*)</label>
                            <input type="text" class="form-control" name="emailInput" v-model="new_email" placeholder="Em@il">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.email }}</span>
                        </div>
                        
                        <hr>
                        <button type="submit" class="btn btn-info waves-effect text-left">Guardar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    
                </div>
                
            </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
    </div>


    <div id="new-hotel-modal" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Crea un nuevo Hotel</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="POST" v-on:submit.prevent="createNewHotel">
                        <div class="form-group">
                            <label for="inputHotelName">Nombre del Hotel</label>
                            <input type="text" class="form-control" name="inputHotelName" v-model="new_hotel_name" placeholder="Nombre del Hotel">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.hotel_name }}</span>
                        </div>
                         <label for="inputIdCityHotel">Ciudad</label>
                        <div class="form-group">
                        <v-select :options="cities" v-model="new_id_city"  label="city">
                            <template slot="option" slot-scope="option">
                                {{ option.city }} ( {{ option.get_departament.departament }}  )
                            </template>
                        </v-select>
                        </div>
                        <div class="form-group">
                            <label for="inputAddressHotel">Direccion</label>
                            <input type="text" class="form-control" name="inputAddressHotel" v-model="new_address" placeholder="Direccion">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.last_names }}</span>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Em@il</label>
                            <input type="text" class="form-control" name="inputEmail" v-model="new_email" placeholder="Em@il">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.email }}</span>
                        </div>
                        <div class="form-group">
                            <label for="inputWebHotel">Pagina WEB</label>
                            <input type="text" class="form-control" name="inputWebHotel" v-model="new_web" placeholder="Pagina WEB">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.web }}</span>
                        </div>
                        <div class="form-group">
                            <label for="inputStarsHotel">Calificacion en Estrellas</label>
                            <input type="number" class="form-control" name="inputStarsHotel" v-model="new_stars" placeholder="">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.stars }}</span>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-info waves-effect text-left">Guardar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    
                </div>
                
            </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
    </div>

    <div id="new-rooms-modal" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Asigne Noches a los hoteles</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="POST" v-on:submit.prevent="createNewRooms">
                        
                        <label for="inputIdCityHotel">Seleccione Hotel</label>
                        <div class="form-group">
                            <v-select :options="hotels" v-model="hotelSelToRoom"  label="hotel_name">
                                <template slot="option" slot-scope="option">
                                    {{ option.hotel_name }}
                                </template>
                            </v-select>
                        </div>
                        <br>
                        <!-- <label for="inputIdCityHotel">Seleccione tipo de habitacion</label>
                        <div class="form-group">
                            <v-select :options="roomTypes" v-model="roomTypeSel" label="room_type">
                                <template slot="option" slot-scope="option">
                                    {{ option.room_type }}
                                </template>
                            </v-select>
                        </div> -->
                        <div class="form-group col-sm-2">
                            <label for="input_host">Cantidad de noches</label>
                            <input type="number" class="form-control" name="input_host" v-model="rooms_cant" placeholder="">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.host }}</span>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-info waves-effect text-left">Guardar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    
                </div>
                
            </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
    </div>

    <div id="update-assistant-modal" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Editar informacion de Asistente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="POST" v-on:submit.prevent="updateAssistant(assistantUp.id)">
                        <div class="form-group">
                            <label for="namesInput">Nombres(*)</label>
                            <input type="text" class="form-control" name="namesInput" v-model="assistantUp.names" placeholder="Nombres">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.names }}</span>
                        </div>
                        <div class="form-group">
                            <label for="last_namesInput">Apellidos(*)</label>
                            <input type="text" class="form-control" name="last_namesInput" v-model="assistantUp.last_names" placeholder="Apellidos">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.last_names }}</span>
                        </div>
                        <div class="form-group">
                            <label for="last_namesInput">Identificacion</label>
                            <input type="text" class="form-control" name="last_namesInput" v-model="assistantUp.id_number" placeholder="Numero de identificacion">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.id_number }}</span>
                        </div>
                        <label for="id_company_state">Seleccione la ciudad(*)</label>
                            <v-select :options="cities" v-model="assistantUp.city"  label="city">
                                <template slot="option" slot-scope="option">
                                    {{ option.city }} ( {{ option.get_departament.departament | toUppercase }}  )
                                </template>
                            </v-select>
                            <!-- v select -->
                        <div class="form-group">
                            <label for="webInput">Direccion</label>
                            <input type="text" class="form-control" name="webInput" v-model="assistantUp.address" placeholder="Direccion">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.address }}</span>
                        </div>
                        <div class="form-group">
                            <label for="webInput">Telefono</label>
                            <input type="text" class="form-control" name="webInput" v-model="assistantUp.tel" placeholder="Direccion">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.tel }}</span>
                        </div>
                                                <div class="form-group">
                            <label for="webInput">Celular</label>
                            <input type="text" class="form-control" name="webInput" v-model="assistantUp.cel" placeholder="Direccion">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.cel }}</span>
                        </div>
                        <div class="form-group">
                            <label for="emailInput">Cargo</label>
                            <input type="text" class="form-control" name="emailInput" v-model="assistantUp.position" placeholder="Cargo">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.position }}</span>
                        </div>
                         <div class="form-group">
                            <label for="emailInput">Em@il(*)</label>
                            <input type="text" class="form-control" name="emailInput" v-model="assistantUp.email" placeholder="Em@il">
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.email }}</span>
                        </div>
                        <label for="id_company">Seleccione la Empresa(*)</label>
                        <v-select :options="companies" v-model="assistantUp.bs_name"  label="bs_name">
                            <template slot="option" slot-scope="option">
                                {{ option.bs_name }} ( {{ option.acronym }}  )
                            </template>
                        </v-select>
                        <!-- v select -->
                        
                        <hr>
                        <button type="submit" class="btn btn-info waves-effect text-left">editar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    
                </div>
                
            </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
    </div>


    <div id="update-alimnets-modal" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Active o desactive el alimento dando clic sobre el mismo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                                    <div class="col-lg-12 col-xlg-12 m-b-30">
                                        <button v-bind:class="buttonLaunchedClases.Refrigeriodia1" type="button" v-on:click="changeLunchStatus('Refrigeriodia1')"><span class="btn-label"><i class="fa fa-coffee"></i></span> Refrigerio dia 1</button>
                                        <button v-bind:class="buttonLaunchedClases.Refrigeriodia2" type="button" v-on:click="changeLunchStatus('Refrigeriodia2')"><span class="btn-label"><i class="fa fa-coffee"></i></span> Refrigerio dia 2</button>
                                        <button v-bind:class="buttonLaunchedClases.Refrigeriodia3" type="button" v-on:click="changeLunchStatus('Refrigeriodia3')"><span class="btn-label"><i class="fa fa-coffee"></i></span> Refrigerio dia 3</button>
                                        <button v-bind:class="buttonLaunchedClases.Refrigeriodia4" type="button" v-on:click="changeLunchStatus('Refrigeriodia4')"><span class="btn-label"><i class="fa fa-coffee"></i></span> Refrigerio dia 4</button>
                                        <hr>
                                        <button v-bind:class="buttonLaunchedClases.Almuerzodia1" type="button" v-on:click="changeLunchStatus('Almuerzodia1')"><span class="btn-label"><i class="fa fa-cutlery"></i></span> Almuerzo dia 1</button>
                                        <button v-bind:class="buttonLaunchedClases.Almuerzodia2" type="button" v-on:click="changeLunchStatus('Almuerzodia2')"><span class="btn-label"><i class="fa fa-cutlery"></i></span> Almuerzo dia 2</button>
                                        <button v-bind:class="buttonLaunchedClases.Almuerzodia3" type="button" v-on:click="changeLunchStatus('Almuerzodia3')"><span class="btn-label"><i class="fa fa-cutlery"></i></span> Almuerzo dia 3</button>
                                        <hr>
                                        <button v-bind:class="buttonLaunchedClases.Cenadia1" type="button" v-on:click="changeLunchStatus('Cenadia1')"><span class="btn-label"><i class="fa fa-cutlery"></i></span> Cena dia 1</button>
                                        <button v-bind:class="buttonLaunchedClases.Cenadia2" type="button" v-on:click="changeLunchStatus('Cenadia2')"><span class="btn-label"><i class="fa fa-cutlery"></i></span> Cena dia 2</button>
                                        <button v-bind:class="buttonLaunchedClases.Cenadia3" type="button" v-on:click="changeLunchStatus('Cenadia3')"><span class="btn-label"><i class="fa fa-cutlery"></i></span> Cena dia 3</button>
                                        <hr>
                                    </div>

                </div>
                <div class="modal-footer">
                    
                </div>
                
            </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
    </div>

    <hr>

</div>           
</template>

<script>
import axios from 'axios'
import moment from 'moment'
import toastr from 'toastr'
//import vSelec from 'vue-select'

import vSelect from 'vue-select';
Vue.component( 'v-select', vSelect );

import VueQrcodeReader from 'vue-qrcode-reader';
Vue.component( 'vue-qrcode-reader', VueQrcodeReader)

import dataTable from './Data-table';
//import updateAssistantmodal from './Updateassistant-modal';
//Vue.component('update-assistantmodal', updateAssistantmodal)

import toUppercase from '../filters/to-uppercase';
Vue.use(toUppercase)

import VueCurrencyFilter from 'vue-currency-filter'
Vue.use(VueCurrencyFilter,{
    symbol: '$', // El símbolo, por ejemplo €
  thousandsSeparator: ',', // Separador de miles
  fractionCount: 2, // ¿Cuántos decimales mostrar?
  fractionSeparator: '.', // Separador de decimales
  symbolPosition: 'front', // Posición del símbolo. Puede ser al inicio ('front') o al final ('') es decir, si queremos que sea al final, en lugar de front ponemos una cadena vacía ''
  symbolSpacing: true // Indica si debe poner un espacio entre el símbolo y la cantidad

})
export default {
    props: ['event'],
    components: {
        dataTable
    },
    data () {
        return {
            errors:             [],
            eventSelects:       [],
            eventRecords:       [],
            buttonSmDisRoom:    'btn waves-effect waves-light btn-rounded btn-secondary btn-xs',
            buttonSmDEnRoom:    'btn waves-effect waves-light btn-rounded btn-success btn-xs',
            isDatatable:        null,

            refClaim:           [],
            cities:             [],
            assReg:             0,
            modelRecords:       null,
            regMode:            '',
            refMode:            '',
            checkInDate:        '',
            checkOutDate:       '',
            billCost:           [],
            billDebit:          [],
            billingValue:       '',
            billingNumber:      '',
            observationDebit:   '',
            billsEjectsByRecord:[],
            debitsEjectByRecord:[],
            nightCant:          0,
            assIdToReF:         null,
            disponibleNights:   [],
            assistantsByEvent:  [],
            assSel:             [],
            assRoomDoubleSet:   [],
            partnerData:        [],
            observationsByRec:  [],
            observationByRec:   '',
            assPrinted:         0,
            assRegistered:      0,
            assAlreadyRegEntry:  0,
            assIdToReg:          null,
            recordSelectedOne:  [],
            refRecordStatus:    [],
            companies:          [],
            companySel:         [],
            hotels:             [],
            hotelSel:           [],
            priceNegotiate:     [],
            roomTypes:          [],
            roomTypeSel:        [],
            rooms_cant:         0,
            roomsByHotel:       [],
            asistantsRegistered:    [],
            roomSel:            0,
            assistantsByCmp:    [],
            assistantSel:       [],
            plans:              [],
            planSel:            [],
            companyStates:      [],
            newPlan:            '',//new plan form
            newDescription:     '',//new plan form
            newCompanyState:    '',//new plan form
            newEvent:           '',//new plan form
            newPrice:           '',//new plan form
            fillPlan:           {'id':'','plan':'','pl_description':'','id_company_state':'','price':''},
            new_bs_name:        '',
            new_acronym:        '',
            new_nit:            '',
            new_web:            '',
            new_email:          '',
            new_academic_agenda:    1,
            new_lunches:            3,
            new_refreshmen:         4,
            new_dinner:             3,
            new_breakfast:          '',
            new_host:               '',
            fillCompany:        {              },
            new_names:          '',
            new_last_names:     '',
            new_id_number:      '',
            new_id_city:        '',
            new_address:        '',
            new_tel:            '',
            new_cel:            '',
            new_position:       '',
            new_email:          '',
            fillContact:        {              },
            new_hotel_name:     '',
            new_id_city:        '',
            new_stars:          '',
            hotelSelToRoom:     [],
            contableEstatus:     0,
            isIdAssSelected:        null,
            isIdAlimentsSelected:   null,
            assistantUp: {
                names:          '',
                last_names:     '',
                id_number:     '',
                email:         '',
                position:      '',
                id_card:       '',
                id_city:       '',
                address:       '',
                tel:           '',
                cel:           '',
                position:      '',
                email:         '',
            },
            rSelToLunch:        [],
            buttonLaunchedClases:    {
                Refrigeriodia1: '',
                Refrigeriodia2: '',
                Refrigeriodia3: '',
                Refrigeriodia4: '',
                Almuerzodia1:   '',
                Almuerzodia2:   '',
                Almuerzodia3:   '',
                Cenadia1:       '',
                Cenadia2:       '',
                Cenadia3:       '',
            },
            


        }
    },
    created: function() {
        this.getPlans()
        this.getCities()
        this.getRecords()
        this.getDisponibleNights()
        this.getAssistantsByEvent()
        this.getEvents()
        this.getHotels()
        this.getAsPr()
        this.getCompanies()
        this.getRoomTypes()
        this.getAssRegistered()
        this.getTotalRef()
    },
    methods: {
        async onDetect (promise) {
            try {
            const {
                source,       // 'file', 'url' or 'stream' 
                imageData,    // raw image data of image/frame
                content,      // decoded String
                location      // QR code coordinates
            } = await promise
            var init = content.indexOf('[');
            var end = content.indexOf(']');

            var text = content.slice(init,end+1);
            text = text.replace('[','');
            text = text.replace(']','');
            var id_assistantReg = parseInt(text);

            alert(id_assistantReg);
            } catch (error) {
            if (error.name === 'DropImageFetchError') {
                // drag-and-dropped URL (probably just an <img> element) from different
                // domain without CORS header caused same-origin-policy violation
            } else if (error.name === 'DropImageDecodeError') {
                // drag-and-dropped file is not of type image and can't be decoded
            } else {
                // idk, open an issue ¯\_(ツ)_/¯
            }
            }
        },
        since : function(d) {
            return moment(d).fromNow();
        },
        getRecords : function() {
            var urlGetRecords = '/records/'+ this.event +'/lists';
            axios.get(urlGetRecords).then(response =>{
                this.eventRecords = response.data
                //console.log('este es al valo mijo: '+this.assReg);
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        getDataTableGeneral : function() {
        },
        getEvents : function() {
            var urlGetEvents = '/api/get-events/'+ this.event;
            axios.get(urlGetEvents).then(response =>{
                this.eventSelects = response.data
            });
        },
        getCities : function() {
            var url = '/api/get-cities/';
            axios.get(url).then(response =>{
                this.cities = response.data
            });
        },
        getCompanies : function() {
            var urlGetCompanies = '/api/get-companies';
            axios.get(urlGetCompanies).then(response =>{
                this.companies = response.data
            });
        },
        handleClick(command) {
      this.$message(`click dropdown button ${command}`)
    },
        getAssRegistered : function() {
            var url = '/api/'+ this.event +'/get-assistants-registered';
            axios.get(url).then(response =>{
                this.assRegistered = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        getTotalRef(){
            var url = '/api/'+ this.event +'/get-total-ref';
            axios.get(url).then(response =>{
                this.refClaim = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        getDisponibleNights: function() {
            var url = '/api/'+ this.hotelSel.id +'/get-disponible-nights-by-hotel';
            axios.get(url).then(response =>{
                this.disponibleNights = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        newRegModal : function() {
            this.getAsPr();
            
            $('#reg').modal('show');
        },
        newEntryModal : function() {
            this.getAsPr();
            $('#new-entry-modal').modal('show');
        },
        getHotels : function() {
            var url = '/api/get-hotels';
            axios.get(url).then(response =>{
                this.hotels = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        getBillCostByReg : function(regId) {
            var url = '/api/'+ regId +'/get-bill-costs-by-id'
        },
        onChange : function(val) {
            if(val != null){
            this.assSel = val
            this.getObservationByRec(val.id_r);
            this.getBillsByRec(val.id_r);
            this.getDebitsByRec(val.id_bill);
            this.getPartnerData();
            this.getContableStatus();
            //this.getBillCostsByReg(val.id_r)
            //this.getBillDebitsByReg(val.id_r)
            }else{
                this.assSel = []
            
            }
        },
        getContableStatus : function(val) {

        },
        getPartnerData : function() {
            if(this.assSel.id_partner != null){
                var url = '/api/'+this.assSel.id_partner+'/get-partner-data';
                axios.get(url).then(response =>{
                    this.partnerData = response.data
                }).catch(error => {
                    this.errors = error.response.data
                });
            }
        },
        print : function(id_rec) {
            var urlUpdatePrint = '/update-record-print/'+ id_rec ;
            axios.put(urlUpdatePrint, this.assSel).then(response =>{
                //this.assSel = response.data
                this.errors = []
                window.open('/print-gafete/'+id_rec , '_blank');
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        getAsPr : function() {
            var urlGetprinted = '/printed/'+ this.event +'/lists';
            axios.get(urlGetprinted).then(response =>{
                this.assPrinted = response.data.length
                //this.assReg = this.eventRecords.length
            });
        },
        newInscription : function() {
            if(this.plans != ''){
                if(this.hotels != ''){
            $('#new-record-modal').modal('show')
                }else{
                    toastr.error('Aun no se asignan hoteles para este evento!')
                }
            }else{
                toastr.error('Aun no se asignan los planes para este evento!')
            }
        },
        companySelected : function(val) {
            if(val != null){
            this.companySel = val
            this.getAssistantsByCmp(val.id)
            }else{
                this.companySel =       [];
                this.assistantSel =     [];
                this.planSel =          [];
                this.hotelSel =         [];
                this.assistantsByCmp =  [];
                this.roomSel =          0;
            }
        },
        getAssistantsByCmp: function(id) {
            var urlAssistantsByCmp = '/api/'+ id +'/assistants-by-companies';
            axios.get(urlAssistantsByCmp).then(response =>{
                this.assistantsByCmp = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        getAssistantInRecord : function(val) {
             if(val != null){
            var url = '/api/'+val.id+'/'+ this.event +'/get-user-recorded';
            axios.get(url).then(response =>{ 
               this.asistantsRegistered = response.data.assistant;
               //console.log('array get data '+this.asistantsRegistered);
                      
                      this.assistantSel = val
                        this.getPlans()
               
            }).catch(error => {
                this.errors = error.response.data
            });
            }else{
                    this.assistantSel = [];
                    this.planSel =      [];
                    this.hotelSel =     [];
                    this.roomSel =          0;
                    this.asistantsRegistered = [];
                }
        },
        selectPlanToUser : function(val) {
            this.getRecords();
            //console.log('hasta aqui el val normal '+val.id);
               
                    //console.log('val assistantReg: '+this.asistantsRegistered.id_assistant);
                    //console.log('val id: '+ val.id);
                        if(this.asistantsRegistered.id_assistant == val.id){

                            
                        }else{

                        }
                     
                
        },
        getPlans : function() {
            this.eventS = event
            var urlGetPlans = '/api/'+this.event+'/get-plans';
            axios.get(urlGetPlans).then(response =>{
                this.plans = response.data
                this.priceNegotiate = this.planSel.price
            });
        },
        getRoomTypes : function() {
            var url = '/api/get-room-types';
            axios.get(url).then(response =>{
                this.roomTypes = response.data
            });
        },
        planUserSelected : function(val) {
            if(val != null){
                if(this.asistantsRegistered != null){
                    if(this.asistantsRegistered.id_assistant != this.assistantSel.id){
                        this.planSel = val
                        this.getPlans();
                    }else{
                        toastr.warning('Este asistente ya se registro en este evento!');
                        this.planSel = [];
                    }
                }else{
                this.planSel = val
                this.getPlans();
                }
            }else{
                this.planSel =      [];
                this.hotelSel =     [];
                this.roomSel =          0;
            }    
        },
        newPlanF : function() {
            this.getCompanyStates()
            $('#newPlanModal').modal('show')
        },
        getCompanyStates : function() {
            var urlGetCompanyStates = '/api/get-company-states/';
            axios.get(urlGetCompanyStates).then(response =>{
                this.companyStates = response.data
                this.errors = []
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        createNewPlan : function(){
            var url = '/plans';
            axios.post(url, {
                plan:               this.newPlan,
                pl_desc:            this.newDescription,
                id_event:           this.eventSelects.id,
                price:              this.newPrice,
                id_company_state:   this.newCompanyState.id,
                academic_agenda:    this.new_academic_agenda,
                lunches:            this.new_lunches,
                refreshmen:         this.new_refreshmen,
                dinner:             this.new_dinner,    
                breakfast:          this.new_breakfast,
                host:               this.new_host,
            }).then(response => {
                this.getPlans();
                this.newPlan = '';
                this.newDescription = '';
                this.newCompanyState = '';
                this.newEvent = '';
                this.newPrice = '';
                this.new_academic_agenda = 1;
                this.new_lunches = 3;
                this.new_refreshmen = 4;
                this.new_dinner = 3;
                this.new_breakfast = '';
                this.new_host = '';
                this.errors = [];
                $('#newPlanModal').modal('hide')
                $('.modal-backdrop').remove();
                this.getPlans()
                toastr.success('Se ha creado un nuevo plan con exito!');
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        editPlanF : function (plan) {
            this.getCompanyStates();
            this.fillPlan.id = plan.id;
            this.fillPlan.plan = plan.plan;
            this.fillPlan.pl_desc = plan.pl_desc;
            this.fillPlan.event = plan.id_event;
            this.fillPlan.price = plan.price;
            this.fillPlan.id_company_state = plan.id_company_state;
            $('#editPlanModal').modal('show');
        },
        updatePlan : function (id) {
            var url = '/plans/'+id;
            axios.put(url, this.fillPlan).then(response =>{
                this.getPlans();
                this.fillPlan = {'id':'','plan':'','pl_description':'','id_company_state':'','price':''};
                this.errors = [];
                $('#editPlanModal').modal('hide');
                $('.modal-backdrop').remove();
                toastr.success('Plan actualizado, exitosamente!');
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        newCompany : function() {
            $('#new-record-modal').modal('hide');
            $('.modal-backdrop').remove();
            $('#new-company-modal').modal('show');
        },
        createNewCompany : function() {
            var url = '/companies';
            axios.post(url, {
                bs_name:            this.new_bs_name,
                acronym:            this.new_acronym,
                nit:                this.new_nit,
                web:                this.new_web,
                email:              this.new_email,
            }).then(response => {
                this.getCompanies();
                this.new_bs_name = '';
                this.new_acronym = '';
                this.new_nit = '';
                this.new_web = '';
                this.new_email = '';
                this.errors = [];
                $('#new-company-modal').modal('hide')
                $('.modal-backdrop').remove();
                toastr.success('Se ha creado una nueva Empresa con exito!');
                $('#new-record-modal').modal('show');
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        newContact : function() {
            $('#new-record-modal').modal('hide');
            $('.modal-backdrop').remove();
            $('#new-contact-modal').modal('show');
        },
        createNewContact : function() {
             var url = '/assistants';
            axios.post(url, {
                names:            this.new_names,
                last_names:       this.new_last_names,
                id_number:        this.new_id_number,
                id_city:          this.new_id_city.id,
                address:          this.new_address,
                tel:              this.new_tel,
                cel:              this.new_cel,
                position:         this.new_position,
                email:            this.new_email,
                id_company:       this.companySel.id,
            }).then(response => {
                this.getAssistantsByCmp(this.companySel.id);
                this.new_names = '';
                this.new_last_names = '';
                this.id_number = '';
                this.new_id_city = '';
                this.new_address = '';
                this.new_position = '';
                this.new_email = '';
                this.new_company = '';
                this.errors = [];
                $('#new-contact-modal').modal('hide');
                $('.modal-backdrop').remove();
                toastr.success('Se ha creado el contacto con exito con exito!');
                $('#new-record-modal').modal('show');
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        newHotelF : function() {
            $('#new-hotel-modal').modal('show')
        },
        createNewHotel : function() {
             var url = '/hotels';
            axios.post(url, {
                hotel_name:            this.new_hotel_name,
                id_city:               this.new_id_city.id,
                address:               this.new_address,
                email:                 this.new_email,
                web:                   this.new_web,
                stars:                 this.new_stars,
            }).then(response => {
                this.getHotels();
                this.new_hotel_name = '';
                this.new_id_city = '';
                this.new_address = '';
                this.new_email = '';
                this.new_web = '';
                this.new_stars = '';
                this.errors = [];
                $('#new-hotel-modal').modal('hide');
                $('.modal-backdrop').remove();
                toastr.success('Se ha creado el hotel con exito con exito!');
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        hotelUserSelected : function(val) {
            if(val != null){
                this.hotelSel = val;
                this.getDisponibleNights();
                //this.getRoomsByHotel(this.hotelSel.id);
            }else{
                this.hotelSel =         [];
                this.roomsByHotel =     [];
                this.disponibleNights = [];
            }    
        },
        getRoomsByHotel : function(hotel) {
            var url = '/api/'+ hotel +'/get-rooms-by-hotel/';
            axios.get(url).then(response =>{
                this.roomsByHotel = response.data
                this.errors = []
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        discountLunch : function() {
            this.planSel.lunches = this.planSel.lunches - 1;
        },
        addLunch : function() {
            this.planSel.lunches = this.planSel.lunches + 1;
        },
        discountAcademic_agenda : function() {
            this.planSel.academic_agenda = this.planSel.academic_agenda - 1;
        },
        addAcademic_agenda : function() {
            this.planSel.academic_agenda = this.planSel.academic_agenda + 1;
        },
        discountBreakfast : function() {
            this.planSel.breakfast = this.planSel.breakfast - 1;
        },
        addBreakfast : function() {
            this.planSel.breakfast = this.planSel.breakfast + 1;
        },
        discountDinner : function() {
            this.planSel.dinner = this.planSel.dinner - 1;
        },
        addDinner : function() {
            this.planSel.dinner = this.planSel.dinner + 1;
        },
        discountRefreshment : function() {
            this.planSel.refreshments = this.planSel.refreshments - 1;
        },
        addRefreshment : function() {
            this.planSel.refreshments = this.planSel.refreshments + 1;
        },
        addRoom : function() {
            $('#new-rooms-modal').modal('show');
        },
        createNewRooms : function() {
            if (this.rooms_cant > 0){
                if(this.id_hotel != ''){
                var url = '/rooms';
                axios.post(url, {
                    id_hotel:              this.hotelSelToRoom.id,
                    room_number:           this.rooms_cant,
                    }).then(response => {     
                 this.roomTypeSel = [];
                 this.hotelSelToRoom = [];
                 this.rooms_cant = 0;
                 this.getHotels();
                $('#new-rooms-modal').modal('hide');
                toastr.success('Se han asignado las Noches con exito!');
                    }).catch(error => {
                        this.errors = error.response.data
                    });
                }else{
                    toastr.warning('Debe seleccionar un hotel!');
                }}else{
                toastr.warning('Debe seleccionar una cantidad de Noches mayor que 0!');
            }
        },
        chooseRoom : function(val) {
            if(this.roomSel == 0 && this.roomSel != val){
                this.roomSel = val;
                var div = "#btn"+val;
                $( div ).removeClass( this.buttonSmDisRoom ).addClass( this.buttonSmDEnRoom );
            
                }else if(this.roomSel == val){
                    $( '#btn'+this.roomSel ).removeClass( this.buttonSmDEnRoom ).addClass( this.buttonSmDisRoom );
                    this.roomSel = 0;
                }else{
                    toastr.warning('Debe desvincular primero la habitacion seleccionada anteriormente');
                }
        },
        parseDate : function(input) {
        var parts = input.match(/(\d+)/g);
        // new Date(year, month [, date [, hours[, minutes[, seconds[, ms]]]]])
        return new Date(parts[0], parts[1]-1, parts[2]); // months are 0-based
        },
        setNights : function() {
            if(this.checkInDate != ''){
            var checkInDateP = this.parseDate(this.checkInDate);
            var checkOutDateP = this.parseDate(this.checkOutDate);
            var res = checkOutDateP.getTime() - checkInDateP.getTime();
            this.nightCant = res / 1000 / 60 / 60 / 24;
            this.nightCant = this.nightCant;
            }else{
                this.checkOutDate = '',
                toastr.warning('Primero debe seleccionar la fecha de llegada!');
            }
        },
        setAssRoomDoubleSet : function(val) {
            if(val != ''){
            this.assRoomDoubleSet = val;
            }else{
                this.assRoomDoubleSet = [];
            }
        },
        createRecordWthH : function() {
            if(this.roomTypeSel.id != 1){
            var newPriceNegotiate = this.priceNegotiate.replace(/\s/g, "") 
                newPriceNegotiate = newPriceNegotiate.replace("$", "");
                newPriceNegotiate = newPriceNegotiate.replace(".", "");
                 newPriceNegotiate = newPriceNegotiate.replace(",", "");
                newPriceNegotiate = newPriceNegotiate.replace("'", "");
                var url = '/api/'+ this.assistantSel.id +'/'+ this.eventSelects.id +'/'+ this.planSel.id +'/'+ this.new_academic_agenda+'/'+this.rooms_cant+'/'+this.hotelSel.id+'/'+ this.checkInDate +'/'+ this.checkOutDate +'/'+newPriceNegotiate+'/create-record/';
                axios.get(url).then(response =>{
                     toastr.success('Se registro el asistente '+this.assSel.names+' '+ this.assSel.last_names +' correctamente!');
                    this.companySel =       [];
                    this.assistantSel =     [];
                    this.planSel =          [];
                    this.hotelSel =         [];
                    this.assistantsByCmp =  [];
                    this.roomSel =          0;
                    this.checkInDate =      '';
                    this.checkOutDate =     '';
                    this.nightCant =        0;
                    this.disponibleNights=  [];
                    this.assRoomDoubleSet=  [];
                    this.roomTypeSel=       [];
                    this.errors = [];
                    this.getRecords();
                    $('#new-record-modal').modal('hide');
                    $('.modal-backdrop').remove();
                }).catch(error => {
                    this.errors = error.response.data
                });
            }else if(this.roomTypeSel.id == 1 && this.assRoomDoubleSet != ''){
            var newPriceNegotiate = this.priceNegotiate.replace(/\s/g, "") 
                newPriceNegotiate = newPriceNegotiate.replace("$", "");
                newPriceNegotiate = newPriceNegotiate.replace(".", "");
                newPriceNegotiate = newPriceNegotiate.replace(",", "");
                newPriceNegotiate = newPriceNegotiate.replace("'", "");
                console.log(this.assRoomDoubleSet.id)
                var url = '/api/'+ this.assistantSel.id +'/'+ this.eventSelects.id +'/'+ this.planSel.id +'/'+ this.new_academic_agenda +'/'+this.rooms_cant+'/'+this.hotelSel.id+'/'+ this.assRoomDoubleSet.id +'/'+ this.checkInDate +'/'+ this.checkOutDate +'/'+newPriceNegotiate+'/create-record-with-partner/';
                axios.get(url).then(response =>{
                    toastr.success('Se registro el asistente '+this.assistantSel.names+' '+ this.assistantSel.last_names +' y '+this.assRoomDoubleSet.names+' '+ this.assRoomDoubleSet.last_names +' correctamente!');
                    this.companySel =       [];
                    this.assistantSel =     [];
                    this.planSel =          [];
                    this.hotelSel =         [];
                    this.assistantsByCmp =  [];
                    this.roomSel =          0;
                    this.checkInDate =      '';
                    this.checkOutDate =     '';
                    this.nightCant =        0;
                    this.assRoomDoubleSet=  [];
                    this.disponibleNights=  [];
                    this.roomTypeSel=       [];
                    this.errors = [];
                    this.getRecords();
                    $('#new-record-modal').modal('hide');
                    $('.modal-backdrop').remove();
                    
                }).catch(error => {
                    this.errors = error.response.data
                });
            }else if(this.roomTypeSel == 1 && this.assRoomDoubleSet == ''){
                toastr.error('Su selecciona una habitacion doble, debe asignar un acompañante para esta habitacion!');
            }
        },
 
        createRecord : function() {
            var newPriceNegotiate = this.priceNegotiate.replace(/\s/g, "")
                newPriceNegotiate = newPriceNegotiate.replace("$", "");
                newPriceNegotiate = newPriceNegotiate.replace(".", "");
                newPriceNegotiate = newPriceNegotiate.replace(",", "");
                newPriceNegotiate = newPriceNegotiate.replace("'", "");
        var url = '/api/'+ this.assistantSel.id +'/'+ this.eventSelects.id +'/'+ this.planSel.id +'/'+ this.new_academic_agenda +'/'+newPriceNegotiate+'/create-record-no-hotel/';
            axios.get(url).then(response =>{
                toastr.success('Se registro el asistente '+this.assistantSel.names+' '+ this.assistantSel.last_names +' correctamente!');
                this.companySel =       [];
                this.assistantSel =     [];
                this.planSel =          [];
                this.hotelSel =         [];
                this.assistantsByCmp =  [];
                this.disponibleNights=  [];
                this.roomSel =          0;
                this.errors = [];
                this.getRecords();
                $('#new-record-modal').modal('hide');
                $('.modal-backdrop').remove();
                
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        saveRecord : function() {//star the check 
            if(this.companySel != ''){
                if(this.assistantSel != ''){
                    if(this.planSel != ''){
                        if(this.planSel.host == null ){
                            //toastr.success('tudo vem!');
                            this.createRecord();
                        }else if(this.hotelSel != '' && this.checkInDate != '' &&  this.checkOutDate != ''){
                            this.createRecordWthH();
                            }else{
                            toastr.error('Este registro cuenta con plan de hospedaje, debe elegir la fecha de ingreso, fecha de salida y numero de habitacion!');
                    }}else{
                        toastr.error('Debe seleccionar un plan');
                }}else{
                    toastr.error('Debe seleccionar una asistente');
            }}else{
                toastr.error('Debe seleccionar una empresa');
            }
        },
        setRegMode : function(val) {
            this.regMode = val;
        },
        getAssistantsByEvent : function() {
            
            var url = '/api/'+ this.event +'/get-assistants-by-event/';
            axios.get(url).then(response =>{
                this.assistantsByEvent = response.data
                this.errors = []
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        setEntry : function() {
            //console.log(this.recordSelectedOne[0].entry_moment)
                 if (this.recordSelectedOne[0].entry_moment == null){
                    var url = '/api/'+this.recordSelectedOne[0].id_assistant+'/'+this.event+'/entry';
                        axios.get(url).then(response =>{
                            toastr.success(this.recordSelectedOne[0].names+' '+this.recordSelectedOne[0].last_names+' se ha registrado correctamente ');
                            this.assistantsByEvent = [];
                            this.getAssistantsByEvent();
                            this.errors = [];
                            this.getAssRegistered();
                            this.assIdToReg = null
                        }).catch(error => {
                            this.errors = error.response.data
                        });
                 }else{
                    toastr.warning(this.recordSelectedOne[0].names+' '+this.recordSelectedOne[0].last_names+' se registro '+this.since(this.recordSelectedOne[0].entry_moment));
                    this.assIdToReg = null
                 }            
        },
        assistantRegistering : function() {
            var url2 = '/api/'+ this.assIdToReg +'/get-reg-by-assistant/';
            axios.get(url2).then(response =>{
                this.recordSelectedOne = response.data
                //console.log(this.recordSelectedOne[0].names)
                 this.setEntry();
                this.assIdToReg = null;
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        setRefMode : function(val) {
            this.refMode = val;
            this.assIdToReF = null
            $('#refBox').focus();
        },
        newRefModal : function() {
            $('#new-ref-modal').modal('show');
        },
        getAssistantRef : function() {
            var url = '/api/'+this.assIdToReF+'/'+this.refMode+'/get-ref-status-by-record';
            axios.get(url).then(response =>{
                this.refRecordStatus = response.data;
                this.errors = [];
                this.assistantRefRegistering(this.refRecordStatus,this.refMode);
            }).catch(error => {
                this.refRecordStatus = [];
                this.errors = error.response.data;
            });
        },
        assistantRefRegistering : function(val,refMode) {
            console.log("este es el alimento "+this.refRecordStatus.id)
                 if (val[refMode] == 0 || this.refMode == 'AgendaAcademica'){
                    var url = '/api/'+this.refRecordStatus.id+'/'+this.refMode+'/'+this.refRecordStatus.id+'/reg-ref';
                        axios.get(url).then(response =>{
                            this.assIdToReF = null
                            toastr.success(' se ha registrado este alimento correctamente correctamente ');
                            this.assistantsByEvent = [];
                            this.getAssistantsByEvent();
                            this.getTotalRef();
                            this.errors = [];
                            this.getAssRegistered();
                        }).catch(error => {
                            this.errors = error.response.data
                        });
                 }else if(val[refMode] == 1){
                    this.refRecordStatus = []
                    this.assIdToReF = null
                    toastr.warning('Usted ya reclamo este alimento!');
                 } else if(val[refMode] == 2){
                    this.assIdToReF = null
                    this.refRecordStatus = []
                    toastr.warning('Su plan no cuenta con este beneficio!');
                 }   
        },
        getObservationByRec : function(id_rec){
            console.log('se fue con este id rec '+id_rec)
            var url = '/api/'+id_rec+'/get-observation-rec';
            axios.get(url).then(response =>{
                this.observationsByRec = response.data;
                this.errors = [];
                //this.assistantRefRegistering();
            }).catch(error => {
                this.observationsByRec = [];
                this.errors = error.response.data;
            });
        },
        createObservationByRec : function(id_rec){
            if(this.observationByRec != ''){
            var url = '/reg_observation';
            axios.post(url, {
                obs:  this.observationByRec,
                id_record: id_rec
            }).then(response => {
                //this.observationByRec = '';
                this.getObservationByRec(id_rec);
                
                this.errors = [];
                toastr.success('Se ha creado la observacion con exito!');
            }).catch(error => {
                this.errors = error.response.data
            });
            }else{
                toastr.error('Debe ingresr una observacion!');
            }
          
        },
        getBillsByRec : function(id_rec){
            var url = '/api/'+id_rec+'/get-bills-rec';
            axios.get(url).then(response =>{
                this.billsEjectsByRecord = response.data;
                this.errors = [];
                //this.assistantRefRegistering();
            }).catch(error => {
                this.billsEjectsByRecord = [];
                this.errors = error.response.data;
            });
        },
        createBillDebitByRec : function(id_bill){
            if(this.billingValue != ''){
                if(this.billingNumber != ''){
            var url = '/billing_debits';
            axios.post(url, {
                debit_price:  this.billingValue,
                debit:  this.billingNumber,
                observation:    this.observationDebit,
                id_bill: id_bill
            }).then(response => {
                this.billingValue = '';
                this.billingNumber = '';
                this.observationDebit = '';
                this.getDebitsByRec(id_bill);
                
                this.errors = [];
                toastr.success('Se se registro el pago exitosamente!');
            }).catch(error => {
                this.errors = error.response.data
            });
            }else{
                toastr.error('Debe ingresr un numero de factura!');
            }}else{
                toastr.error('Debe ingresr un valor!');
            }
          
        },
        getDebitsByRec : function(id_bill){
            var url = '/api/'+id_bill+'/get-debits-rec';
            axios.get(url).then(response =>{
                this.debitsEjectByRecord = response.data;
                this.errors = [];
                //this.assistantRefRegistering();
            }).catch(error => {
                this.debitsEjectByRecord = [];
                this.errors = error.response.data;
            });
        },
        showDatatable : function(){
            if(this.isDatatable == null){
                this.isDatatable = 1
            }else{
                this.isDatatable = null
            }
        },
        setUpdateAssistantModal : function(id) {
            //console.log(`the id ${id}`)
            this.getAssitantData(id)
            this.isIdAssSelected = id
            $('#update-assistant-modal').modal('show')
        },
        setUpdateAlimentsModal : function(id) {
            console.log(`the record id ${id}`)
            //this.getAlimentsData(id)
            this.getRecordByAssistant(id)
            this.isIdAlimentsSelected = id
            $('#update-alimnets-modal').modal('show')
        },
        getAssitantData : function(id) {
            var url = '/api/'+id+'/get-assistant-update';
            axios.get(url).then(response =>{
                this.assistantUp = response.data;
                this.errors = [];
            }).catch(error => {
                this.assistantUp = [];
                this.errors = error.response.data;
            });
        },
        updateAssistant: function(id) {
            this.assistantUp.names = this.assistantUp.names.toUpperCase()
            this.assistantUp.last_names = this.assistantUp.last_names.toUpperCase()
            this.assistantUp.id_city = this.assistantUp.city.id
            this.assistantUp.id_company = this.assistantUp.bs_name.id
            //console.log(`el id de la ciudad es este: ${this.assistantUp.id_city}`)
            var url = '/api/assistants/' + id;
            //console.log(`the url are ${url}`)
            axios.put(url, this.assistantUp).then(response => {
                this.assistantUp = {
                    names:         '',
                    last_names:    '',
                    id_number:     '',
                    email:         '',
                    position:      '',
                    id_card:       '',
                    id_city:       '',
                    address:       '',
                    tel:           '',
                    cel:           '',
                    position:      '',
                    email:         '',
                    id_company:    '',
                };
                $('#update-assistant-modal').modal('hide');
                this.getAssistantsByEvent();
                toastr.success('Asistente actualizado con exito');
            }).catch(error =>{
                this.errors = error.response.data;
            });
        },
        getRecordByAssistant : function(id) {
            var url = '/api/'+ id +'/get-reg-by-record/';
            axios.get(url).then(response =>{
                this.rSelToLunch = response.data
                this.buttonLaunchedClases.Refrigeriodia1 = this.rSelToLunch[0].Refrigeriodia1 == 0 ? 'btn btn-secondary waves-effect waves-light' : this.rSelToLunch[0].Refrigeriodia1 == 1 ? 'btn btn-success waves-effect waves-light' : this.rSelToLunch[0].Refrigeriodia1 == 2 ? 'btn btn-danger waves-effect waves-light' : 'inherit'
                this.buttonLaunchedClases.Refrigeriodia2 = this.rSelToLunch[0].Refrigeriodia2 == 0 ? 'btn btn-secondary waves-effect waves-light' : this.rSelToLunch[0].Refrigeriodia2 == 1 ? 'btn btn-success waves-effect waves-light' : this.rSelToLunch[0].Refrigeriodia2 == 2 ? 'btn btn-danger waves-effect waves-light' : 'inherit'
                this.buttonLaunchedClases.Refrigeriodia3 = this.rSelToLunch[0].Refrigeriodia3 == 0 ? 'btn btn-secondary waves-effect waves-light' : this.rSelToLunch[0].Refrigeriodia3 == 1 ? 'btn btn-success waves-effect waves-light' : this.rSelToLunch[0].Refrigeriodia3 == 2 ? 'btn btn-danger waves-effect waves-light' : 'inherit'
                this.buttonLaunchedClases.Refrigeriodia4 = this.rSelToLunch[0].Refrigeriodia4 == 0 ? 'btn btn-secondary waves-effect waves-light' : this.rSelToLunch[0].Refrigeriodia4 == 1 ? 'btn btn-success waves-effect waves-light' : this.rSelToLunch[0].Refrigeriodia4 == 2 ? 'btn btn-danger waves-effect waves-light' : 'inherit'

                this.buttonLaunchedClases.Almuerzodia1 = this.rSelToLunch[0].Almuerzodia1 == 0 ? 'btn btn-secondary waves-effect waves-light' : this.rSelToLunch[0].Almuerzodia1 == 1 ? 'btn btn-success waves-effect waves-light' : this.rSelToLunch[0].Almuerzodia1 == 2 ? 'btn btn-danger waves-effect waves-light' : 'inherit'
                this.buttonLaunchedClases.Almuerzodia2 = this.rSelToLunch[0].Almuerzodia2 == 0 ? 'btn btn-secondary waves-effect waves-light' : this.rSelToLunch[0].Almuerzodia2 == 1 ? 'btn btn-success waves-effect waves-light' : this.rSelToLunch[0].Almuerzodia2 == 2 ? 'btn btn-danger waves-effect waves-light' : 'inherit'
                this.buttonLaunchedClases.Almuerzodia3 = this.rSelToLunch[0].Almuerzodia3 == 0 ? 'btn btn-secondary waves-effect waves-light' : this.rSelToLunch[0].Almuerzodia3 == 1 ? 'btn btn-success waves-effect waves-light' : this.rSelToLunch[0].Almuerzodia3 == 2 ? 'btn btn-danger waves-effect waves-light' : 'inherit'
            
                this.buttonLaunchedClases.Cenadia1 = this.rSelToLunch[0].Cenadia1 == 0 ? 'btn btn-secondary waves-effect waves-light' : this.rSelToLunch[0].Cenadia1 == 1 ? 'btn btn-success waves-effect waves-light' : this.rSelToLunch[0].Cenadia1 == 2 ? 'btn btn-danger waves-effect waves-light' : 'inherit'
                this.buttonLaunchedClases.Cenadia2 = this.rSelToLunch[0].Cenadia2 == 0 ? 'btn btn-secondary waves-effect waves-light' : this.rSelToLunch[0].Cenadia2 == 1 ? 'btn btn-success waves-effect waves-light' : this.rSelToLunch[0].Cenadia2 == 2 ? 'btn btn-danger waves-effect waves-light' : 'inherit'
                this.buttonLaunchedClases.Cenadia3 = this.rSelToLunch[0].Cenadia3 == 0 ? 'btn btn-secondary waves-effect waves-light' : this.rSelToLunch[0].Cenadia3 == 1 ? 'btn btn-success waves-effect waves-light' : this.rSelToLunch[0].Cenadia3 == 2 ? 'btn btn-danger waves-effect waves-light' : 'inherit'
       
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        changeLunchStatus : function(button) {
            //console.log(`the value of selected: ${this.rSelToLunch[0][button]}`)
            let selection = this.rSelToLunch[0][button] == 0 ? 1 : 0
            console.log(`the button selected! ${button} and the record id ${this.rSelToLunch[0].record_id}`)
            let url = '/api/records-lunch-update/' + this.rSelToLunch[0].record_id + '/' + button + '/' + selection
            axios.get(url).then(response => {
                this.getRecordByAssistant(this.rSelToLunch[0].record_id)
            }).catch(error => {
                this.errors = error.response.data
                console.log(`ooops thats an error like this: ${error.resoonse.data}`)
            });
        }

    }
}
</script>