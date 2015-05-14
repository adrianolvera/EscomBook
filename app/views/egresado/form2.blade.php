<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
    {{ Form::open(array('action' => 'UserController@saveBasics', 'class' => 'form-horizontal', 'files' => true)) }}
    <!-- Form Name -->
    <legend>INFORMACIÓN DE CONTACTO</legend>
    <!-- Text input-->
    <div class="form-group">
        {{ Form::label('telefono', 'Teléfono', array('class' => 'control-label')) }}              
      <div class="col-md-6">
        {{ Form::text('telefono', '', array('class' => 'form-control', 'id' => 'tel')) }}
      </div>
    </div>
    
    <!-- Multiple Radios -->
    <div class="form-group">
        {{ Form::label('radio', 'Tipo Teléfono', array('class' => 'control-label')) }}              
        <div class="col-md-4">
            <label for="radios-0">
                {{ Form::radio('radios', '1', null, ['id' => 'radios-0']) }}
                Casa
            </label>
            <br>
            <label for="radios-1">
                {{ Form::radio('radios', '2', true, ['id' => 'radios-1']) }}
                Celular
            </label>
            <br>
            <label for="radios-2">
                {{ Form::radio('radios', '3', null, ['id' => 'radios-2']) }}
                Otro
            </label>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      {{ Form::label('direccion', 'Dirección', array('class' => 'control-label')) }}
      <div class="col-md-6">
        {{ Form::text('direccion', null, array('class' => 'form-control')) }}
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
        {{ Form::label('correo', 'Correo Electrónico', array('class' => 'control-label')) }}
      <div class="col-md-6">
        {{ Form::email('correo', '', ['class' => 'form-control']) }}
      </div>
    </div>

    <!-- Multiple Radios -->
    <div class="form-group">
        {{ Form::label('correo', 'Tipo Correo', array('class' => 'control-label')) }}              
        <div class="col-md-4">
            <label for="radios-0">
                {{ Form::radio('correos', '1', true, ['id' => 'radios-3']) }}
                Personal
            </label>
            <br>
            <label for="radios-1">
                {{ Form::radio('correos', '2', null, ['id' => 'radios-4']) }}
                Trabajo
            </label>
            <br>
            <label for="radios-2">
                {{ Form::radio('correos', '3', null, ['id' => 'radios-5']) }}
                Otro
            </label>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
        {{ Form::label('facebook', 'Facebook', array('class' => 'control-label')) }}
      <div class="col-md-6">
        {{ Form::url('facebook', null, ['class' => 'form-control']) }}
      </div>
    </div>

    <!-- Preview --> 
    <div class="form-group">
        {{ Form::label('', '', array('class' => 'control-label')) }}
        <div class="col-md-6" id="variable">
            @if($foto == '')
            <img id="img_user" src="uploads/perfil/blank_user.jpg" class="img-rounded" width="60%">
            @else
            <img id="img_user" src="{{ $foto }}" class="img-rounded" width="60%">
            @endif
        </div>
    </div>

    <!-- File Button --> 
    <div class="form-group">
        {{ Form::label('ProfilePhoto', '', array('class' => 'control-label')) }}
      <div class="col-md-6">
        <div class="fileUpload btn btn-default btn-sm" id="monitoreo"><span class="glyphicon glyphicon-picture"></span>
            {{ Form::file('ProfilePhoto', array('id' => 'archivo', 'class' => 'upload')) }}
        </div>
        
      </div>
    </div>

    <!-- Button -->
    <div class="form-group">
      <label class="col-md-6 control-label" for=""></label>
      <div class="col-md-6">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>

    {{ Form::close() }}
</div>