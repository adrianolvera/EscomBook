@extends('muro.master')

@section('css')
	<link href="{{ asset('assets/css/blog-home.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/seo.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/vistaMuro.css') }}" rel="stylesheet" media="screen">
@stop

@section('contenido')
	<!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="row">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <img src="{{ asset('images/Motiva.jpg') }}"  width="100%" alt="">
                    </div>
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                        {{ Form::open(array('action' => 'PostController@actualizar')) }} 
                            {{ Form::hidden('idPost', $post->id) }}
                            {{ Form::textarea('feedbox', $post->mensaje, array('class' => 'form-control', 'id' => 'feedbox', 'rows' => '3')) }}<br>
                            {{ Form::submit('Guardar', array('class' => 'btn btn-primary btn-sm')) }}
                        {{ Form::close() }}
                        
                    </div>
                    
                </div>
                <hr>
                <!-- Comentarios -->
                
            </div>     

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>

    </div>
    <!-- /.container -->

@stop

@section('js')
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
@stop