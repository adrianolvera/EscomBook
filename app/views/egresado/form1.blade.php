<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
    {{ Form::open(array('action' => 'UserController@saveBasics', 'class' => 'form-horizontal', 'files' => true)) }}
    <!-- Form Name -->
    <legend>INFORMACIÓN DE CONTACTO</legend>
    <?php $var  = 0; 
          $var2 = 0; ?>
    <!-- Text input-->
    @foreach($tel as $t)
    <div class="form-group">
        {{ Form::label('telefono', 'Teléfono', array('class' => 'control-label')) }}
      <div class="col-md-6">
        {{ Form::text('telefono'.$var, $t->telefono, array('class' => 'form-control', 'name' => 'tels[]')) }}
      </div>
    </div>
    
    <!-- Multiple Radios -->
    <div class="form-group">
        {{ Form::label('radio', 'Tipo Teléfono', array('class' => 'control-label')) }}              
        <div class="col-md-4">
            @if($t->tipoTelefono == 1)
            <label for="radios-0">
                {{ Form::radio('radios'.$var, '1', true, ['id' => 'radios-0']) }}
                Casa
            </label>
            <br>
            <label for="radios-1">
                {{ Form::radio('radios'.$var, '2', null, ['id' => 'radios-1']) }}
                Celular
            </label>
            <br>
            <label for="radios-2">
                {{ Form::radio('radios'.$var, '3', null, ['id' => 'radios-2']) }}
                Otro
            </label>
            @elseif($t->tipoTelefono == 2)
            <label for="radios-0">
                {{ Form::radio('radios'.$var, '1', null, ['id' => 'radios-0']) }}
                Casa
            </label>
            <br>
            <label for="radios-1">
                {{ Form::radio('radios'.$var, '2', true, ['id' => 'radios-1']) }}
                Celular
            </label>
            <br>
            <label for="radios-2">
                {{ Form::radio('radios'.$var, '3', null, ['id' => 'radios-2']) }}
                Otro
            </label>
            @else
            <label for="radios-0">
                {{ Form::radio('radios'.$var, '1', null, ['id' => 'radios-0']) }}
                Casa
            </label>
            <br>
            <label for="radios-1">
                {{ Form::radio('radios'.$var, '2', null, ['id' => 'radios-1']) }}
                Celular
            </label>
            <br>
            <label for="radios-2">
                {{ Form::radio('radios'.$var, '3', true, ['id' => 'radios-2']) }}
                Otro
            </label>
            @endif
      </div>
    </div>
    <?php $var++; ?>
    @endforeach

    @for($i = $var; $i < 3; $i++)
    <div class="hidetels" id="{{ $i }}" style="display: none;">
        <!-- Text input-->
        <div class="form-group">
            {{ Form::label('telefono', 'Teléfono', array('class' => 'control-label')) }}              
          <div class="col-md-6">
            {{ Form::text('telefono'.$i, '', array('class' => 'form-control', 'name' => 'tels[]')) }}
          </div>
        </div>
        
        <!-- Multiple Radios -->
        <div class="form-group">
            {{ Form::label('radio', 'Tipo Teléfono', array('class' => 'control-label')) }}              
            <div class="col-md-4">
                <label for="radios-0">
                    {{ Form::radio('radios'.$i, '1', true, ['id' => 'radios-0']) }}
                    Casa
                </label>
                <br>
                <label for="radios-1">
                    {{ Form::radio('radios'.$i, '2', null, ['id' => 'radios-1']) }}
                    Celular
                </label>
                <br>
                <label for="radios-2">
                    {{ Form::radio('radios'.$i, '3', null, ['id' => 'radios-2']) }}
                    Otro
                </label>
          </div>
        </div>

        <div class="form-group">
            <label class="col-md-6 control-label" for=""></label>
            <div class="col-md-6 pull-right">
                <button type="button" class="btn btn-danger btn-xs esconder" aria-label="Left Align">
                    <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>
    @endfor

    <input type="hidden" id="hidetels" value="{{ $var }}">

    <!-- Añadir mas telefonos -->
    <div class="form-group">
        {{ Form::label('', '', array('class' => 'control-label')) }}
        <div class="col-md-6">
            <button class="btn btn-primary btn-sm add_field_button">Añadir otro teléfono</button>    
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
    @foreach($correo as $c)
    <div class="form-group">
        {{ Form::label('correo', 'Correo Electrónico', array('class' => 'control-label')) }}
      <div class="col-md-6">
        {{ Form::email('correo', $c->correo, ['class' => 'form-control', 'name' => 'mails[]']) }}
      </div>
    </div>

    <!-- Multiple Radios -->
    <div class="form-group">
        {{ Form::label('correo', 'Tipo Correo', array('class' => 'control-label')) }}              
        <div class="col-md-4">
            @if($c->tipoCorreo == 1)
            <label for="radios-0">
                {{ Form::radio('correos'.$var2, '1', true, ['id' => 'radios-3']) }}
                Personal
            </label>
            <br>
            <label for="radios-1">
                {{ Form::radio('correos'.$var2, '2', null, ['id' => 'radios-4']) }}
                Trabajo
            </label>
            <br>
            <label for="radios-2">
                {{ Form::radio('correos'.$var2, '3', null, ['id' => 'radios-5']) }}
                Otro
            </label>
            @elseif($c->tipoCorreo == 2)
            <label for="radios-0">
                {{ Form::radio('correos'.$var2, '1', null, ['id' => 'radios-3']) }}
                Personal
            </label>
            <br>
            <label for="radios-1">
                {{ Form::radio('correos'.$var2, '2', true, ['id' => 'radios-4']) }}
                Trabajo
            </label>
            <br>
            <label for="radios-2">
                {{ Form::radio('correos'.$var2, '3', null, ['id' => 'radios-5']) }}
                Otro
            </label>
            @else
            <label for="radios-0">
                {{ Form::radio('correos'.$var2, '1', null, ['id' => 'radios-3']) }}
                Personal
            </label>
            <br>
            <label for="radios-1">
                {{ Form::radio('correos'.$var2, '2', null, ['id' => 'radios-4']) }}
                Trabajo
            </label>
            <br>
            <label for="radios-2">
                {{ Form::radio('correos'.$var2, '3', true, ['id' => 'radios-5']) }}
                Otro
            </label>
            @endif
      </div>
    </div>
    <?php $var2++; ?>
    @endforeach

    @for($i = $var2; $i < 3; $i++)
    <div class="hidemails" id="{{ $i }}" style="display: none;">
        <!-- Text input-->
        <div class="form-group">
            {{ Form::label('correo', 'Correo Electrónico', array('class' => 'control-label')) }}
          <div class="col-md-6">
            {{ Form::email('correo', '', ['class' => 'form-control', 'name' => 'mails[]']) }}
          </div>
        </div>

        <!-- Multiple Radios -->
        <div class="form-group">
            {{ Form::label('correo', 'Tipo Correo', array('class' => 'control-label')) }}              
            <div class="col-md-4">
                <label for="radios-0">
                    {{ Form::radio('correos'.$i, '1', true, ['id' => 'radios-3']) }}
                    Personal
                </label>
                <br>
                <label for="radios-1">
                    {{ Form::radio('correos'.$i, '2', null, ['id' => 'radios-4']) }}
                    Trabajo
                </label>
                <br>
                <label for="radios-2">
                    {{ Form::radio('correos'.$i, '3', null, ['id' => 'radios-5']) }}
                    Otro
                </label>
          </div>
        </div>

        <div class="form-group">
            <label class="col-md-6 control-label" for=""></label>
            <div class="col-md-6 pull-right">
                <button type="button" class="btn btn-danger btn-xs esconder2" aria-label="Left Align">
                    <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>
    @endfor

    <input type="hidden" id="hidemails" value="{{ $var2 }}">

    <!-- Añadir mas telefonos -->
    <div class="form-group">
        {{ Form::label('', '', array('class' => 'control-label')) }}
        <div class="col-md-6">
            <button class="btn btn-primary btn-sm add_correo">Añadir otro correo</button>    
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