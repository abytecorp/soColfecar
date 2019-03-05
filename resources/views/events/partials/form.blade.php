

<h3 class="card-title">1. Tipo de evento</h3>
<hr>
<div class="form-group @if ($errors->has('id_event_type')) has-danger @endif">
    <h5 class="m-t-30 m-b-10">Seleccione un tipo de evento </h5>

   {!! Form::select('id_event_type', $event_types, null,['placeholder' => 'elija una opcion', 'class' => 'selectpicker', 'data-style'=>'form-control btn-secondary']) !!} 
           

@if ($errors->has('id_event_type'))
@foreach ($errors->get('id_event_type') as $error)
    <div class="form-control-feedback">{{ $error }}</div>
@endforeach
@endif
</div>



<h3 class="card-title">2. Información del evento</h3>
<hr>

<div class="form-group @if ($errors->has('event')) has-danger @endif">
        {!! Form::label('eventName', 'Nombre del evento', ['class' => '']) !!}
        {!! Form::text('event', null,['class'=>'form-control', 'placeholder' => 'Nombre del evento', 'id'=>'eventName']) !!}
        @if ($errors->has('event'))
            @foreach ($errors->get('event') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>

<div class="form-group @if ($errors->has('date_init')) has-danger @endif col-4">
    {!! Form::label('initDateDescription', 'Seleccione el dia cuando inicia el  evento', ['class' => '']) !!}
    {!! Form::date('date_init', null,['class'=>'form-control', 'placeholder' => '', 'id'=>'initDateDescription']) !!}
    @if ($errors->has('date_init'))
        @foreach ($errors->get('date_init') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
        @endforeach
    @endif
</div>

<div class="form-group @if ($errors->has('date_end')) has-danger @endif col-4">
    {!! Form::label('endDateDescription', 'Seleccione el dia cuando finaliza el evento', ['class' => '']) !!}
    {!! Form::date('date_end', null,['class'=>'form-control', 'placeholder' => '', 'id'=>'endDateDescription']) !!}
    @if ($errors->has('date_end'))
        @foreach ($errors->get('date_end') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
        @endforeach
    @endif
</div>

<h3 class="card-title">3. Banner del evento</h3>
<hr>

<div class="form-group @if ($errors->has('banner')) has-danger @endif" >
    {{-- <div class="col-lg-6 col-md-6"> --}}
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Banner</h4>
        <label for="input-file-now-custom-1">Seleccione un archivo en formato .JPG</label>
        <input type="file" id="input-file-now-custom-1" class="dropify" name="banner" data-default-file="../assets/node_modules/dropify/src/images/test-image-1.jpg" />
        @if ($errors->has('banner'))
            @foreach ($errors->get('banner') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
    </div>
</div>
        {{-- </div> --}}

</div>








<button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-nw-usr">Guardar</button>