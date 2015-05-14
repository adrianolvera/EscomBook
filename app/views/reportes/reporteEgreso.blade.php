<html>
<head>
    <meta charset="UTF-8">
<link rel="stylesheet" href="{{asset('css/reportes.css')}}">
</head>
<body>
    <table class="fullWidth">
        <tr>
            <td width="20%"><img src="{{asset('images/logos/ipn.jpg')}}" /></td>
            <td width="60%" class="negrita text-center">
                <h3 class="guindaipn negrita">INSTITUTO POLITÉCNICO NACIONAL</h3>
                <h3 class="azulescom negrita">ESCUELA SUPERIOR DE CÓMPUTO</h3>
                
                <br />
             
            </td>
            <td width="20%"><img src="{{asset('images/logos/escom.png')}}" /></td>
        </tr>
    </table>
    <div id="fechaCreacion">
        <p class="negrita" style="text-align:right;"></p>
    </div>
    <div id="precontenido" class="fullWidth text-center">
        <h3 class="azul">Reporte Año de Egreso {{ $data=Session::get('data') }}  </h3>
        
     
    </div>
    <div id="contenidos">
        

        <table class="fullWidth table table-bordered">
            <tr>
                <td style="width:25%">Boleta</td>
                <td style="width:25%">Nombre</td>
                <td style="width:25%">Apellido</td>
                <td style="width:25%">Año de egreso</td>

            </tr>
            <?php
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
    </div>
</body>
</html>