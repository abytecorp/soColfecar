<div class="form-group @if ($errors->has('plan')) has-danger @endif">
        {!! Form::label('planName', 'Nombre del Plan', ['class' => '']) !!}
        {!! Form::text('plan', null,['class'=>'form-control', 'placeholder' => 'Nombre del Plan', 'id'=>'planName']) !!}
        @if ($errors->has('plan'))
            @foreach ($errors->get('plan') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>
<div class="form-group @if ($errors->has('description')) has-danger @endif">
        {!! Form::label('idTypeDescription', 'Descripcion', ['class' => '']) !!}
        {!! Form::textarea('description', null,['class'=>'form-control', 'placeholder' => 'Detalles del plan', 'id'=>'idTypeDescription']) !!}
        @if ($errors->has('description'))
            @foreach ($errors->get('description') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>

<div class="form-group @if ($errors->has('id_event')) has-danger @endif">
    <h6 class="m-t-30 m-b-10">Seleccione un evento </h6>
    <select name="id_event" aria-placeholder="Seleccione una Evento" class="select2 form-control custom-select" style="width: 40%; height:36px;">
            <option id="" ></option>
        @foreach ($events as $event)
            <option value="{{ $event->id }}">{{ $event->event }}</option>
        @endforeach
    </select>
@if ($errors->has('id_event'))
    @foreach ($errors->get('id_event') as $error)
        <div class="form-control-feedback">{{ $error }}</div>
    @endforeach
@endif
</div>

<div class="form-group @if ($errors->has('id_company_state')) has-danger @endif">
    <h5 class="m-t-30 m-b-10">Tipo de plan </h5>

            {!! Form::select('id_company_state', $company_states, null,['placeholder' => 'elija una opcion', 'class' => 'selectpicker', 'data-style'=>'form-control btn-secondary']) !!}

@if ($errors->has('id_company_state'))
@foreach ($errors->get('id_company_state') as $error)
    <div class="form-control-feedback">{{ $error }}</div>
@endforeach
@endif
</div>

<div class="form-group @if ($errors->has('price')) has-danger @endif">
    {!! Form::label('planPrice', 'Valor Plan', ['class' => '']) !!}
    {!! Form::number('price', null,['class'=>'form-control', 'placeholder' => 'Ingrese el valor del plan sin IVA', 'id'=>'planPrice']) !!}
    @if ($errors->has('price'))
        @foreach ($errors->get('price') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
        @endforeach
    @endif
</div>

<button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-nw-usr">Guardar</button>