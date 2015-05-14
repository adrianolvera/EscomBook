<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reportes</title>
    <link rel="stylesheet"  href="{{asset('css/layout.css')}}" type="text/css" media="screen" />
    <link rel="stylesheet"  href="{{asset('css/bootstrap.min.css')}}"/>
    <link rel="stylesheet"  href="{{asset('css/Font-Awesome-master/css/font-awesome.min.css')}}"/>
</head>
<body>
    <header id="header">
    <hgroup>
      <h1 class="site_title"><a href="{{ URL::to('administrador') }}">ESCOMBook</a></h1>
      <h2 class="section_title">Generación de Reportes</h2>
    </hgroup>
  </header> 
    <br>

    <?php
            $consulta=DB::select('SELECT * FROM datos_egresados'); 
 $consulta = array_values(array_sort($consulta, function($value)
                {
                    return $value->generacion;
                }));
                $arreglo = array();
                $arreglo[0] = "";
                $arreglo1 = array();
                $arreglo1[0] = "";
                foreach ($consulta as $clave => $valor) {
                    $arreglo[$valor->generacion] = $valor->generacion;
                    $arreglo1[$valor->anio_egreso] = $valor->anio_egreso;

                }
            ?>




<div class="repo container-fluid">
  {{Form::open(array('action' => 'PDFController@generarGeneracion', 'method' => 'post', 'target'=>'_blank'))}}
  {{Form::label('generacion', 'Número de Generación')}}
  {{Form::select('generacion',$arreglo,'1')}}
{{ Form::button('', array('class'=>'fa fa-file-pdf-o fa-2x', 'type'=>'submit')) }}
{{ Form::button('', array('class'=>'fa fa-file-excel-o fa-2x', 'type'=>'submit')) }}
  {{Form::close()}}
</div>


<div class="repo container-fluid">
{{Form::open(array('action' => 'PDFController@generarAnioEgreso', 'method' => 'post', 'target'=>'_blank'))}}
  {{Form::label('egreso', 'Año de egreso')}}
{{Form::select('egreso',$arreglo1,'')}}
{{ Form::button('', array('class'=>'fa fa-file-pdf-o fa-2x', 'type'=>'submit')) }}
{{ Form::button('', array('class'=>'fa fa-file-excel-o fa-2x', 'type'=>'submit')) }}
  {{Form::close()}}
</div>

<div class="repo container-fluid">
{{Form::open(array('action' => 'PDFController@generarLugarTrabajo', 'method' => 'post', 'target'=>'_blank'))}}
{{Form::label('trabajo', 'Lugar de trabajo')}}
{{Form::text('trabajo','Empresa privada',array('class' => 'col-xs-12 col-sm-6', 'readonly'))}}
{{ Form::button('', array('class'=>'fa fa-file-pdf-o fa-2x', 'type'=>'submit')) }}
{{ Form::button('', array('class'=>'fa fa-file-excel-o fa-2x', 'type'=>'submit')) }}
  {{Form::close()}}
</div>




<div class=" container-fluid">
  <table class="tablesorter" cellspacing="0"> 
      <thead> 
        <tr> 
            <th></th> 
            <th>Comment</th> 
            <th>Posted by</th> 
            <th>Posted On</th> 
            <th>Actions</th> 
        </tr> 
      </thead> 
      <tbody> 
        <tr> 
            <td><input type="checkbox"></td> 
            <td>Lorem Ipsum Dolor Sit Amet</td> 
            <td>Mark Corrigan</td> 
            <td>5th April 2011</td> 
            <td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
        </tr> 
        <tr> 
            <td><input type="checkbox"></td> 
            <td>Ipsum Lorem Dolor Sit Amet</td> 
            <td>Jeremy Usbourne</td> 
            <td>6th April 2011</td> 
            <td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
        </tr>
        <tr> 
            <td><input type="checkbox"></td> 
            <td>Sit Amet Dolor Ipsum</td> 
            <td>Super Hans</td> 
            <td>10th April 2011</td> 
            <td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
        </tr> 
        <tr> 
            <td><input type="checkbox"></td> 
            <td>Dolor Lorem Amet</td> 
            <td>Alan Johnson</td> 
            <td>16th April 2011</td> 
            <td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
        </tr> 
        <tr> 
            <td><input type="checkbox"></td> 
            <td>Dolor Lorem Amet</td> 
            <td>Dobby</td> 
            <td>16th April 2011</td> 
            <td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
        </tr> 


      </tbody> 
      </table>
</div>
       
    <footer class="container-fluid">
      <hr/>
      <p><strong>Escuela Superior de Cómputo.</strong></p>
    <p style="text-align: justify;">Esta página es una obra intelectual protegida por la Ley Federal del Derecho de Autor, puede ser reproducida con fines no lucrativos, siempre y cuando no se mutile, se cite la fuente completa y su dirección electrónica; su uso para otros fines, requiere autorización previa y por escrito del Director General del Instituto.<br>
    ® 2015</p> 

    </footer>
  </aside>
</body>
</html>