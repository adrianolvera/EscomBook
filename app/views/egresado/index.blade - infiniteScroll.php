@extends('plantilla.masterEgresado')

@section('content')
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="row">
                    <br>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <a href="#"><img src="uploads/perfil/{{ Auth::user()->id }}.jpg" width="64px" height="64px"></a>
                    </div>
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                        {{ Form::open(array('action' => 'PostController@store', 'files' => true)) }} 
                            {{ Form::hidden('created_by', Auth::user()->id) }}
                            {{ Form::textarea('feedbox', null, array('class' => 'form-control', 'id' => 'feedbox', 'placeholder' => 'Escribe algo...', 'rows' => '3')) }}
                            <br>
                            <div id="variable" class=""><img id="img_user" src="uploads/muro/blank_user.jpg" class="img-rounded" width="100"></div>
                            <div class="fileUpload btn btn-default btn-sm" id="monitoreo"><span class="glyphicon glyphicon-picture"></span>
                                {{ Form::file('image', array('id' => 'archivo', 'class' => 'upload')) }}
                            </div>
                            <!-- {{ Form::file('chooseImage', array('class' => 'upload'))}} -->
                        <div class="pull-right">
                            <!-- {{ Form::submit('Publicar Post', array('class' => 'btn btn-primary btn-sm', 'id' => 'post')) }} -->
                            {{ Form::button('Publicar Post', array('class'=>'btn btn-primary btn-xs', 'type'=>'submit')) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    
                </div>
                <hr>
                <!-- Posts -->
                <div id="insert"></div>
                <!-- From database -->
                <!-- Second -->
                <div class="item"><!-- Div for infinite scroll -->
                @foreach ($posts as $post)
                @if($post->tipo_post == '0')<!-- Caso post sin imagen -->
                <div class="row">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <a href="#"><img src="uploads/perfil/{{ $post->idUsuario }}.jpg" class="media-object" width="64px" height="64px"></a>
                    </div>
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                        <div><b>{{ $post->idUsuario }}</b>
                            <!-- Menu Derecho -->
                            @if(Auth::user()->tipo == '1' || Auth::user()->tipo == '2')
                            <!-- Los admin y encargados momentaneamente pueden editar de todos -->
                            <div class="dropdown pull-right">
                                <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                    <li role="presentation"><a data-toggle="modal" data-idpublicacion="{{ $post->id }}" data-mensaje="{{ $post->mensaje }}" class="open-Modal" href="#editar">Editar</a></li>
                                    <li role="presentation"><a data-toggle="modal" data-idpost="{{ $post->id }}" data-mensaje="{{ $post->mensaje }}" class="open-Modal" href="#eliminar">Eliminar</a></li>
                                </ul>
                            </div>
                            @elseif($post->permiso == '3') <!-- Aqui debo hacer algo!! -->
                                @if($post->idUsuario == Auth::user()->id)   <!-- Con esto valido que solo puedas editar tus comments -->
                                <div class="dropdown pull-right">
                                <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                    <li role="presentation"><a data-toggle="modal" data-idpublicacion="{{ $post->id }}" data-mensaje="{{ $post->mensaje }}" class="open-Modal" href="#editar">Editar</a></li>
                                    <li role="presentation"><a data-toggle="modal" data-idpost="{{ $post->id }}" data-mensaje="{{ $post->mensaje }}" class="open-Modal" href="#eliminar">Eliminar</a></li>
                                </ul>
                            </div>
                                @endif
                            @endif
                        </div>
                        <div class="text-muted"><small>{{ $post->updated_at }}</small></div>
                        <div>{{ $post->mensaje }}</div>
                        <!-- Menus -->
                        <div>{{ HTML::link('#', 'Me Gusta')}}</div>
                        @foreach ($comments as $com)
                        @foreach ($com as $c)
                            @if($c->idPost == $post->id)
                            <div class="media">
                                <div class="media-left">
                                    <a class="pull-left" href="#">
                                        <img src="uploads/perfil/{{ $c->idUser }}.jpg" class="media-object" width="54px" height="54px" data-holder-rendered="true">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <b>{{ $c->idUser }}</b>
                                        <button type="button" class="close" aria-label="Close" href="{{ URL::to('egresado') }}"><span aria-hidden="true">&times;</span></button>
                                        <div class="text-muted"><small>{{ $post->updated_at }}</small></div>
                                    </div>
                                    <p>{{ $c->mensaje }}</p>
                                </div>
                            </div>
                            @endif
                        @endforeach
                        @endforeach
                    </div><!-- end col-10 -->
                    <!-- Fila comentarios -->
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <a href="#"><img src="uploads/perfil/{{ $post->idUsuario }}.jpg" class="pull-right" width="35px" height="35px"></a>
                    </div>
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                        {{ Form::open(array('action' => 'ComentarioController@crear', 'files' => true)) }} 
                            {{ Form::hidden('created_by', Auth::user()->id) }}
                            {{ Form::hidden('post', $post->id) }}
                            <div class="input-group">
                              {{ Form::textarea('commentbox', null, array('class' => 'form-control', 'id' => 'commentbox', 'placeholder' => 'Escribe tu comentario...', 'rows' => '1')) }}
                              <span class="input-group-btn">
                                <div id="variable" class=""><img id="img_user" src="uploads/muro/blank_user.jpg" class="img-rounded" width="100"></div>
                                <div class="fileUpload btn btn-default btn-sm" id="monitoreo"><span class="glyphicon glyphicon-camera"></span></div>
                                <button class="btn btn-default" type="button" href="#">
                                    <span class="glyphicon glyphicon-camera"></span>
                                </button>
                              </span>
                            </div><!-- /input-group -->
                        {{ Form::close() }}
                    </div>
                    <!-- <div class="text-muted"><small>{{ \Carbon\Carbon::now(); }}</small></div> -->
                </div><!-- end row -->
                @else
                    <!-- Caso en que el post tiene una imagen -->
                    <div class="row">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <img src="uploads/perfil/{{ $post->idUsuario }}.jpg" class="media-object" width="64px" height="64px">
                    </div>
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                        <div><b>{{ $post->idUsuario }}</b>
                            <!-- Menu Derecho -->
                            @if(Auth::user()->tipo == '1' || Auth::user()->tipo == '2')
                            <!-- Los admin y encargados momentaneamente pueden editar de todos -->
                            <div class="dropdown pull-right">
                                <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                    <li role="presentation"><a data-toggle="modal" data-idpublicacion="{{ $post->id }}" data-mensaje="{{ $post->mensaje }}" class="open-Modal" href="#editar">Editar</a></li>
                                    <li role="presentation"><a data-toggle="modal" data-idpost="{{ $post->id }}" data-mensaje="{{ $post->mensaje }}" class="open-Modal" href="#eliminar">Eliminar</a></li>
                                </ul>
                            </div>
                            @elseif($post->permiso == '3') <!-- Aqui debo hacer algo!! -->
                                @if($post->idUsuario == Auth::user()->id)   <!-- Con esto valido que solo puedas editar tus comments -->
                                <div class="dropdown pull-right">
                                    <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                        <li role="presentation"><a data-toggle="modal" data-idpublicacion="{{ $post->id }}" data-mensaje="{{ $post->mensaje }}" class="open-Modal" href="#editar">Editar</a></li>
                                        <li role="presentation"><a data-toggle="modal" data-idpost="{{ $post->id }}" data-mensaje="{{ $post->mensaje }}" class="open-Modal" href="#eliminar">Eliminar</a></li>
                                    </ul>
                                </div>
                                @endif
                            @endif
                        </div>
                        <div>{{ $post->mensaje }}</div>
                        <div class="text-muted"><small>{{ $post->updated_at }}</small></div>
                        <div><img src="{{ $post->rutaMultimedia }}" height="400" width="auto"></div>
                    </div><!-- end col-10 -->
                </div><!-- end row -->
                @endif
                <hr>

                @endforeach
            </div><!-- END Div for infinite scroll -->
            <div class="paginate text-center">
                <?php echo $posts->links(); ?>
            </div>
            <!-- Bandera -->
            </div>
            <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="modalEditar" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content"> <center>
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" area-hidden="true">&times;</button>
                            <h4>Editar Publicación</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" method="post" action="actualizar">
                                <input name="idpublicacion" id="ID2" alight="center" readonly size="1"></input>
                                <textarea class="form-control" rows="3" name="mensaje" id="MENSAJE" value=""></textarea>
                             <div class="modal-footer">
                                <!-- <input type="submit" class="btn btn-primary" value="Guardar"> -->
                                <button type="submit" class="btn-btn-primary btn-xs">Guardar</button>
                                <a href="#" data-dismiss="modal" class="btn btn-default">Cancelar</a>
                             </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>       


            <div class="modal fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminar" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content"> <center>
                        <div class="modal-header">
                             <button type="submit" class="close" data-dismiss="modal" area-hidden="true">&times;</button>
                             <h4>Eliminar Publicación</h4>
                        </div>
                        <div class="modal-body">
                             
                            <form class="form-horizontal" method="post" action="eliminar">
                                <h4>¿Estas seguro de querer eliminar el post?
                                <input name="idpost" id="ID" alight="center" readonly size="1"></input><br>
                                </h4>
                              <div class="modal-footer">
                                <!-- <button type="submit" class="btn btn-primary.btn-xs">Eliminar</button> -->
                                <button type="submit" class="btn-btn-primary btn-xs">Eliminar</button>
                                <a href="#" data-dismiss="modal" class="btn btn-default">Cancelar</a>
                              </div>
                            </form>
                        </div>
                    </div><!-- Fin modal-content -->
                </div>
            </div>
<div class="paginate text-center">
            <?php echo $posts->links(); ?>
        </div>
        </div><!-- /.row -->
        <hr>
    </div>
    <!-- /.container -->

@stop

@section('js')
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
{{ HTML::script('js/jquery.jscroll.min.js') }}

<script type="text/javascript">
    $(document).ready(function(){
        //hides the default paginator
        $('ul.pagination:visible:first').hide();
        //init jscroll and tell it a few key configuration details
        //nextSelector - this will look for the automatically created $posts->links()
        //contentSelector - this is the element wrapper which is cloned and appended with new paginated data
        $('.item').jscroll({
            debug           : true,
            autoTrigger     : true,
            nextSelector    : '.pagination li.active + li a',
            contentSelector : 'paginate',
            refresh         : true,
            callback        : function(){
                //again hide the paginator from view
                $('ul.pagination:visible:first').hide();
            }
        });
    });
</script>

{{ HTML::script('js/jquery.infinitescroll.min.js') }}

<script>
    $('.item').infinitescroll({
        navSelector     : ".paginate",
        nextSelector    : ".paginate a:last",
        itemSelector    : ".item",
        debug           : true,
        dataType        : 'html',
        path: function(index) {
            return "?page=" + 2;
        }
    }, function(){
        var $newElems = $(newElements);
        $('.item').masonry('appended', $newElems, true);
    });
</script>

<script type="text/javascript">
    var $ = jQuery.noConflict(true);
    $.noConflict();
    $(document).ready(function(){
        var loading_options = {
            finishedMsg: "<div class='end-msg'>Congratulations! You've reached the end of the internet</div>",
            msgText: "<div class='center'>Cargando Post Más Antiguos...</div>",
            img: "images/ajax-loader.gif"
        };

        $('#pagination').infinitescroll({
            loading         : loading_options,
            navSelector     : ".paginate #pagination",
            nextSelector    : ".paginate #pagination li.active + li a",
            itemSelector    : "#pagination li.target",
            debug           : true,
            dataType        : 'html',
        });
    });
</script>

<script type="text/javascript">                                 // BORRAR 
    $(document).on("click", ".open-Modal", function () { 
        var id = $(this).data('idpost');         
        var valorMensaje = $(this).data('mensaje'); 
        var idpub = $(this).data('idpublicacion');
        $(".modal-body #ID").val( id );         
        $(".modal-body #MENSAJE").val( valorMensaje );
        $(".modal-body #ID2").val( idpub );
    });
</script>
<script type="text/javascript">
document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.value;
};
</script>
<script>
    //Este string contiene una imagen de 1px*1px color blanco. y no la utilizo
    window.imagenVacia = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==';

    window.mostrarVistaPrevia = function mostrarVistaPrevia() {

        var Archivos, Lector;

        //Para navegadores antiguos
        if (typeof FileReader !== "function") {
            alert('Vista previa no disponible' + ' su navegador no soporta vista previa!');
            return;
        }

        Archivos = jQuery('#archivo')[0].files;
        if (Archivos.length > 0) {

            Lector = new FileReader();
            Lector.onloadend = function(e) {
                var origen, tipo;

                //Envia la imagen a la pantalla
                origen = e.target; //objeto FileReader
                //Prepara la información sobre la imagen
                tipo = window.obtenerTipoMIME(origen.result.substring(0, 30));
                //sino muestra un mensaje 
                if (tipo !== 'image/jpeg' && tipo !== 'image/png' && tipo !== 'image/gif') {
                    jQuery('#img_user').attr('src', window.imagenVacia);
                    alert('El formato de imagen no es válido: debe seleccionar una imagen JPG, PNG o GIF.');
                } else {
                    jQuery('#img_user').attr('src', origen.result);
                    
                }

            };
            Lector.onerror = function(e) {
                console.log(e)
            }
            Lector.readAsDataURL(Archivos[0]);

        } else {
            var objeto = jQuery('#archivo');
            objeto.replaceWith(objeto.val('').clone());
            jQuery('#img_user').attr('src', window.imagenVacia);
        };


    };

    //Lee el tipo MIME de la cabecera de la imagen. la necesito para obtener el tipo de imagen
    window.obtenerTipoMIME = function obtenerTipoMIME(cabecera) {
        return cabecera.replace(/data:([^;]+).*/, '\$1');
    }

    jQuery(document).ready(function() {

        //El input del archivo lo vigilamos con un "delegado"
        jQuery('#monitoreo').on('change', '#archivo', function(e) {
            window.mostrarVistaPrevia();
        });

        //El botón Cancelar lo vigilamos normalmente
        jQuery('#cancelar').on('click', function(e) {
            var objeto = jQuery('#archivo');
            objeto.replaceWith(objeto.val('').clone());

            //jQuery('#img_user').attr('src', window.imagenVacia);
        });
        $('#variable').css('visibility', 'visible');
    });
</script>
@stop