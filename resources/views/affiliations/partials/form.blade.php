<div class="form-group @if ($errors->has('bs_name')) has-danger @endif">
        {!! Form::label('bsName', 'Nombres o Razon Social', ['class' => '']) !!}
        {!! Form::text('bs_name', null,['class'=>'form-control', 'placeholder' => 'Nombres o Razon Social', 'id'=>'bsName']) !!}
        @if ($errors->has('bs_name'))
            @foreach ($errors->get('bs_name') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>

<div class="form-group @if ($errors->has('acronym')) has-danger @endif">
        {!! Form::label('acronymId', 'Siglas', ['class' => '']) !!}
        {!! Form::text('acronym', null,['class'=>'form-control', 'placeholder' => 'Siglas', 'id'=>'acronymId']) !!}
        @if ($errors->has('acronym'))
            @foreach ($errors->get('acronym') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>

<div class="form-group @if ($errors->has('nit')) has-danger @endif">
        {!! Form::label('nitId', 'NIT', ['class' => '']) !!}
        {!! Form::text('nit', null,['class'=>'form-control', 'placeholder' => 'Nit', 'id'=>'nitId']) !!}
        @if ($errors->has('nit'))
            @foreach ($errors->get('nit') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>

<div class="form-group @if ($errors->has('id_company_type')) has-danger @endif">
        <h5 class="m-t-30 m-b-10">Tipo de Empresa</h5>

                {!! Form::select('id_company_type', $company_types, null,['placeholder' => 'elija una opcion', 'class' => 'selectpicker', 'data-style'=>'form-control btn-secondary']) !!}

    @if ($errors->has('id_company_type'))
    @foreach ($errors->get('id_company_type') as $error)
        <div class="form-control-feedback">{{ $error }}</div>
    @endforeach
@endif
</div>

<div class="form-group @if ($errors->has('email')) has-danger @endif">
        {!! Form::label('exampleInputEmail1', 'Em@il', ['class' => '']) !!}
        {!! Form::email('email', null,['class'=>'form-control', 'placeholder' => 'ejemplo@ejemplo.com', 'id'=>'exampleInputEmail1']) !!}
        @if ($errors->has('email'))
            @foreach ($errors->get('email') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>

<div class="form-group @if ($errors->has('web')) has-danger @endif">
        {!! Form::label('webId', 'Pagina Web', ['class' => '']) !!}
        {!! Form::text('web', null,['class'=>'form-control', 'placeholder' => 'Pagina Web', 'id'=>'webId']) !!}
        @if ($errors->has('web'))
            @foreach ($errors->get('web') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
</div>



<div class="form-group @if ($errors->has('logo')) has-danger @endif">
        {{-- <div class="col-lg-6 col-md-6"> --}}
    <div class="card">
        <div class="card-body">
                        <h4 class="card-title">Logotipo de la empresa</h4>
                        <label for="input-file-now-custom-1">Seleccione un archivo en formato .JPG</label>
                        <input type="file" name="logo" id="input-file-now-custom-1" class="dropify" data-default-file="../assets/node_modules/dropify/src/images/test-image-1.jpg" />
                    @if ($errors->has('logo'))
                        @foreach ($errors->get('logo') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif        
            </div>
    </div>
            {{-- </div> --}}

</div>

<button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-nw-usr">Registrar Empresa</button>