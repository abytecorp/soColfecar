<div class="form-group @if ($errors->has('event_type')) has-danger @endif">
        {!! Form::label('companyState', 'tipo de evento', ['class' => '']) !!}
        {!! Form::text('event_type', null,['class'=>'form-control', 'placeholder' => 'Tipo de evento', 'id'=>'companyState']) !!}
        @if ($errors->has('event_type'))
            @foreach ($errors->get('event_type') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>
<div class="form-group @if ($errors->has('slug')) has-danger @endif">
        {!! Form::label('eventTypeSlug', 'Slug o ruta predefinida', ['class' => '']) !!}
        {!! Form::text('slug', null,['class'=>'form-control', 'placeholder' => 'ejemplo-ejemplo', 'id'=>'eventTypeSlug']) !!}
        @if ($errors->has('slug'))
            @foreach ($errors->get('slug') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>
<div class="form-group @if ($errors->has('description')) has-danger @endif">
        {!! Form::label('eventTypeDescription', 'Descripcion', ['class' => '']) !!}
        {!! Form::textarea('description', null,['class'=>'form-control', 'placeholder' => 'Description del tipo de evento', 'id'=>'eventTypeDescription']) !!}
        @if ($errors->has('description'))
            @foreach ($errors->get('description') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>

<button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-nw-usr">Guardar</button>