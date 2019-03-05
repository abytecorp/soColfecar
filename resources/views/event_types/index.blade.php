@extends('layouts.app')
@section('content')

<div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">

@include('layouts.title')



<div class="col-12">

        <div class="card">

            <div class="card-body ">

                

                <h4 class="card-title">Tipos de eventos  </h4>
                <h6 class="card-subtitle">Configuracion de tipos de eventos para uso del modulo de Divulgacion en el sistema.</h6>
                
                <div class="table-responsive table-hover">
                        {!! Form::open(['route' => ['event_types.create'], 'method' => 'GET']) !!}
                        <button type="submit" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Crea un nuevo Tipo de evento</button>
                        {!! Form::close() !!}
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tipo de Evento</th>
                                <th>Ver</th>
                                <th>Editar</th>
                                <th>Eliminar</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($event_types as $event_type)
                            <tr data-id="{{$event_type->id}}">
                            <td>
                                
                                <a href="#">{{$event_type->event_type}}</a>
                                
                            </td>
                            <td>
                                    {!! Form::open(['route' => ['event_types.show', $event_type->id], 'method' => 'GET']) !!}
                                <button type="submit"  class="btn waves-effect waves-light btn-sm btn-success" >Ver</button>
                                    {!! Form::close() !!}
                            </td>
                            <td>
                                    {!! Form::open(['route' => ['event_types.edit', $event_type->id], 'method' => 'GET']) !!}
                                <button type="submit" class="btn waves-effect waves-light btn-sm btn-success" >Editar</button>
                                    {!! Form::close() !!}
                            </td>
                            <td>
                                    {!! Form::open(['route' => ['event_types.destroy', $event_type->id], 'method' => 'DELETE']) !!}
                                <button type="submit" class="btn waves-effect waves-light btn-sm btn-success" >Activar/Desactivar</button>
                                    {!! Form::close() !!}
                            </td>

                        @endforeach
                                
                            </tr>

                        </tbody>
                    </table>
                    {{-- {{ $roles->render() }} --}}
                </div>
            </div>
        </div>
    </div>
    <!-- column -->

</div>
</div>
@endsection
