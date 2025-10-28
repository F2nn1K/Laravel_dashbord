<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $titulo }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>{{ $titulo }}</h1>
    <p>Fecha: {{ $fecha }}</p>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $v)
                <tr>
                    <td>{{ $v['producto'] }}</td>
                    <td>{{ $v['cantidad'] }}</td>
                    <td>{{ $v['precio'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $titulo }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>{{ $titulo }}</h1>
    <p>Fecha: {{ $fecha }}</p>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $v)
                <tr>
                    <td>{{ $v['producto'] }}</td>
                    <td>{{ $v['cantidad'] }}</td>
                    <td>{{ $v['precio'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

</body>
</html>
