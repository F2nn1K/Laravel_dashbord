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
        
        /* Larguras específicas das colunas */
        .col-data { width: 8%; }
        .col-rampa { width: 6%; }
        .col-nome { width: 44%; text-align: left; padding-left: 10px; }
        .col-quant { width: 10%; }
        .col-dolar { width: 12%; }
        .col-gold { width: 12%; }
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
            <th class="col-data">Data</th>
            <th class="col-rampa">Rampa</th>
            <th class="col-nome">Nome</th>
            <th class="col-quant">Quant Load</th>
            <th class="col-dolar">Dólar</th>
            <th class="col-gold">Gold</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vendas as $venda)
        <tr>
            <td class="col-data">{{ $venda['data'] }}</td>
            <td class="col-rampa">{{ $venda['rampa'] }}</td>
            <td class="col-nome">{{ $venda['nome'] }}</td>
            <td class="col-quant">{{ $venda['quant_load'] }}</td>
            <td class="col-dolar">{{ $venda['pgto_dolar'] }}</td>
            <td class="col-gold">{{ $venda['pgto_gold'] }}</td>
        </tr>
        @endforeach

        <tr class="total">
            <td colspan="3">Total</td>
            <td class="col-quant">{{ $totais['quant_load'] }}</td>
            <td class="col-dolar">{{ $totais['pgto_dolar'] }}</td>
            <td class="col-gold">{{ $totais['pgto_gold'] }}</td>
        </tr>
    </tbody>
</table>

<p>Marudi Montanha, {{ $data_hoje }}</p>

<p class="assinatura">Assinatura do Responsável: __________________________</p>
</body>
</html>
