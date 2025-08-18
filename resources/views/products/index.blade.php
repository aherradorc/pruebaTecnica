<x-app-layout>
    <x-slot name="header">
        <h2 class="h4">Productos</h2>
    </x-slot>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-end">
                <a href="{{ route('products.export.pdf') }}" class="btn btn-success mb-3"> Exportar a PDF</a>
                <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Nuevo producto</a>
            </div>
        </div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Categorías</th>
                    <th>Foto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                        @foreach($product->categories as $cat)
                            <span class="badge bg-secondary">{{ $cat->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        @if($product->photo)
                            <img src="{{ $product->photo }}" class="img-thumbnail" style="max-height: 80px;">
                        @else
                            <span class="text-muted">Sin imagen</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Borrar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No hay productos disponibles.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{ $products->links() }}
    </div>
</x-app-layout>