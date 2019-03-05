@extends('layouts.appDat')
@section('content')

<div class="page-wrapper">
    
@include('layouts.title')

@if($errors->any())
<div id="error-box">
    <!-- Display errors here -->
</div>
@endif
<div class="row">
    <div class="col-12">
            <div id="tabless">
            </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Export</h4>
                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                <div class="table-responsive m-t-40">
                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Id </th>
                                <th>Nombre </th>
                                <th>Mail </th>
                                <th>Empresa</th>
                                <th>Afiliado</th>
                                <th>Plan</th>
                                <th>Valor Negociado</th>
                                <th>Valor Facturado</th>
                                <th>Refrigerio 1</th>
                                <th>Refrigerio 2</th>
                                <th>Refrigerio 3</th>
                                <th>Refrigerio 4</th>
                                <th>Almuerzo 1</th>
                                <th>Almuerzo 2</th>
                                <th>Almuerzo 3</th>
                                <th>Cena 1</th>
                                <th>Cena 2</th>
                                <th>Cena 3</th>
                                <th>Observaciones</th>
                                <th>Impreso</th>
                                <th>Borrar</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Mail </th>
                                <th>Empresa</th>
                                <th>Afiliado</th>
                                <th>Plan</th>
                                <th>Valor Negociado</th>
                                <th>Valor Facturado</th>
                                <th>Refrigerio 1</th>
                                <th>Refrigerio 2</th>
                                <th>Refrigerio 3</th>
                                <th>Refrigerio 4</th>
                                <th>Almuerzo 1</th>
                                <th>Almuerzo 2</th>
                                <th>Almuerzo 3</th>
                                <th>Cena 1</th>
                                <th>Cena 2</th>
                                <th>Cena 3</th>
                                <th>Observaciones</th>
                                <th>Impreso</th>
                                <th>Borrar</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($records as $record)
                            <tr>
                                    <th>{{$record->id_r}}</th>
                                    <th><a href="#" data-toggle="modal" data-target="#modUpAss" data-names="{{$record->names}}"
                                            data-last_names="{{$record->last_names}}" data-id_type="{{$record->id_type}}"
                                            data-id_number="{{$record->id_number}}" data-id_city="{{$record->id_city}}" 
                                            data-address="{{$record->address}}" data-tel="{{$record->tel}}"
                                            data-cel="{{$record->cel}}" data-position="{{$record->position}}"
                                            data-email="{{$record->email}}" data-id_company="{{$record->id_company}}" data-assistant_id="{{$record->id_assistant}}"> 
                                            {{ $record->names.' '.$record->last_names.' ( '.$record->id_number.' )' }}
                                        </a>
                                    </th>
                                    <th>{{ $record->email }}</th>
                                    <th>{{ $record->bs_name.' ( '.$record->nit.' )' }}</th>
                                    <th>{{ $record->id_cmp_state }}</th>
                                    <th><a href="#" data-toggle="modal" data-target="#modUpPlan" data-id_plan="{{ $record->id_plan }}" data-id_record="{{ $record->id_r }}" >{{ $record->plan  }} ( {{ $record->pl_desc }} )</a></th>
                                    <th><a href="#" data-toggle="modal" data-target="#modUpBillPrice" data-bill_price="{{ $record->bill_price }}" data-bill_id="{{ $record->bill_id }}" >{{ '$ '.number_format($record->bill_price,2) }}</a></th>
                                    <th>Valor Facturado</th>
                                <th> 
                                    @if($record->Refrigeriodia1 == 0)
                                        <button type="button" class="btn btn-primary" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Refrigeriodia1" data-id_record="{{ $record->id_r }}">
                                        <i class="fa fa-check"></i>Sin Reclamar</button>
                                    @elseif($record->Refrigeriodia1 == 2)
                                        <button type="button" class="btn btn-secondary" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Refrigeriodia1" data-id_record="{{ $record->id_r }}">
                                        <i class="fa fa-check"></i> Sin Asignar</button>
                                    @elseif($record->Refrigeriodia1 == 1)
                                        <button type="button" class="btn btn-success" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Refrigeriodia1" data-id_record="{{ $record->id_r }}">
                                            <i class="fa fa-check"></i>  Reclamado </button>
                                    @endif
                                </th>
                                <th>
                                    @if($record->Refrigeriodia2 == 0)
                                        <button type="button" class="btn btn-primary" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Refrigeriodia2" data-id_record="{{ $record->id_r }}">
                                        <i class="fa fa-check"></i>Sin Reclamar</button>
                                    @elseif($record->Refrigeriodia2 == 2)
                                        <button type="button" class="btn btn-secondary" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Refrigeriodia2" data-id_record="{{ $record->id_r }}">
                                        <i class="fa fa-check"></i> Sin Asignar</button>
                                    @elseif($record->Refrigeriodia2 == 1)
                                        <button type="button" class="btn btn-success" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Refrigeriodia2" data-id_record="{{ $record->id_r }}">
                                            <i class="fa fa-check"></i>  Reclamado </button>
                                    @endif
                                </th>
                                <th>
                                    @if($record->Refrigeriodia3 == 0)
                                        <button type="button" class="btn btn-primary" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Refrigeriodia3" data-id_record="{{ $record->id_r }}">
                                        <i class="fa fa-check"></i>Sin Reclamar</button>
                                    @elseif($record->Refrigeriodia3 == 2)
                                        <button type="button" class="btn btn-secondary" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Refrigeriodia3" data-id_record="{{ $record->id_r }}">
                                        <i class="fa fa-check"></i> Sin Asignar</button>
                                    @elseif($record->Refrigeriodia3 == 1)
                                        <button type="button" class="btn btn-success" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Refrigeriodia3" data-id_record="{{ $record->id_r }}">
                                            <i class="fa fa-check"></i>  Reclamado </button>
                                    @endif
                                </th>
                                <th>
                                    @if($record->Refrigeriodia4 == 0)
                                        <button type="button" class="btn btn-primary" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Refrigeriodia4" data-id_record="{{ $record->id_r }}">
                                        <i class="fa fa-check"></i>Sin Reclamar</button>
                                    @elseif($record->Refrigeriodia4 == 2)
                                        <button type="button" class="btn btn-secondary" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Refrigeriodia4" data-id_record="{{ $record->id_r }}">
                                        <i class="fa fa-check"></i> Sin Asignar</button>
                                    @elseif($record->Refrigeriodia4 == 1)
                                        <button type="button" class="btn btn-success" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Refrigeriodia4" data-id_record="{{ $record->id_r }}">
                                            <i class="fa fa-check"></i>  Reclamado </button>
                                    @endif
                                </th>
                                <th>
                                    @if($record->Almuerzodia1 == 0)
                                        <button type="button" class="btn btn-primary" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Almuerzodia1" data-id_record="{{ $record->id_r }}">
                                        <i class="fa fa-check"></i>Sin Reclamar</button>
                                    @elseif($record->Almuerzodia1 == 2)
                                        <button type="button" class="btn btn-secondary" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Almuerzodia1" data-id_record="{{ $record->id_r }}">
                                        <i class="fa fa-check"></i> Sin Asignar</button>
                                    @elseif($record->Almuerzodia1 == 1)
                                        <button type="button" class="btn btn-success" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Almuerzodia1" data-id_record="{{ $record->id_r }}">
                                            <i class="fa fa-check"></i>  Reclamado </button>
                                    @endif
                                </th>
                                <th>
                                    @if($record->Almuerzodia2 == 0)
                                        <button type="button" class="btn btn-primary" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Almuerzodia2" data-id_record="{{ $record->id_r }}">
                                        <i class="fa fa-check"></i>Sin Reclamar</button>
                                    @elseif($record->Almuerzodia2 == 2)
                                        <button type="button" class="btn btn-secondary" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Almuerzodia2" data-id_record="{{ $record->id_r }}">
                                        <i class="fa fa-check"></i> Sin Asignar</button>
                                    @elseif($record->Almuerzodia2 == 1)
                                        <button type="button" class="btn btn-success" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Almuerzodia2" data-id_record="{{ $record->id_r }}">
                                            <i class="fa fa-check"></i>  Reclamado </button>
                                    @endif
                                </th>
                                <th>
                                    @if($record->Almuerzodia3 == 0)
                                        <button type="button" class="btn btn-primary" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Almuerzodia3" data-id_record="{{ $record->id_r }}">
                                        <i class="fa fa-check"></i>Sin Reclamar</button>
                                    @elseif($record->Almuerzodia3 == 2)
                                        <button type="button" class="btn btn-secondary" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Almuerzodia3" data-id_record="{{ $record->id_r }}">
                                        <i class="fa fa-check"></i> Sin Asignar</button>
                                    @elseif($record->Almuerzodia3 == 1)
                                        <button type="button" class="btn btn-success" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Almuerzodia3" data-id_record="{{ $record->id_r }}">
                                            <i class="fa fa-check"></i>  Reclamado </button>
                                    @endif
                                </th>
                                <th>
                                    @if($record->Cenadia1 == 0)
                                        <button type="button" class="btn btn-primary" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Cenadia1" data-id_record="{{ $record->id_r }}">
                                        <i class="fa fa-check"></i>Sin Reclamar</button>
                                    @elseif($record->Cenadia1 == 2)
                                        <button type="button" class="btn btn-secondary" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Cenadia1" data-id_record="{{ $record->id_r }}">
                                        <i class="fa fa-check"></i> Sin Asignar</button>
                                    @elseif($record->Cenadia1 == 1)
                                        <button type="button" class="btn btn-success" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Cenadia1" data-id_record="{{ $record->id_r }}">
                                            <i class="fa fa-check"></i>  Reclamado </button>
                                    @endif
                                </th>
                                <th>
                                    @if($record->Cenadia2 == 0)
                                        <button type="button" class="btn btn-primary" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Cenadia2" data-id_record="{{ $record->id_r }}">
                                        <i class="fa fa-check"></i>Sin Reclamar</button>
                                    @elseif($record->Cenadia2 == 2)
                                        <button type="button" class="btn btn-secondary" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Cenadia2" data-id_record="{{ $record->id_r }}">
                                        <i class="fa fa-check"></i> Sin Asignar</button>
                                    @elseif($record->Cenadia2 == 1)
                                        <button type="button" class="btn btn-success" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Cenadia2" data-id_record="{{ $record->id_r }}">
                                            <i class="fa fa-check"></i>  Reclamado </button>
                                    @endif
                                </th>
                                <th>
                                    @if($record->Cenadia3 == 0)
                                        <button type="button" class="btn btn-primary" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Cenadia3" data-id_record="{{ $record->id_r }}">
                                        <i class="fa fa-check"></i>Sin Reclamar</button>
                                    @elseif($record->Cenadia3 == 2)
                                        <button type="button" class="btn btn-secondary" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Cenadia3" data-id_record="{{ $record->id_r }}">
                                        <i class="fa fa-check"></i> Sin Asignar</button>
                                    @elseif($record->Cenadia3 == 1)
                                        <button type="button" class="btn btn-success" 
                                        data-toggle="modal" data-target="#modRef" data-ref="Cenadia3" data-id_record="{{ $record->id_r }}">
                                            <i class="fa fa-check"></i>  Reclamado </button>
                                    @endif
                                </th>
                                <th>
                                     <button type="button" class="btn btn-success" 
                                        data-toggle="modal" data-target="#modObs" data-ref="Cenadia3" data-id_record="{{ $record->id_r }}">
                                            <i class="fa fa-check"></i>  Agregar Observacion </button>
                                </th>
                                <th>{{ $record->id_status_gafete  }}</th>
                                <th>
                                        <button type="button" class="btn btn-danger" 
                                        data-toggle="modal" data-target="#modDel" data-names="{{$record->names}}"
                                        data-last_names="{{$record->last_names}}" data-id_record="{{ $record->id_r }}">
                                            <i class="fa fa-check"></i>  Eliminar </button>
                                </th>
                            </tr>
                            @endforeach
                           

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




{{-- </div> --}}
{{-- </div> --}}


    <!-- /.MODAL observaciones -->
    <div id="modObs" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                        
            <div class="card card-body">
               
                <p class="text-muted m-b-30 font-13" id="title">  </p>
                <h4 class="modal-title" id="myLargeModalLabel"></h4>
                <div class="row">
                <div class="col-sm-12 col-xs-12">
                <form action="/reg_observation" method="post">
                        {{ csrf_field() }}
                    <input type="hidden" name="id_record" id="id_record" value="">
                    <textarea class="form-control" name="obs" id="obs" rows="5" ></textarea>
                    
                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-nw-usr">Agregar </button>
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Cancelar</button>
                </form>
                </div>
                </div>
            </div>

                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>

    <!-- /.MODAL Refrigerio1 -->
    <div id="modDel" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                            
                <div class="card card-body">
                   
                    <p class="text-muted m-b-30 font-13" id="title">  </p>
                    <h4 class="modal-title" id="myLargeModalLabel"></h4>
                    <div class="row">
                    <div class="col-sm-12 col-xs-12">
                    <form action="{{ route('del-reg.update', 44) }}" method="post">
                            {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <input type="hidden" name="id_r" id="id_r" value="">
                        
                        <button type="submit" class="btn btn-danger waves-effect waves-light m-r-10" id="btn-nw-usr">Eliminar Registro</button>
                        <button type="button" class="btn btn-success waves-effect text-left" data-dismiss="modal">Cancelar</button>
                    </form>
                    </div>
                    </div>
                </div>
    
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
    </div>


    <!-- /.MODAL Refrigerio1 -->
    <div id="modRef" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                            
                <div class="card card-body">
                   
                    <p class="text-muted m-b-30 font-13" id="title">  </p>
                    <h4 class="modal-title" id="myLargeModalLabel"></h4>
                    <div class="row">
                    <div class="col-sm-12 col-xs-12">
                    <form action="{{ route('update-ref.update', 44) }}" method="post">
                            {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <input type="hidden" name="id_r" id="id_r" value="">
                        <input type="hidden" name="ref" id="ref" value="">
                        <div class="col-md-4">
                                <h5 class="m-t-30 m-b-10">Seleccione estado</h5>
                                <select class="selectpicker" data-style="form-control btn-secondary" id="status" name="status">
                                    <option value='0'>Sin reclamar</option>
                                    <option value='2'>Sin asignar</option>
                                </select>
                        </div>
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-nw-usr">Guardar</button>
                    </form>
                    </div>
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



    <!-- /.MODAL updtae assistant -->
    <div id="modUpAss" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Actualizar datos de asistente</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                            
                <div class="card card-body">
                    <h3 class="box-title m-b-0">Editar Datos Del Asistente</h3>
                    <p class="text-muted m-b-30 font-13"> Formulario de actualizacion de datos para asistentes. </p>
                    <div class="row">
                    <div class="col-sm-12 col-xs-12">
                    <form action="{{ route('assistantEvents.update', 44) }}" method="post">
                            {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <input type="hidden" name="id_assistant" id="id_assistant" value="">
                        @include('assistants.partials.formUp')
                    </form>
                    </div>
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


    <!-- /.MODAL updtae bill price -->
    <div id="modUpBillPrice" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Actualizar Valor negociado</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                            
                <div class="card card-body">
                    <h3 class="box-title m-b-0">Editar valor negociado</h3>
                    <p class="text-muted m-b-30 font-13"> Formulario de actualizacion de valor negociado. </p>
                    <div class="row">
                    <div class="col-sm-12 col-xs-12">
                    <form action="{{ route('update-bill-price.update', 44) }}" method="post">
                            {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <input type="hidden" name="bill_id" id="bill_id" value="">
                        <input type="text" name="bill_price" id="bill_price">
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-nw-usr">Guardar</button>
                    </form>
                    </div>
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



        <!-- /.MODAL update plan -->
        <div id="modUpPlan" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content text-center">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Actualizar plan del asistente </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                                
                    <div class="card card-body">
                        <h3 class="box-title m-b-0">Editar Datos Del plan</h3>
                        <p class="text-muted m-b-30 font-13"> Formulario de actualizacion de datos para asistentes. </p>
                        <div class="row">
                        <div class="col-sm-12 col-xs-12">
                        <form action="{{ route('update-plan-record.update','test') }}" method="post">
                                {{ csrf_field() }}
                            {{ method_field('patch') }}
                            <input type="hidden" name="id_record" id="id_record" value="">
                            <div class="form-group @if ($errors->has('id_company')) has-danger @endif">
                                    <h6 class="m-t-30 m-b-10">Seleccione el plan. (*)</h6>
                                    <select name="id_plan" id="id_plan"  class="select2 form-control custom-select" style="width: 40%; height:36px;">
                                            <option id="imput"></option>
                                        @foreach ($plans as $plan)
                                            <option value="{{ $plan->id }}">{{ $plan->plan.' ( '.$plan->pl_desc.' ) ' }}</option>
                                        @endforeach
                                    </select>
                                @if ($errors->has('id_plan'))
                                    @foreach ($errors->get('id_plan') as $error)
                                        <div class="form-control-feedback">{{ $error }}</div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-nw-usr">Guardar</button>
                        </form>
                        </div>
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


@section('script')
{{-- code --}}
<script src="{{ asset('node_modules/datatables/jquery.dataTables.min.js') }}"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<!-- end - This is for export functionality only -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
$(document).ready(function() {
    $('#myTable').DataTable();
    $(document).ready(function() {
        var table = $('#example').DataTable({
            "columnDefs": [{
                "visible": false,
                "targets": 2
            }],
            "order": [
                [2, 'asc']
            ],
            "displayLength": 25,
            "drawCallback": function(settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;
                api.column(2, {
                    page: 'current'
                }).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                        last = group;
                    }
                });
            }
        });
        // Order by the grouping
        $('#example tbody').on('click', 'tr.group', function() {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                table.order([2, 'desc']).draw();
            } else {
                table.order([2, 'asc']).draw();
            }
        });
    });
});
$('#example23').DataTable({
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
});


</script>
   
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">

$('#modUpAss').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 


  
  var names = button.data('names')
  var last_names = button.data('last_names')
  var id_type = button.data('id_type')
  var id_number = button.data('id_number')
  var id_city = button.data('id_city')
  var address = button.data('address')
  var tel = button.data('tel')
  var cel = button.data('cel')
  var position = button.data('position')
  var email = button.data('email')
  var id_company = button.data('id_company')
  var id_assistant = button.data('assistant_id')
  
  var id_company = button.data('id_company')
 console.log(id_company)

  var modal = $(this)


modal.find('.modal-body #imputNames').val('')
  modal.find('.modal-body #imputLastNames').val('')
  modal.find('.modal-body #selectIdType').val('')
  modal.find('.modal-body #imputIdNumber').val('')
  modal.find('.modal-body #id_city').val('')
  modal.find('.modal-body #imputSddress').val('')
  modal.find('.modal-body #imputTel').val('')
  modal.find('.modal-body #imputCel').val('')
  modal.find('.modal-body #imputPosition').val('')
  modal.find('.modal-body #imputEmail').val('')
  modal.find('.modal-body #id_company').val('')
  modal.find('.modal-body #id_assistant').val('')

  modal.find('.modal-body #imputNames').val(names)
  modal.find('.modal-body #imputLastNames').val(last_names)
  modal.find('.modal-body #selectIdType').val(id_type)
  modal.find('.modal-body #imputIdNumber').val(id_number)
  modal.find('.modal-body #id_city').val(id_city)
  modal.find('.modal-body #address').val(address)
  modal.find('.modal-body #imputTel').val(tel)
  modal.find('.modal-body #imputCel').val(cel)
  modal.find('.modal-body #imputPosition').val(position)
  modal.find('.modal-body #imputEmail').val(email)
  modal.find('.modal-body #id_company').val(id_company)
  modal.find('.modal-body #id_assistant').val(id_assistant)
})

$('#modUpPlan').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 

  
  var id_plan = button.data('id_plan')
  var id_record = button.data('id_record')

  

 //console.log(id_company)

  var modal = $(this)


modal.find('.modal-body #id_plan').val('')
modal.find('.modal-body #id_record').val('')


modal.find('.modal-body #id_plan').val(id_plan)
modal.find('.modal-body #id_record').val(id_record)

})


$('#modUpBillPrice').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 

  
  var bill_id = button.data('bill_id')
  var bill_price = button.data('bill_price')

  

 //console.log(id_company)

  var modal = $(this)


modal.find('.modal-body #bill_id').val('')
modal.find('.modal-body #bill_price').val('')


modal.find('.modal-body #bill_id').val(bill_id)
modal.find('.modal-body #bill_price').val(bill_price)

})

$('#modRef').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 

  
  var ref = button.data('ref')
  var id_record = button.data('id_record')

  

 console.log(ref)
 console.log(id_record)


  var modal = $(this)


modal.find('.modal-body #ref').val('')
modal.find('.modal-body #bill_price').val('')
modal.find('.modal-body #title').val('')
modal.find('.modal-body #myLargeModalLabel').val('')


modal.find('.modal-body #ref').val(ref)
modal.find('.modal-body #id_r').val(id_record)
modal.find('.modal-body #title').val(ref)
modal.find('.modal-body #myLargeModalLabel').val(ref)


})

$('#modDel').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 

  

  var id_record = button.data('id_record')

  

 console.log(ref)
 console.log(id_record)


  var modal = $(this)



modal.find('.modal-body #title').val('')
modal.find('.modal-body #myLargeModalLabel').val('')

modal.find('.modal-body #id_r').val(id_record)

})

$('#modObs').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 

  

  var id_record = button.data('id_record')

  

 console.log(ref)
 console.log(id_record)


  var modal = $(this)



modal.find('.modal-body #title').val('')
modal.find('.modal-body #myLargeModalLabel').val('')



modal.find('.modal-body #id_record').val(id_record)


})

    </script>
@if ($errors->any())
<script>
$(document).ready(function() {
    $('#modUpAss').modal('show')
});
</script>

@endif
@endsection
@endsection
