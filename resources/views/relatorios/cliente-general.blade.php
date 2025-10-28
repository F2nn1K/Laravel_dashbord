<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Geral</title>
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

<h2 style="text-align: center;">MARUDI MOUNTAIN</h2>
<h3 style="text-align: center;">RELATÓRIO VENDAS</h3>

    <table>
        <thead>
            <tr>
                <th>Inscrição</th>
                <th>Rampa</th>
                <th>Nome Associado</th>
                <th>Nome Investidor</th>
            </tr>
        </thead>
        <tbody>
            <!-- Exemplo de dados -->
            @foreach($clientes as $cliente)
            <tr>
                <td>{{ $cliente->inscricao }}</td>
                <td>{{ $cliente->rampa }}</td>
                <td>{{ $cliente->nome_associado }}</td>
                <td>{{ $cliente->nome_investidor }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="assinatura">Assinatura do Responsável: __________________________</p>

</body>
</html>
