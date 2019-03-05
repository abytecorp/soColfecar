@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="container-fluid">

@include('layouts.title')

<div id="row">
<h2>Que deseas hacer?</h2>
</div>

<div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Ingresar Contactos</h4>
                    <p class="card-text">En esta seccion podra ingresar los contacos de la empresa, su informacion y asignar cargos.</p>
                    {!! Form::open(['route' => ['assistants.createWt', $company->id], 'method' => 'GET']) !!}
                    <button type="submit"  class="btn btn-primary">Ingresar</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h4 class="card-title">Validar los datos de la Empresa</h4>
                    <p class="card-text">Aqui podra ingresar la informacion de ubiccion y contacto de la compa;ia.</p>
                    {!! Form::open(['route' => ['affiliations.show', $company->id], 'method' => 'GET']) !!}
                    <button type="submit"  class="btn btn-primary">Ingresar</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-right">
                <div class="card-body">
                    <h4 class="card-title">Ingresar una nueva Empresa</h4>
                    <p class="card-text">Registre los datos de una nueva Empresa.</p>
                    {!! Form::open(['route' => ['affiliations.create'], 'method' => 'GET']) !!}
                    <button type="submit"  class="btn btn-primary">Ingresar</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

@endsection
