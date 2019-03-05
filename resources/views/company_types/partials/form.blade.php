<div class="form-group @if ($errors->has('company_type')) has-danger @endif">
        {!! Form::label('companyType', 'Tipo de Empresa', ['class' => '']) !!}
        {!! Form::text('company_type', null,['class'=>'form-control', 'placeholder' => 'Estado de Empresa', 'id'=>'companyType']) !!}
        @if ($errors->has('company_type'))
            @foreach ($errors->get('company_type') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>
<div class="form-group @if ($errors->has('slug')) has-danger @endif">
        {!! Form::label('companyTypeSlug', 'Slug o ruta predefinida', ['class' => '']) !!}
        {!! Form::text('slug', null,['class'=>'form-control', 'placeholder' => 'ejemplo-ejemplo', 'id'=>'companyTypeSlug']) !!}
        @if ($errors->has('slug'))
            @foreach ($errors->get('slug') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>
<div class="form-group @if ($errors->has('description')) has-danger @endif">
        {!! Form::label('companyTypeDescription', 'Descripcion', ['class' => '']) !!}
        {!! Form::textarea('description', null,['class'=>'form-control', 'placeholder' => 'Description del estado', 'id'=>'companyTypeSlug']) !!}
        @if ($errors->has('description'))
            @foreach ($errors->get('description') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>

<button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-nw-usr">Guardar</button>