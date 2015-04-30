<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
    <link rel="stylesheet"  href="{{asset('css/layout.css')}}" type="text/css" media="screen" />
    <link rel="stylesheet"  href="{{asset('css/bootstrap.min.css')}}"/>
</head>
<body>
    <header id="header">
    <hgroup>
      <h1 class="site_title"><a href="administrador/index">ESCOMBook</a></h1>
      <h2 class="section_title">Generación de Reportes</h2>
    </hgroup>
  </header> 
    <br>
      {{Form::open(array('action' => 'PDFController@show', 'method' => 'get'))}}



<div>
{{Form::label('generacion', 'Número de Generación')}}
{{Form::select('generacion',array(
'generacion_1'=>'Generacion 1',
'generacion_2'=>'Generacion 2',
'generacion_3'=>'Generacion 3',
'generacion_4'=>'Generacion 4',
'generacion_5'=>'Generacion 5',
'generacion_6'=>'Generacion 6',
'generacion_7'=>'Generacion 7',
'generacion_8'=>'Generacion 8',
'generacion_9'=>'Generacion 9',
'generacion_10'=>'Generacion 10',
'generacion_11'=>'Generacion 11',
'generacion_12'=>'Generacion 12',
'generacion_13'=>'Generacion 13',
'generacion_14'=>'Generacion 14',
'generacion_15'=>'Generacion 15',
'generacion_16'=>'Generacion 16',
'generacion_17'=>'Generacion 17',
'generacion_18'=>'Generacion 18',
'generacion_19'=>'Generacion 19',
'generacion_20'=>'Generacion 20',
'21'=>'Generacion 21'
),'generacion_1')}}
</div>
      {{Form::submit('Enviar')}}



      {{Form::close()}}



       
    <footer>
      <hr/>
      <p><strong>Escuela Superior de Cómputo.</strong></p>
    <p style="text-align: justify;">Esta página es una obra intelectual protegida por la Ley Federal del Derecho de Autor, puede ser reproducida con fines no lucrativos, siempre y cuando no se mutile, se cite la fuente completa y su dirección electrónica; su uso para otros fines, requiere autorización previa y por escrito del Director General del Instituto.<br>
    ® 2015</p> 

    </footer>
  </aside>
</body>
</html>