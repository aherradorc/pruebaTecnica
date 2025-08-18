<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Listado de Productos</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; vertical-align: top; }
        th { background-color: #f5f5f5; }
        img { max-height: 60px; }
    </style>
</head>
<body>
    <h2>Listado de Productos</h2>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Categorías</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                        @foreach($product->categories as $cat)
                            {{ $cat->name }}@if(!$loop->last), @endif
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
