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
      <h1 class="site_title"><a href="index.html">ESCOMBook</a></h1>
      <h2 class="section_title">Generación de Reportes</h2>
    </hgroup>
  </header> 
    <br>
      {{Form::open()}}
      <div>
      {{Form::label('nombre', 'Escribe el usuario:')}}
      {{Form::text('nombre')}}
      </div>

      <div>
      {{Form::label('password', 'Escribe la contraseña:')}}
      {{Form::password('pasword')}}
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