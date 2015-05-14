<?php

class Telefono extends Eloquent{

    protected $table = 'telefono_usuario';

    public function user()
    {
        return $this->belongsTo('user');
    }

    public function tipo_telefono()
    {
        return $this->belongsTo('tipo_telefono');
    }
}