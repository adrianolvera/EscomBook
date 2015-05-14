<?php

class Tipo_correo extends Eloquent{

    protected $table = 'tipo_correo';

  	public function correo_usuario()
    {
        return $this->hasMany('correo_usuario');
    }
}