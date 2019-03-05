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

                

                <h4 class="card-title">Tipos de identificacion  </h4>
                <h6 class="card-subtitle">Configuracion de tipos de identificacion para uso del modulo de Divulgacion en el sistema.</h6>
                
                <div class="table-responsive table-hover">
                        {!! Form::open(['route' => ['plans.create'], 'method' => 'GET']) !!}
                        <button type="submit" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Crea un nuevo Tipo de ido</button>
                        {!! Form::close() !!}
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tipo de identificacion</th>
                                <th>Ver</th>
                                <th>Editar</th>
                                <th>Eliminar</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($plans as $plan)
                            <tr data-id="{{$plan->id}}">
                            <td>
                                
                                <a href="#">{{$plan->plan}}</a>
                                
                            </td>
                            <td>
                                    {!! Form::open(['route' => ['plans.show', $plan->id], 'method' => 'GET']) !!}
                                <button type="submit"  class="btn waves-effect waves-light btn-sm btn-success" >Ver</button>
                                    {!! Form::close() !!}
                            </td>
                            <td>
                                    {!! Form::open(['route' => ['plans.edit', $plan->id], 'method' => 'GET']) !!}
                                <button type="submit" class="btn waves-effect waves-light btn-sm btn-success" >Editar</button>
                                    {!! Form::close() !!}
                            </td>
                            <td>
                                    {!! Form::open(['route' => ['plans.destroy', $plan->id], 'method' => 'DELETE']) !!}
                                <button type="submit" class="btn waves-effect waves-light btn-sm btn-success" >Activar/Desactivar</button>
                                    {!! Form::close() !!}
                            </td>

                        @endforeach
                                
                            </tr>

                        </tbody>
                    </table>
                    {{ $plans->render() }}
                </div>
            </div>
        </div>
    </div>
    <!-- column -->

</div>
</div>
@endsection
