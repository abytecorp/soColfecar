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

                

                <h4 class="card-title">Estados de empresa  </h4>
                <h6 class="card-subtitle">Configuracion de estados de empresas para uso del modulo de afiliaciones en el sistema.</h6>
                
                <div class="table-responsive table-hover">
                        {!! Form::open(['route' => ['company_states.create'], 'method' => 'GET']) !!}
                        <button type="submit" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Crea un nuevo Estado</button>
                        {!! Form::close() !!}
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Estado de empresa</th>
                                <th>Ver</th>
                                <th>Editar</th>
                                <th>Eliminar</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($company_states as $company_state)
                            <tr data-id="{{$company_state->id}}">
                            <td>
                                
                                <a href="#">{{$company_state->company_state}}</a>
                                
                            </td>
                            <td>
                                    {!! Form::open(['route' => ['company_states.show', $company_state->id], 'method' => 'GET']) !!}
                                <button type="submit"  class="btn waves-effect waves-light btn-sm btn-success" >Ver</button>
                                    {!! Form::close() !!}
                            </td>
                            <td>
                                    {!! Form::open(['route' => ['company_states.edit', $company_state->id], 'method' => 'GET']) !!}
                                <button type="submit" class="btn waves-effect waves-light btn-sm btn-success" >Editar</button>
                                    {!! Form::close() !!}
                            </td>
                            <td>
                                    {!! Form::open(['route' => ['company_states.destroy', $company_state->id], 'method' => 'DELETE']) !!}
                                <button type="submit" class="btn waves-effect waves-light btn-sm btn-success" >Eliminar</button>
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
