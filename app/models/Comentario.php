<?php

class Comentario extends Eloquent{

    protected $table = 'comentario';

    public function post()
    {
        return $this->belongsTo('post');
    }
}