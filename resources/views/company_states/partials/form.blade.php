<div class="form-group @if ($errors->has('company_state')) has-danger @endif">
        {!! Form::label('companyState', 'Estado de Empresa', ['class' => '']) !!}
        {!! Form::text('company_state', null,['class'=>'form-control', 'placeholder' => 'Estado de Empresa', 'id'=>'companyState']) !!}
        @if ($errors->has('company_state'))
            @foreach ($errors->get('company_state') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>
<div class="form-group @if ($errors->has('slug')) has-danger @endif">
        {!! Form::label('companyStateSlug', 'Slug o ruta predefinida', ['class' => '']) !!}
        {!! Form::text('slug', null,['class'=>'form-control', 'placeholder' => 'ejemplo-ejemplo', 'id'=>'companyStateSlug']) !!}
        @if ($errors->has('slug'))
            @foreach ($errors->get('slug') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>
<div class="form-group @if ($errors->has('description')) has-danger @endif">
        {!! Form::label('companyStateDescription', 'Descripcion', ['class' => '']) !!}
        {!! Form::textarea('description', null,['class'=>'form-control', 'placeholder' => 'Description del estado', 'id'=>'companyStateSlug']) !!}
        @if ($errors->has('description'))
            @foreach ($errors->get('description') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>

<button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-nw-usr">Guardar</button>