<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>MODELO 2</title>
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif; 
            font-size: 12px;
            margin: 20px;
        }
        
        h1 {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0;
        }
        
        h2 {
            background-color: #d0d0d0;
            padding: 8px;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin: 20px 0 10px 0;
        }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px;
            margin-bottom: 30px;
        }
        
        th, td { 
            border: 1px solid #000; 
            padding: 8px; 
            text-align: left;
        }
        
        th { 
            background-color: #f0f0f0; 
            font-weight: bold;
            text-align: center;
        }
        
        .col-inscricao { width: 12%; text-align: center; }
        .col-rampa { width: 12%; text-align: center; }
        .col-nome { width: 50%; }
        .col-assinatura { width: 26%; }
        
        .data-local {
            margin-top: 30px;
            font-size: 12px;
        }
        
        .assinatura-rodape {
            margin-top: 50px;
            font-size: 12px;
        }
        
        .header-info {
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<p class="header-info">
    <strong>REPUBLIC OF GUYANA</strong><br>
    <strong>COUNTY OF ESSEQUIBO</strong><br>
    <strong>AGREMENT</strong>
</p>

<h1>Sistema Marudi Mountain</h1>

<h2>{{ $titulo }}</h2>

<table>
    <thead>
        <tr>
            <th class="col-inscricao">Inscrição</th>
            <th class="col-rampa">Rampa</th>
            <th class="col-nome">Nome Associado</th>
            <th class="col-assinatura">Assinatura</th>
        </tr>
    </thead>
    <tbody>
        @forelse($dados as $item)
        <tr>
            <td class="col-inscricao">{{ $item['inscricao'] }}</td>
            <td class="col-rampa">{{ $item['rampa'] }}</td>
            <td class="col-nome">{{ $item['nome'] }}</td>
            <td class="col-assinatura"></td>
        </tr>
        @empty
        <tr>
            <td colspan="4" style="text-align: center; padding: 20px;">
                Nenhum registro encontrado
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<p class="data-local">Marudi Montanha, {{ $data_hoje }}</p>

<p class="assinatura-rodape">Assinatura do Responsável: __________________________</p>

</body>
</html>

