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

                

                <h4 class="card-title">Tipos de empresa  </h4>
                <h6 class="card-subtitle">Configuracion de tipos de empresas para uso del modulo de afiliaciones en el sistema.</h6>
                
                <div class="table-responsive table-hover">
                        {!! Form::open(['route' => ['company_types.create'], 'method' => 'GET']) !!}
                        <button type="submit" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Crea un nuevo Tipo</button>
                        {!! Form::close() !!}
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tipo de empresa</th>
                                <th>Ver</th>
                                <th>Editar</th>
                                <th>Eliminar</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($company_types as $company_type)
                            <tr data-id="{{$company_type->id}}">
                            <td>
                                
                                <a href="#">{{$company_type->company_type}}</a>
                                
                            </td>
                            <td>
                                    {!! Form::open(['route' => ['company_types.show', $company_type->id], 'method' => 'GET']) !!}
                                <button type="submit"  class="btn waves-effect waves-light btn-sm btn-success" >Ver</button>
                                    {!! Form::close() !!}
                            </td>
                            <td>
                                    {!! Form::open(['route' => ['company_types.edit', $company_type->id], 'method' => 'GET']) !!}
                                <button type="submit" class="btn waves-effect waves-light btn-sm btn-success" >Editar</button>
                                    {!! Form::close() !!}
                            </td>
                            <td>
                                    {!! Form::open(['route' => ['company_types.destroy', $company_type->id], 'method' => 'DELETE']) !!}
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
