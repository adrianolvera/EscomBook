@extends('plantilla.masterAdmin')

@section('content')

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




        <table class="table-bordered">
            <tr>
            
                <td style="width:25%">Boleta</td>
                <td style="width:25%">Nombre</td>
                <td style="width:25%">Apellido</td>
                <td style="width:25%">Año de egreso</td>
            </tr>

           
            <?php
             $data=Session::get('data');
            $consulta=DB::select('SELECT * FROM datos_egresados join users where generacion=:id',['id'=>$data]);

            ?>
          
           @foreach ($consulta as $consul)
           <tr>
               <td style="width:25%">{{ $consul->boleta }}</td>
               <td style="width:25%">{{ $consul-> nombre}}</td>
               <td style="width:25%">{{ $consul-> apPaterno}}</td>
               <td style="width:25%">{{ $consul-> generacion}}</td>
           </tr>
           @endforeach

        </table>


@stop