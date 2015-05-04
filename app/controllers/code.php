public static $rules = array(
	    'image'           => 'mimes:jpeg,jpg,png|image|max:131072'
	);


	http://laravel.com/api/4.2/Illuminate/Routing/Route.html
	http://codehero.co/laravel-4-desde-cero-filtros-parte-i/
	http://laraveles.com/foro/viewtopic.php?id=2405
	
	{{ Form::textarea('commentbox', null, array('class' => 'form-control', 'id' => 'commentbox', 'placeholder' => 'Escribe tu comentario...', 'rows' => '1', 'onkeypress' => 'return chkComment(event)')) }}
	<span class="input-group-btn">
		{{ Form::button('<i class="glyphicon glyphicon-camera"></i>', array('type' => 'submit', 'class' => 'btn btn-default', 'onClick' => 'return chkComment()')) }}
	</span>

	function chkComment(e){
	if(e.keyCode == 13){
		var content = this.value;
		if(content.length < 1){
			alert("This field can't be left empty");
			return false;
		}else{
			document.getElementById("comment").submit(); // envío el formulario
			return true; // Devuelvo true en caso de no ser el enter
		}
	}return true; // Devuelvo true en caso de no ser el enter
	
}

{{ HTML::script('js/antonio.js') }}

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

        Archivos = jQuery('#archivo2')[0].files;
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
                    jQuery('#img_C').attr('src', window.imagenVacia);
                    alert('El formato de imagen no es válido: debe seleccionar una imagen JPG, PNG o GIF.');
                } else {
                    jQuery('#img_C').attr('src', origen.result);
                    jQuery('#img_C').attr('width', 100);
                    
                }

            };
            Lector.onerror = function(e) {
                console.log(e)
            }
            Lector.readAsDataURL(Archivos[0]);

        } else {
            var objeto = jQuery('#archivo2');
            objeto.replaceWith(objeto.val('').clone());
            jQuery('#img_C').attr('src', window.imagenVacia);
        };


    };

    //Lee el tipo MIME de la cabecera de la imagen. la necesito para obtener el tipo de imagen
    window.obtenerTipoMIME = function obtenerTipoMIME(cabecera) {
        return cabecera.replace(/data:([^;]+).*/, '\$1');
    }

    jQuery(document).ready(function() {

        //El input del archivo lo vigilamos con un "delegado"
        jQuery('#monitoreo2').on('change', '#archivo2', function(e) {
            window.mostrarVistaPrevia();
        });

        //El botón Cancelar lo vigilamos normalmente
        jQuery('#cancelar').on('click', function(e) {
            var objeto = jQuery('<div id="archivo2"></div>');
            objeto.replaceWith(objeto.val('').clone());

            //jQuery('#img_user').attr('src', window.imagenVacia);
        });
        $('#previewC').css('visibility', 'visible');
    });
</script>