<?php

class Tipo_telefono extends Eloquent{

    protected $table = 'tipo_telefono';

  	public function correo_usuario()
    {
        return $this->hasMany('telefono_usuario');
    }
}