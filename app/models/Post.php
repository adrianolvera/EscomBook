<?php

class Post extends Eloquent {

    protected $table = 'post';

    public function user() {
        return $this->belongsTo('user');
    }

    public function comentario() {
        return $this->hasMany('comentario');
    }

 //    public function delete()
	// {
	//     $this->comentario()->delete();
	//     // delete the model
	//     return parent::delete();
	// }
}