@extends('plantilla.masterEgresado')

@section('css')
{{ HTML::style('css/bootstrap.css') }}
{{ HTML::style('css/bootstrap-theme.css') }}
{{ HTML::style('assets/css/vistaMuro.css') }}   
@stop

@section('content')
	<!-- Page Content -->
    <section id="main" class="column">
    	<br>
        <!-- Blog Entries Column -->
        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            <div class="media">
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <a href="#"><img src="uploads/perfil/{{ Auth::user()->id }}.jpg" width="64px" height="64px"></a>
                </div>
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    {{ Form::open(array('route' => 'crearP', 'files' => true)) }}
                        {{ Form::hidden('created_by', Auth::user()->id) }}
                        {{ Form::textarea('feedbox', null, array('class' => 'form-control', 'id' => 'feedbox', 'placeholder' => 'Escribe algo...', 'rows' => '3')) }}
                        <br>
                        <div class="fileUpload btn btn-default btn-sm" id="monitoreo"><span class="glyphicon glyphicon-picture"></span>
                            {{ Form::file('image', array('id' => 'archivo', 'class' => 'upload')) }}
                        </div>
                        <div class="pull-right">
                        {{ Form::button('Publicar Post', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
                        {{ Form::close() }}
                    </div>
                        <div id="variable" class=""><img id="img_user" src="uploads/muro/imagen_vacia.png" class="img-rounded" width="10"></div>

                </div>                
            </div>
            <hr>
            <!-- Posts -->
            <div id="insert"></div>
            <!-- Second -->
            <!-- Caso post sin imagen -->
            @foreach ($posts as $post)
            <?php 
                $resultados = DB::select('SELECT u.nombre,u.apPaterno,u.apMaterno from users u where u.id = ?', array($post->idUsuario));

                    foreach ($resultados as $resultado)
                    {
                        $dato1 = $resultado->nombre;
                        $dato2 = $resultado->apPaterno;
                        $dato3 = $resultado->apMaterno;
                                        
                    }
            ?>            
            @if($post->tipo_post == '0')
            <div class="media">
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <a href="#">
                        <img src="uploads/perfil/{{ $post->idUsuario }}.jpg" class="media-object" width="64px" height="64px">
                    </a>
                </div>
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <div class="media-heading">
                        <b><?php echo $dato1 ." ".$dato2 ." ".$dato3 ;?></b>
                        <!-- Menu Derecho -->
                        <div class="dropdown pull-right">
                            <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                <li role="presentation"><a data-toggle="modal" data-idpublicacion="{{ $post->id }}" data-mensaje="{{ $post->mensaje }}" class="open-Modal" href="#editar">Editar</a></li>
                                <li role="presentation"><a data-toggle="modal" data-idpost="{{ $post->id }}" data-mensaje="{{ $post->mensaje }}" class="open-Modal" href="#eliminar">Eliminar</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="text-muted"><small>{{ $post->updated_at }}</small></div>
                    <p>{{ $post->mensaje }}</p>
                    <!-- Like & Comments -->
                    <div>{{ HTML::link('#', 'Me Gusta')}}</div>
                    @foreach ($comments as $com)
                    @foreach ($com as $c)
                        @if($c->idPost == $post->id)
                        @if($c->tipo_comentario == '0')
                        <div class="media">
                            <div class="media-left">
                                <a class="pull-left" href="#">
                                    <img src="uploads/perfil/{{ $c->idUsuario }}.jpg" class="media-object" width="54px" height="54px" data-holder-rendered="true">
                                </a>
                            </div>
                            <div class="media-body">
                                <div class="media-heading">
                                    <b>{{ $c->idUsuario }}</b>
                                    <!-- Menu derecho -->
                                    <div class="dropdown pull-right">
                                        <button class="btn btn-default btn-xs close dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                            <li role="presentation"><a data-toggle="modal" data-idcomm="{{ $c->id }}" data-msg="{{ $c->mensaje }}" class="open-Modal" href="#editModal">Editar...</a></li>
                                            <li role="presentation">{{ HTML::linkRoute('borrarComentario', 'Eliminar', array($c->id)) }}</li>
                                        </ul>
                                    </div>
                                    <div class="text-muted"><small>{{ $post->updated_at }}</small></div>
                                </div>
                                <p>{{ $c->mensaje }}</p>
                            </div>
                        </div>
                        @else<!-- Comment con imagen  -->
                        <div class="media">
                            <div class="media-left">
                                <a class="pull-left" href="#">
                                    <img src="uploads/perfil/{{ $c->idUsuario }}.jpg" class="media-object" width="54px" height="54px" data-holder-rendered="true">
                                </a>
                            </div>
                            <div class="media-body">
                                <div class="media-heading">
                                    <b>{{ $c->idUsuario }}</b>
                                    <!-- Menu derecho -->
                                    <div class="dropdown pull-right">
                                        <button class="btn btn-default btn-xs close dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                            <li role="presentation"><a data-toggle="modal" data-idcomm="{{ $c->id }}" data-msg="{{ $c->mensaje }}" class="open-Modal" href="#editModal">Editar...</a></li>
                                            <li role="presentation">{{ HTML::linkRoute('borrarComentario', 'Eliminar', array($c->id)) }}</li>
                                        </ul>
                                    </div>
                                    <div class="text-muted"><small>{{ $post->updated_at }}</small></div>
                                </div>
                                <p>{{ $c->mensaje }}</p>
                                <div class="module_content">
                                    <a class="group1" href="{{ $c->rutaMultimedia }}">
                                        <img src="{{ $c->rutaMultimedia }}" height="40%" width="40%">
                                    </a>
                                </div> 
                            </div>
                        </div>
                        @endif
                        @endif
                    @endforeach
                    @endforeach
                </div><!-- col-10 -->
                <!-- Add Comment --> 
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <a href="#"><img src="uploads/perfil/{{ Auth::user()->id }}.jpg" class="pull-right" width="50px" height="50px"></a>
                </div>
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    {{ Form::open(array('route' => 'crearC', 'files' => true)) }} 
                        {{ Form::hidden('created_by', Auth::user()->id) }}
                        {{ Form::hidden('post', $post->id) }}
                        <div class="input-group input-group-sm">
                            {{ Form::textarea('commentbox', null, array('class' => 'form-control', 'id' => 'commentbox', 'maxlength' => '500', 'placeholder' => 'Escribe tu comentario...', 'rows' => '1')) }}
                            <div class="fileUpload input-group-btn btn btn-default btn-sm" id="monitoreo2"><i class="glyphicon glyphicon-camera"></i>
                                {{ Form::file('imageC', array('id' => 'archivo2', 'class' => 'upload')) }}
                            </div>
                        </div>
                    {{ Form::close() }}
                    <div id="previewC"><img id="img_C" src="uploads/muro/imagen_vacia.png" class="img-rounded" width="10"></div>
                </div>
            </div>
            @else
            <!-- Post tiene una imagen -->
            <div class="media">
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <a href="#"><img src="uploads/perfil/{{ $post->idUsuario }}.jpg" width="64px" height="64px"></a>
                </div>
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <b><?php echo $dato1 ." ".$dato2 ." ".$dato3 ;?></b>
                    <!-- Menu Derecho -->
                    @if($post->permiso == '3') <!-- Aqui debo hacer algo!! -->
                        @if($post->idUsuario == Auth::user()->id)   <!-- Con esto valido que solo puedas editar tus comments -->
                        <div class="pull-right" id="delete">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><img src="images/flecha-opc.png" class="img-circle" width="100%" alt=""></a>
                            <ul class="dropdown-menu" role="menu">
                            <li><a data-toggle="modal" data-idpublicacion="{{ $post->id }}" data-mensaje="{{ $post->mensaje }}" class="open-Modal" href="#editar">Editar</a>
                            <li><a data-toggle="modal" data-idpost="{{ $post->id }}" data-mensaje="{{ $post->mensaje }}" class="open-Modal" href="#eliminar">Eliminar</a></li>
                            </ul>
                        </div>
                        @endif
                    @endif
                    <div class="text-muted"><small>{{ $post->updated_at }}</small></div>
                    <div>{{ $post->mensaje }}</div>
                    <div><img src="{{ $post->rutaMultimedia }}" height="400" width="auto"></div>
                </div><!-- end col-10 -->
                <!-- Like & Comments -->
                <div>{{ HTML::link('#', 'Me Gusta')}}</div>
                @foreach ($comments as $com)
                @foreach ($com as $c)
                    @if($c->idPost == $post->id)
                    @if($c->tipo_comentario == '0')
                    <div class="media">
                        <div class="media-left">
                            <a class="pull-left" href="#">
                                <img src="uploads/perfil/{{ $c->idUsuario }}.jpg" class="media-object" width="54px" height="54px" data-holder-rendered="true">
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="media-heading">
                                <b>{{ $c->idUsuario }}</b>
                                <!-- Menu derecho -->
                                <div class="dropdown pull-right">
                                    <button class="btn btn-default btn-xs close dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                        <li role="presentation"><a data-toggle="modal" data-idcomm="{{ $c->id }}" data-msg="{{ $c->mensaje }}" class="open-Modal" href="#editModal">Editar...</a></li>
                                        <li role="presentation">{{ HTML::linkRoute('borrarComentario', 'Eliminar', array($c->id)) }}</li>
                                    </ul>
                                </div>
                                <div class="text-muted"><small>{{ $post->updated_at }}</small></div>
                            </div>
                            <p>{{ $c->mensaje }}</p>
                        </div>
                    </div>
                    @else<!-- Caso en que tiene imagen  -->
                    <div class="media">
                        <div class="media-left">
                            <a class="pull-left" href="#">
                                <img src="uploads/perfil/{{ $c->idUsuario }}.jpg" class="media-object" width="54px" height="54px" data-holder-rendered="true">
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="media-heading">
                                <b>{{ $c->idUsuario }}</b>
                                <!-- Menu derecho -->
                                <div class="dropdown pull-right">
                                    <button class="btn btn-default btn-xs close dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                        <li role="presentation"><a data-toggle="modal" data-idcomm="{{ $c->id }}" data-msg="{{ $c->mensaje }}" class="open-Modal" href="#editModal">Editar...</a></li>
                                        <li role="presentation">{{ HTML::linkRoute('borrarComentario', 'Eliminar', array($c->id)) }}</li>
                                    </ul>
                                </div>
                                <div class="text-muted"><small>{{ $post->updated_at }}</small></div>
                            </div>
                            <p>{{ $c->mensaje }}</p>
                            <div class="module_content">
                                <a class="group1" href="{{ $c->rutaMultimedia }}">
                                    <img src="{{ $c->rutaMultimedia }}" height="40%" width="40%">
                                </a>
                            </div> 
                        </div>
                    </div>
                    @endif
                    @endif
                @endforeach
                @endforeach
                <!-- Add Comment -->
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <a href="#"><img src="uploads/perfil/{{ Auth::user()->id }}.jpg" class="pull-right" width="50px" height="50px"></a>
                </div>
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    {{ Form::open(array('route' => 'crearC', 'files' => true)) }} 
                        {{ Form::hidden('created_by', Auth::user()->id) }}
                        {{ Form::hidden('post', $post->id) }}
                        <div class="input-group input-group-sm">
                        {{ Form::textarea('commentbox', null, array('class' => 'form-control', 'id' => 'commentbox', 'placeholder' => 'Escribe tu comentario...', 'rows' => '1')) }}
                            <div class="fileUpload input-group-btn btn btn-default btn-sm" id="monitoreo2"><i class="glyphicon glyphicon-camera"></i>
                                {{ Form::file('imageC', array('id' => 'archivo2', 'class' => 'upload')) }}
                            </div>
                        </div><!-- /input-group -->
                    {{ Form::close() }}
                    <div id="previewC"><img id="img_C" src="uploads/muro/imagen_vacia.png" class="img-rounded" width="10"></div>
                </div>
            </div><!-- end row -->
            @endif
            <hr>
            @endforeach
        </div><!-- Col-6 -->
</section>

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
                         <button type="button" class="close" data-dismiss="modal" area-hidden="true">&times;</button>
                         <h4>Eliminar Publicación</h4>
                     </div>
                     <div class="modal-body">
                         
                         <form class="form-horizontal" method="post" action="eliminar">
                             <h4>¿Estas seguro de querer eliminar el post?
                             <input name="idpost" id="ID" alight="center" readonly size="1"></input><br>
                             </h4>
                          <div class="modal-footer">
                             <!-- <button type="submit" class="btn btn-primary.btn-xs">Eliminar</button> -->
                             <input type="submit" class="btn btn-success" value="Eliminar Post">
                             <a href="#" data-dismiss="modal" class="btn btn-default">Cancelar</a>
                          </div>
                         </form>
                         
                     </div>
                 </div><!-- Fin modal-content -->
             </div>
         </div>

         <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Editar Comentario</h4>
                    </div>
                    <div class="modal-body">
                        <input name="idcomm" id="comment" alight="center" readonly size="1"></input>
                        <textarea class="form-control" rows="3" name="msg" id="MSG" value=""></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success btn-sm">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>




        </div>
        <!-- /.row -->

        <hr>

    </div>
    <!-- /.container -->

@stop

@section('js')
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>

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
$(document).ready(function(){
    $("textarea").keydown(function(event){
        var message = $(this).val();
        if(event.which == 13){
            if($.trim(message) != ""){
                //alert(message);
                $(this.form).submit();
                //return true;
            }else{
                alert("This field can't be left empty");                
            }
            $("textarea").val('');
            return false;
        }
    });
});
</script>
<script type="text/javascript">
    document.getElementById("uploadBtn").onchange = function() {
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
                    jQuery('#img_user').attr('width', 100);
                    
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