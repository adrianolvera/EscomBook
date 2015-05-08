<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reportes</title>
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
      {{Form::open(array('action' => 'PDFController@store', 'method' => 'post', 'target'=>'_blank'))}}



<div>
{{Form::label('generacion', 'Número de Generación')}}
{{Form::select('generacion',array(
'1'=>'Generacion 1',
'2'=>'Generacion 2',
'3'=>'Generacion 3',
'4'=>'Generacion 4',
'5'=>'Generacion 5',
'6'=>'Generacion 6',
'7'=>'Generacion 7',
'8'=>'Generacion 8',
'9'=>'Generacion 9',
'10'=>'Generacion 10',
'11'=>'Generacion 11',
'12'=>'Generacion 12',
'13'=>'Generacion 13',
'14'=>'Generacion 14',
'15'=>'Generacion 15',
'16'=>'Generacion 16',
'17'=>'Generacion 17',
'18'=>'Generacion 18',
'19'=>'Generacion 19',
'20'=>'Generacion 20',
'21'=>'Generacion 21'
),'1')}}
</div>
<div>
  {{Form::label('boleta', 'Año de boleta')}}
{{Form::text('boleta','2011630516')}}
</div>

<div>
  {{Form::label('ingreso', 'Año de Ingreso')}}
{{Form::text('boleta')}}
</div>

<div>
 {{Form::label('egreso', 'Año de egreso')}}
{{Form::text('boleta')}}
 
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