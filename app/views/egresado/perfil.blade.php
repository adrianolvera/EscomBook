@extends('plantilla.masterPerfil')

@section('css')
{{ HTML::style('css/bootstrap.css') }}
{{ HTML::style('css/bootstrap-theme.css') }}
{{ HTML::style('assets/css/form.css') }}
@stop

@section('content')
    <!-- Page Content -->
    <section id="main" class="column">
    <br>
    @if(isset($tel) && isset($correo))
        @include('egresado.form1')
    @else
        @include('egresado.form2')
    @endif
    </section>

@stop

@section('js')
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
{{ HTML::script('js/antonio.js') }}

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

@stop