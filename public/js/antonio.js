$(document).ready(function() {
    $('form').keypress(function(e){   
        if(e == 13){
            return false;
        }
    });

    $('input').keypress(function(e){
        if(e.which == 13){
            return false;
        }
    });

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


    $("#telefono").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
            return false;
        }
    });

    var add_button      = $(".add_field_button");
    var add_button2     = $(".add_correo");
    var actual_fields;
    var correos;
    $(add_button).click(function(e){
        e.preventDefault();
        actual_fields = $("#hidetels").val();
        if(actual_fields < 3){
            $("div.hidetels#" + actual_fields).show();
            $('#hidetels').val('' + (++actual_fields));
        }else if(actual_fields == 3){
            $(this).attr("disabled", "disabled");
        }
    });

    $(".esconder").on("click", function(e){
        e.preventDefault();
        //$(this).parent('div').fadeOut();
        actual_fields = $("#hidetels").val();
        $("div.hidetels#" + (--actual_fields)).hide();
        $('#hidetels').val('' + actual_fields);
        if(actual_fields == 2)
            $(".add_field_button").removeAttr("disabled");
    });
                //CORREOS
    $(add_button2).click(function(e){
        e.preventDefault();
        correos = $("#hidemails").val();
        if(correos < 3){
            $("div.hidemails#" + correos).show();
            $('#hidemails').val('' + (++correos));
        }else if(correos == 3){
            $(this).attr("disabled", "disabled");
        }
    });

    $(".esconder2").on("click", function(e){
        e.preventDefault();
        //$(this).parent('div').fadeOut();
        correos = $("#hidemails").val();
        $("div.hidemails#" + (--correos)).hide();
        $('#hidemails').val('' + correos);
        if(correos == 2)
            $(add_button2).removeAttr("disabled");
    });
});
