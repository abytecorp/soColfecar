<div class="form-group @if ($errors->has('id_type')) has-danger @endif">
        {!! Form::label('companyState', 'tipo de ido', ['class' => '']) !!}
        {!! Form::text('id_type', null,['class'=>'form-control', 'placeholder' => 'Tipo de ido', 'id'=>'companyState']) !!}
        @if ($errors->has('id_type'))
            @foreach ($errors->get('id_type') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>
<div class="form-group @if ($errors->has('slug')) has-danger @endif">
        {!! Form::label('idTypeSlug', 'Slug o ruta predefinida', ['class' => '']) !!}
        {!! Form::text('slug', null,['class'=>'form-control', 'placeholder' => 'ejemplo-ejemplo', 'id'=>'idTypeSlug']) !!}
        @if ($errors->has('slug'))
            @foreach ($errors->get('slug') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>
<div class="form-group @if ($errors->has('description')) has-danger @endif">
        {!! Form::label('idTypeDescription', 'Descripcion', ['class' => '']) !!}
        {!! Form::textarea('description', null,['class'=>'form-control', 'placeholder' => 'Description del tipo de ido', 'id'=>'idTypeDescription']) !!}
        @if ($errors->has('description'))
            @foreach ($errors->get('description') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>

<button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-nw-usr">Guardar</button>