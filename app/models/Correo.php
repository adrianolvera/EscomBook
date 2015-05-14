<?php

class Correo extends Eloquent {

    protected $table = 'correo_usuario';

    public function user()
    {
        return $this->belongsTo('user');
    }

    public function tipo_correo()
    {
        return $this->belongsTo('tipo_correo');
    }
}