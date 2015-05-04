<?php

class Comentario extends Eloquent{

    protected $table = 'comentario';

    public function user()
    {
        return $this->belongsTo('user');
    }
    
    public function post()
    {
        return $this->belongsTo('post');
    }
}