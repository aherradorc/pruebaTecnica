<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Listado de Categorías</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f5f5f5; }
    </style>
</head>
<body>
    <h2>Listado de Categorías</h2>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Padre</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->code }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parent?->name ?? '—' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
