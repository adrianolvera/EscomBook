<html>
<head>
<style>
    @page {margin: 40px 20px;}
    h1, h2, h3, h4 {margin: 0 0 5px;}
    p {font-size: 1.2em}
    .guindaipn{color:#600;}
    .azulescom{color:#0047B6;}
    .negrita {font-weight: bold;}
    .subrayado {text-decoration: underline; }
    #fechaCreacion { margin:20px 0;}
    #precontenido {margin-bottom: 30px;}
    .text-center {text-align: center;}
    .fullWidth {width:100% !important; max-width:100% !important;}
    table {border-collapse: collapse; width: 90%; max-width: 90% !important;}
    .table tbody tr td, .table tr th {vertical-align: middle; text-align: center; padding: 15px 0;}
    .table-bordered th, .table-bordered td {
        border: 1px solid #ddd !important;
    }
</style>
</head>
<body>
    <table class="fullWidth">
        <tr>
            <td width="20%"><img src="{{asset('images/ipn.jpg')}}" /></td>
            <td width="60%" class="negrita text-center">
                <h3 class="guindaipn negrita">INSTITUTO POLIT&Eacute;CNICO NACIONAL</h3>
                <h3 class="azulescom negrita">ESCUELA SUPERIOR DE C&Oacute;MPUTO</h3>
                
                <br />
             
            </td>
            <td width="20%"><img src="{{asset('images/logoESCOM.jpg')}}" /></td>
        </tr>
    </table>
    <div id="fechaCreacion">
        <p class="negrita" style="text-align:right;"></p>
    </div>
    <div id="precontenido" class="fullWidth text-center">
        <h3 class="guindaipn">LISTA DE PRESENTES</h3>
        <h3 class="azulescom"></h3>
        <p>PLAN 2009</p>
        <p class="negrita"></p>
        <p>A celebrarse el <strong></strong> a las <strong></strong> en el <strong></strong></p>
        <p class="negrita">Semestre </p>
    </div>
    <div id="contenidos">
        <h3 class="subrayado">Firma Representantes</h3>

        <table class="fullWidth table table-bordered">
            <tr>
                <td style="width:30%">Profesor</td>
                <td style="width:70%">Firma</td>
            </tr>

        </table>
    </div>
</body>
</html>