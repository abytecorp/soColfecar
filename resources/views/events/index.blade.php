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

             <create-event>
             </create-event>
             <button class="tst1 btn btn-info">Info Message</button>   

                <h4 class="card-title">Eventos  </h4>
                <h6 class="card-subtitle">Eventos Colfecar.</h6>
                
                <div class="table-responsive table-hover">
                        {!! Form::open(['route' => ['events.create'], 'method' => 'GET']) !!}
                        <button type="submit" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Nuevo Evento</button>
                        {!! Form::close() !!}
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Evento</th>
                                <th>Ver</th>
                                <th>Editar</th>
                                <th>Estado</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                            <tr data-id="{{$event->id}}">
                            <td>
                                
                                <a href="#">{{$event->event}}</a>
                                
                            </td>
                            <td>
                                    {!! Form::open(['route' => ['events.show', $event->id], 'method' => 'GET']) !!}
                                <button type="submit"  class="btn waves-effect waves-light btn-sm btn-success" >Ver</button>
                                    {!! Form::close() !!}
                            </td>
                            <td>
                                    {!! Form::open(['route' => ['events.edit', $event->id], 'method' => 'GET']) !!}
                                <button type="submit" class="btn waves-effect waves-light btn-sm btn-success" >Editar</button>
                                    {!! Form::close() !!}
                            </td>
                            <td>
                                    {!! Form::open(['route' => ['events.destroy', $event->id], 'method' => 'DELETE']) !!}
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
