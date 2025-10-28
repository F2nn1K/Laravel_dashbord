<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>{{ $titulo }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 5px; text-align: center; }
        th { background-color: #eee; font-weight: bold; }
        .total { font-weight: bold; background-color: #eee; }
        .assinatura { margin-top: 50px; }
    </style>
</head>
<body>

<p><strong>REPUBLIC OF GUYANA<br>
COUNTY OF ESSEQUIBO<br>
AGREMENT</strong></p>

<h2 style="text-align: center;">{{ config('app.name', 'Laravel') }}</h2>
<h3 style="text-align: center;">{{ $titulo }}</h3>

<p><strong>Data Inicial:</strong> {{ $data_inicial }}<br>
<strong>Data Final:</strong> {{ $data_final }}</p>

<table>
    <thead>
        <tr>
            <th>Data</th>
            <th>Rampa</th>
            <th>Nome</th>
            <th>Quant Load</th>
            <th>Dólar</th>
            <th>Ouro</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vendas as $venda)
        <tr>
            <td>{{ $venda['data'] }}</td>
            <td>{{ $venda['rampa'] }}</td>
            <td>{{ $venda['nome'] }}</td>
            <td>{{ $venda['quant_load'] }}</td>
            <td>{{ $venda['pgto_dolar'] }}</td>
            <td>{{ $venda['pgto_gold'] }}</td>
        </tr>
        @endforeach

        <tr class="total">
            <td colspan="3">Total</td>
            <td>{{ $totais['quant_load'] }}</td>
            <td>{{ $totais['pgto_dolar'] }}</td>
            <td>{{ $totais['pgto_gold'] }}</td>
        </tr>
    </tbody>
</table>

<p>Marudi Montanha, {{ $data_hoje }}</p>

<p class="assinatura">Assinatura do Responsável: __________________________</p>
</body>
</html>
