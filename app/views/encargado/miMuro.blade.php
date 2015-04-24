@extends('plantilla.masterEncargado')

@section('content')
	<!-- Page Content -->
    <div class="container">
        <br>
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
                        <div id="variable" class="hidden"><img id="img_user" src="uploads/muro/blank_user.jpg" class="img-rounded" width="100"></div>
                        <div class="fileUpload btn btn-default btn-sm" id="monitoreo"><span class="glyphicon glyphicon-picture"></span>
                            {{ Form::file('image', array('id' => 'archivo', 'class' => 'upload')) }}
                        </div>
                    <div class="pull-right">
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
            @foreach ($posts as $post)
            @if($post->tipo_post == '0')<!-- Caso post sin imagen -->
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img src="uploads/perfil/{{ $post->idUsuario }}.jpg" class="media-object" width="64px" height="64px">
                    </a>
                </div>
                <div class="media-body">
                    <div class="media-heading">
                        <b>{{ Auth::user()->nombre}} {{ Auth::user()->apPaterno}}</b>
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
                        <div class="text-muted"><small>{{ $post->updated_at }}</small></div>
                    </div>
                    {{ $post->mensaje }}
                </div>
            </div>                
            @else
                <!-- Caso en que el post tiene una imagen -->
                <div class="row">
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <a href="#"><img src="uploads/perfil/{{ $post->idUsuario }}.jpg" width="64px" height="64px"></a>
                </div>
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <b>{{ Auth::user()->nombre}} {{ Auth::user()->apPaterno}}</b>
                    <!-- Menu Derecho -->
                    <!-- Los admin y encargados momentaneamente pueden editar de todos -->
                    <div class="pull-right" id="delete">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><img src="images/flecha-opc.png" class="img-circle" width="100%" alt=""></a>
                            <ul class="dropdown-menu" role="menu">
                            <li><a data-toggle="modal" data-idpublicacion="{{ $post->id }}" data-mensaje="{{ $post->mensaje }}" class="open-Modal" href="#editar">Editar</a>
                            <li><a data-toggle="modal" data-idpost="{{ $post->id }}" data-mensaje="{{ $post->mensaje }}" class="open-Modal" href="#eliminar">Eliminar</a></li>
                            </ul>
                    </div>
                    <div class="text-muted"><small>{{ $post->updated_at }}</small></div>
                    {{ $post->mensaje }}
                    <div><img src="{{ $post->rutaMultimedia }}" height="400" width="auto"></div>
                </div><!-- end col-10 -->
            </div><!-- end row -->
            @endif
            <hr>
            @endforeach
        </div><!-- Col-6 -->


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

        </div>
        <!-- /.row -->

        <hr>

    </div>
    <!-- /.container -->

@stop

@section('js')
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
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