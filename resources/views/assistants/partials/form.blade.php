@if( ! empty($company))
<div class="alert alert-success"> <img src="{{ Storage::disk('public')->url($company->logo) }}" width="30" class="img-circle" alt="img">     {{ $company->bs_name }}
    {{-- <button type="submit" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> --}}
<input type="hidden" name="id_company" value="{{ $company->id }}" />
</div>
@else

<div class="form-group @if ($errors->has('id_company')) has-danger @endif">
        <h6 class="m-t-30 m-b-10">Empresa </h6>
        <select name="id_company" aria-placeholder="Seleccione una empresa" class="select2 form-control custom-select" style="width: 40%; height:36px;">
                <option id="" ></option>
            @foreach ($companies as $company)
                <option value="{{ $company->id }}">{{ $company->bs_name.' ( '.$company->nit.' ) ' }}</option>
            @endforeach
        </select>
    @if ($errors->has('id_company'))
        @foreach ($errors->get('id_company') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
        @endforeach
    @endif
    </div>

@endif
    
    
    <div class="form-group @if ($errors->has('names')) has-danger @endif">
        {!! Form::label('imputNames', 'Nombres del asistente', ['class' => '']) !!}
        {!! Form::text('names', null,['class'=>'form-control', 'placeholder' => 'Aqui puede ingresar los Nombres ', 'id'=>'imputNames']) !!}
        @if ($errors->has('names'))
            @foreach ($errors->get('names') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
    </div>

    <div class="form-group @if ($errors->has('last_names')) has-danger @endif">
        {!! Form::label('imputLastNames', 'Ingrese los apellidos del asistente', ['class' => '']) !!}
        {!! Form::text('last_names', null,['class'=>'form-control', 'placeholder' => 'Aqui puede ingresar los Apellidos', 'id'=>'imputLastNames']) !!}
        @if ($errors->has('last_names'))
            @foreach ($errors->get('last_names') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
    </div>

    <div class="form-group @if ($errors->has('id_type')) has-danger @endif">
            <h6 class="m-t-30 m-b-10">Seleccione el tipo de identificacion </h6>

                    {!! Form::select('id_type', $user_types, null,['placeholder' => 'Que tipo de identificacion?', 'class' => 'selectpicker', 'data-style'=>'btn-info btn-outline-info']) !!}

        @if ($errors->has('id_type'))
        @foreach ($errors->get('id_type') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
        @endforeach
    @endif
    </div>

    <div class="form-group @if ($errors->has('id_number')) has-danger @endif">
            {!! Form::label('idNumber', 'Numero de Identificación.', ['class' => '']) !!}
            {!! Form::text('id_number', null,['class'=>'form-control', 'placeholder' => 'Numero de identificación', 'id'=>'idNumber']) !!}
            @if ($errors->has('id_number'))
                @foreach ($errors->get('id_number') as $error)
                    <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
            @endif
    </div>

 
    <div class="form-group @if ($errors->has('id_city')) has-danger @endif">
        <h6 class="m-t-30 m-b-10">Ciudad de residencia. </h6>
        <select name="id_city" class="select2 form-control custom-select" style="width: 40%; height:36px;">
                {<option id=""></option>
            @foreach ($cities as $city)
                <option value="{{ $city->id }}">{{ $city->city.' ( '.$city->getDepartament['departament'].' ) ' }}</option>
            @endforeach
        </select>
    @if ($errors->has('id_city'))
        @foreach ($errors->get('id_city') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
        @endforeach
    @endif
    </div>
    

    <div class="form-group @if ($errors->has('position')) has-danger @endif">
        {!! Form::label('imputPosition', 'Cargo', ['class' => '']) !!}
        {!! Form::text('position', null,['class'=>'form-control', 'placeholder' => 'Que cargo tiene en la empresa?', 'id'=>'imputPosition']) !!}
        @if ($errors->has('position'))
            @foreach ($errors->get('position') as $error)
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

    
    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-nw-usr">Registrar Asistente</button>
