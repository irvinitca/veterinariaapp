<!DOCTYPE html>
<html>
<head>
    <title>Reportes de Ingresos Mensuales</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <style>
.iconbtn{
	max-height: 30px!important;
    width: 30px!important;
    padding: 1px!important;
}

h2{
    text-align: center;
    font-size: 18px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: white;
    padding: 30px 0;
}

/* Table Styles */

.table-wrapper{
    margin: 10px 70px 70px;
    box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
}

.fl-table {
    border-radius: 5px;
    font-size: 12px;
    font-weight: normal;
    border: none;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
}

.fl-table td, .fl-table th {
    text-align: center;
    padding: 8px;
}

.fl-table td {
    border-right: 1px solid #f8f8f8;
    font-size: 12px;
}

.fl-table thead th {
    color: #ffffff;
    background: #4FC3A1;
}


.fl-table thead th:nth-child(odd) {
    color: #ffffff;
    background: #324960;
}

.fl-table tr:nth-child(even) {
    background: #F8F8F8;
}
h4{
    color:#324960;
}
p{
    color: #36866e;
    font-size: 20px;
}
span{
    color: rgb(167, 41, 41);
    font-weight: bold;
    font-size: 20px;
}

    </style>

    <h4>
        <img class="logovet" src="{{ public_path('logo/cio-logo.png') }}" alt="Logo de CIO" style="width: 80px; height:80px">
        <label style="margin-top:-5rem">Veterinaria CIO</label>
    </h4>
    <h4 class="text-center">{{ $title }}</h4>
    <p>Correpondientes al mes de <span> {{ $monthName }} </span>del año<span> {{ $year }}</span> <br>
        Tipo de Citas: <span> {{ $type }}</span> <br>
        **INGRESO TOTAL DE {{ $monthName }}: <span>${{ $total }} dólares</span></p>

    <table class="fl-table">
        <thead>
        <tr>
            <th># CITA</th>
            <th>FECHA</th>
            <th>MASCOTA</th>
            <th>TIPO DE CITA</th>
            <th>Monto</th>
        </tr>
        </thead>
        <tbody>
        @foreach($appointments as $appointment)

        <tr>
            <td>{{ $appointment->id }}</td>
            <td>{{ $appointment->date_start }}</td>
            <td>{{ $appointment->pet->name }}   </td>
            <td>{{ $appointment->type }}</td>
            <td>
                @if($appointment->total)
                    {{ $appointment->total }}
                @else
                    Sin cancelar
                @endif
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

</body>
</html>
