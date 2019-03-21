<div class="form-group @if ($errors->has('role')) has-danger @endif">
        {!! Form::label('role', 'Rol', ['class' => '']) !!}
        {!! Form::text('role', null,['class'=>'form-control', 'placeholder' => 'Rol', 'id'=>'role']) !!}
        @if ($errors->has('role'))
            @foreach ($errors->get('role') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>
<div class="form-group @if ($errors->has('slug')) has-danger @endif">
        {!! Form::label('roleSlug', 'Slug o ruta predefinida', ['class' => '']) !!}
        {!! Form::text('slug', null,['class'=>'form-control', 'placeholder' => 'ejemplo-ejemplo', 'id'=>'roleSlug']) !!}
        @if ($errors->has('slug'))
            @foreach ($errors->get('slug') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>
<div class="form-group @if ($errors->has('description')) has-danger @endif">
        {!! Form::label('roleDescription', 'Descripcion', ['class' => '']) !!}
        {!! Form::textarea('description', null,['class'=>'form-control', 'placeholder' => 'Description del rol', 'id'=>'roleSlug']) !!}
        @if ($errors->has('description'))
            @foreach ($errors->get('description') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>

<button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-nw-usr">Guardar</button>