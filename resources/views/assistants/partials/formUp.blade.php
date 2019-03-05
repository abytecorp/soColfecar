<div class="form-group @if ($errors->has('names')) has-danger @endif">
        {!! Form::label('imputNames', 'Nombres del asistente (*)', ['class' => '']) !!}
        {!! Form::text('names', null,['class'=>'form-control', 'placeholder' => 'Nombres del Asistente', 'id'=>'imputNames']) !!}
        @if ($errors->has('names'))
            @foreach ($errors->get('names') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
    </div>
    <div class="form-group @if ($errors->has('last_names')) has-danger @endif">
        {!! Form::label('imputLastNames', 'Apellidos del asistente (*)', ['class' => '']) !!}
        {!! Form::text('last_names', null,['class'=>'form-control', 'placeholder' => 'Ingrese los apellidos', 'id'=>'imputLastNames']) !!}
        @if ($errors->has('last_names'))
            @foreach ($errors->get('last_names') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
        @endif
    </div>



    <div class="form-group @if ($errors->has('id_type')) has-danger @endif">
            <h5 class="m-t-30 m-b-10">Tpo de identificacion </h5>

                    {!! Form::select('id_type', $id_types, null,['placeholder' => 'elija una opcion', 'class' => 'selectpicker', 'data-style'=>'form-control btn-secondary']) !!}

        @if ($errors->has('id_type'))
        @foreach ($errors->get('id_type') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
        @endforeach
    @endif
    </div>

    <div class="form-group @if ($errors->has('id_number')) has-danger @endif">
            {!! Form::label('imputIdNumber', 'Identificacon del usuario', ['class' => '']) !!}
            {!! Form::text('id_number', null,['class'=>'form-control', 'placeholder' => 'Ingrese el numero de identificacion', 'id'=>'imputIdNumber']) !!}
            @if ($errors->has('id_number'))
                @foreach ($errors->get('id_number') as $error)
                    <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
            @endif
    </div>
    <input type="hidden" id="id_city" name="id_city">
 

    <div class="form-group @if ($errors->has('address')) has-danger @endif">
            {!! Form::label('address', 'Direccion', ['class' => '']) !!}
            {!! Form::text('address', null,['class'=>'form-control', 'placeholder' => 'Ingrese La direccion de residencia', 'id'=>'address']) !!}
            @if ($errors->has('address'))
                @foreach ($errors->get('address') as $error)
                    <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
            @endif
        </div>

        <div class="form-group @if ($errors->has('tel')) has-danger @endif">
                {!! Form::label('imputTel', 'Telefono', ['class' => '']) !!}
                {!! Form::text('tel', null,['class'=>'form-control', 'placeholder' => 'Ingrese Nuemro telefonico', 'id'=>'imputTel']) !!}
                @if ($errors->has('tel'))
                    @foreach ($errors->get('tel') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
        </div>

        <div class="form-group @if ($errors->has('cel')) has-danger @endif">
                {!! Form::label('imputCel', 'Celular', ['class' => '']) !!}
                {!! Form::text('cel', null,['class'=>'form-control', 'placeholder' => 'Ingrese el numero de celular', 'id'=>'imputCel']) !!}
                @if ($errors->has('cel'))
                    @foreach ($errors->get('cel') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        
            <div class="form-group @if ($errors->has('position')) has-danger @endif">
                    {!! Form::label('imputPosition', 'cargo', ['class' => '']) !!}
                    {!! Form::text('position', null,['class'=>'form-control', 'placeholder' => 'Ingrese el cargo', 'id'=>'imputPosition']) !!}
                    @if ($errors->has('position'))
                        @foreach ($errors->get('position') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
            </div>

                <div class="form-group @if ($errors->has('email')) has-danger @endif">
                        {!! Form::label('imputEmail', 'email', ['class' => '']) !!}
                        {!! Form::text('email', null,['class'=>'form-control', 'placeholder' => 'Ingrese el Em@il', 'id'=>'imputEmail']) !!}
                        @if ($errors->has('email'))
                            @foreach ($errors->get('email') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                </div>

    <div class="form-group @if ($errors->has('id_company')) has-danger @endif">
            <h6 class="m-t-30 m-b-10">Empresa a la que pertenece. (*)</h6>
            <select name="id_company" id="id_company"  class="select2 form-control custom-select" style="width: 40%; height:36px;">
                    <option id="imput"></option>
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




    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-nw-usr">Guardar</button>
